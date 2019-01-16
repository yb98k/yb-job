<?php
/**
 * User: yk
 * Date: 19-1-15
 * Time: 11:54 pm
 */

namespace sap;

class App
{
    protected $_componentArray;//component

    /**
     * 加载配置文件不去实例化组件，等到使用时才实例化
     * load config and not make it,make it when using
     * App constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        if(isset($config['component'])) {
            foreach ($config['component'] as $com => $class) {
                $this->_componentArray[$com] = $class;
            }
        }
    }

    /**
     * 魔术方法
     * magic method
     * @param $name
     * @return bool|object|null
     */
    public function __get($name)
    {
        if(isset($this->{$name}))
            return $this->{$name};

        if(!isset($this->_componentArray[$name]['class']))
            return null;

        $class = $this->_componentArray[$name]['class'];
        $temp = $this->_componentArray[$name];
        unset($temp['class']);
        $params = $temp;

        return self::createClass($class, $params);
    }

    /**
     * 用来实例化对象的方法
     * can use this function to make object
     * @param $class
     * @param array $params
     * @return bool|object|null
     */
    public static function createClass($class, $params = [])
    {
        if(!class_exists($class)) {
            return false;
        }

        //use reflection to make object
        try{
            $thisClass = new \ReflectionClass($class);
        }catch (\Exception $e){
            return null;
        }

        //sort class's params
        $finalParam = [];
        $paramVars = $thisClass->getConstructor()->getParameters();
        foreach ($paramVars as $key) {
            if(isset($params[$key->name])){
                $finalParam[$key->name] = $params[$key->name];
            }
        }

        return $finalParam ? $thisClass->newInstanceArgs($finalParam) : $thisClass->newInstance();
    }
}