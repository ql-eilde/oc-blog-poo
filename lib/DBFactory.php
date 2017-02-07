<?php

class DBFactory
{
    public static function getConnexionWithPDO(){
        $db = new PDO('mysql:host=localhost;dbname=blog', 'root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}