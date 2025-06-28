<?php

class DataBase{
    public static function connect(){
        $db = new mysqli('localhost:3307', 'root', 'nucll', 'tienda_master');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}