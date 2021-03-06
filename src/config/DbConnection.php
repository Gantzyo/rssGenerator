<?php
namespace RssGenerator\Config;

use \PDO;

class DbConnection
{
    // Descomentar la conexión que quieras utilizar. Por defecto SQLite

    //  MySQL
    // public static $connectionParameters = [
    //     // required
    //     'database_type' => 'mysql',
    //     'database_name' => 'midb',
    //     'server' => 'localhost',
    //     'username' => 'root',
    //     'password' => '',

    //     // [optional]
    //     'charset' => 'utf8mb4',
    //     'collation' => 'utf8mb4_general_ci',
    //     'port' => 3306,

    //     // [optional] Table prefix
    //     'prefix' => 'rssgenerator_',

    //     // [optional] Enable logging (Logging is disabled by default for better performance)
    //     'logging' => true,

    //     // [optional] MySQL socket (shouldn't be used with server and port)
    //     // 'socket' => '/tmp/mysql.sock',

    //     // [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
    //     'option' => [
    //         PDO::ATTR_CASE => PDO::CASE_NATURAL,
    //     ],

    //     // [optional] Medoo will execute those commands after connected to the database for initialization
    //     'command' => [
    //         'SET SQL_MODE=ANSI_QUOTES',
    //     ],
    // ];

    // SQLite
    public static $connectionParameters = [
        'database_type' => 'sqlite',
        'database_file' => __DIR__.'/../../config/rssGenerator.db',
        'prefix' => 'rssgenerator_',
        'logging' => true,
    ];
}
