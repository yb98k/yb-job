<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-1-11
 * Time: 下午4:50
 */

namespace model;

use Illuminate\Database\Eloquent\Model;

class DemoModel extends Model
{
    public $timestamps = false;

    protected $connection = 'sqlite_01';

    protected $table = 'tableName';
}