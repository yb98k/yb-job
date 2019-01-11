<?php
/**
 * User: yk
 * Date: 19-1-11
 * Time: 4:44 pm
 */

return array_merge(
    include ( __DIR__ . '/dbs/mysql.php' ),
    include ( __DIR__ . '/dbs/sqlite.php' )
);