<?php

namespace DAO;

use PDOException;

trait Connection
{
    protected $pdo;

    /**
     * Abre a conexão com o DB via PDO
     */
    public function getPdoConnection()
    {
        $host = getenv('HOST');
        $dbname = getenv('DBNAME');
        $user = getenv('USER');
        $port = getenv('PORT');
        $pass = getenv('PASS');
        
        try {
            $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);

            return $this->pdo;
        } catch (PDOException $e) {
            return false;
        }
    }
}
