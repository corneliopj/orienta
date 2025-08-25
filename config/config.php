<?php
// Configurações gerais do sistema
define('BASE_URL', 'http://orienta.cpetersenjr.com/public');
define('SITE_NAME', 'Sistema de Acompanhamento Educacional');
date_default_timezone_set('America/Sao_Paulo');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'petersen_orienta';
$username = 'petersen_orienta';
$password = '^AwXW0m*5srg2dwa';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}