<?php
use Predis\Session\Handler;

// Подключение к Redis для хранения сессий
$sessionHandler = new Handler();
$sessionHandler->register();

// Начало сессии
session_start();

// Работа с сессией
$_SESSION['user_id'] = 123;

// Завершение сессии
session_destroy();