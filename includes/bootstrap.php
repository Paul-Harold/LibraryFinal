<?php

session_start();

const DB_HOST = 'localhost';
const DB_NAME = 'lib';
const DB_USER = 'root';
const DB_PASSWORD = '';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection Failed!" . $conn->connect_error);
}

function db(): PDO
{
    static $pdo;

    if (!$pdo) {
        return new PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=UTF8", DB_HOST, DB_NAME),
            DB_USER,
            DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    return $pdo;
}
