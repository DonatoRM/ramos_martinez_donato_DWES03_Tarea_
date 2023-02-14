<?php
$host = 'localhost';
$user = 'gestor';
$pass = 'secreto';
$bd = 'proyecto';
$dsn = "mysql:host=$host;dbname=$bd;charset=utf8mb4";
$conProyecto = new PDO($dsn, $user, $pass);
$conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
