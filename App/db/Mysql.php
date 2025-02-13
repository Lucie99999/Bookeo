<?php

namespace App\db;

use PDO;

class Mysql
{

        private $db_dsn;
        private $db_user;
        private $db_password;
        private $pdo = null;
        private static $_instance = null;

        //Le constructeur est en private car on ne pourra pas instancier la classe en dehors de celle-ci.
        //C'est elle qui décide si on fait une instanciation ou pas.
        private function __construct()
        {
            $conf = require_once _ROOTPATH_.'/config.php';

            if (isset($conf['db_dsn'])) {
                $this->db_dsn = $conf['db_dsn'];
            }

            if (isset($conf['db_user'])) {
                $this->db_user = $conf['db_user'];
            }

            if (isset($conf['db_password'])) {
                $this->db_password = $conf['db_password'];
            }
        }

        public static function getInstance()
        {
            if (self::$_instance == null) {
                self::$_instance = new Mysql();
            }
            return self::$_instance;
        }

        public function getPDO():PDO
        {
            if ($this->pdo == null) {
                $pdo = new PDO($this->db_dsn, $this->db_user, $this->db_password);
                $this->pdo = $pdo;
            }
            return $this->pdo;
        }
}