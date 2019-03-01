<?php
namespace RssGenerator\Db;

use Medoo\Medoo as Medoo;
use RssGenerator\Config\DbConnection as DbConnection;

// Sacado de https://stackoverflow.com/a/219599
class ConnectionFactory
{
    /*
    Aunque $factory sea static y solo tenga una instancia de conexión a BBDD,
    el ciclo de vida de cualquiera variable por defecto de PHP va asociado al request
    por lo que la conexión a BBDD "no caduca". Ejemplo:
    - Request 1:
        - $factory no existe en este contexto, se instancia y se conecta a BBDD -> Query 1
        - Recupera la conexión a BBDD -> Query 2
        - Recupera la conexión a BBDD -> Query 3
        - Recupera la conexión a BBDD -> Query 4
        - etc.
    - Request 2:
        - $factory no existe en este contexto, se instancia y se conecta a BBDD -> Query 1
        - Recupera la conexión a BBDD -> Query 2
        - Recupera la conexión a BBDD -> Query 3
        - Recupera la conexión a BBDD -> Query 4
        - etc.

    Gracias a este funcionamiento no hay que preocuparse de comprobar que la conexión está viva,
    pues en cada request se genera una nueva conexión a BBDD.
     */
    private static $factory;
    private $db;

    public static function getFactory(): ConnectionFactory
    {
        if (!self::$factory) {
            self::$factory = new ConnectionFactory();
        }

        return self::$factory;
    }

    public function getConnection(): Medoo
    {
        if (!$this->db) {
            $this->db = new Medoo(DbConnection::$connectionParameters);
        }
        return $this->db;
    }
}
