<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotEnv = Dotenv\Dotenv::createMutable(__DIR__ . '/../../../');
$dotEnv->load();

session_start();
