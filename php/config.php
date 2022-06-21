<?php
    try {
        $db = new PDO('mysql:host=localhost;dbname=Unit;charset=utf8', 'root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) 
    {
        die('Erreur' .$e -> getMessage());
    }
?>