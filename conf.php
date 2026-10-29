<?php

function ouvrirRD()
{
    $host     = getenv('DB_HOST');
    $user     = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $database = getenv('DB_NAME');
    $port     = getenv('DB_PORT') ?: 3306;

    if (!$host && file_exists(__DIR__ . '/config.php')) {
        $config   = require __DIR__ . '/config.php';
        $host     = $config['host'];
        $user     = $config['user'];
        $password = $config['password'];
        $database = $config['database'];
    }

    $con = mysqli_connect($host, $user, $password, $database, (int) $port);

    if (!$con) {
        die("Connexion impossible à MySQL : " . mysqli_connect_error());
    }

    mysqli_set_charset($con, "utf8");

    return $con;
}

function fermeture($con)
{
    if ($con instanceof mysqli) {
        mysqli_close($con);
    }
}