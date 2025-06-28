<?php

class DataBase {
    public static function connect() {
        $host = 'localhost:3307';
        $user = 'root';
        $pass = 'null';
        $db_name = 'tienda_master';

        $db = new mysqli($host, $user, $pass, $db_name);
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
