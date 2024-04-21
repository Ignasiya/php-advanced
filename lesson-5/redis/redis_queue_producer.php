<?php
require_once __DIR__.'/vendor/autoload.php'; // Путь к файлу autoload.php из Composer
use Predis\Client;

// Подключение к Redis
$redis = new Client(['host' => 'localhost', 'port' => 6379]);
// Задача для отправки электронного письма
$emailTask = [
    'recipient' => 'user@example.com',
    'message' => 'Hello, Redis!',
];

// Отправка задачи в очередь
$redis->lpush('email_queue', json_encode($emailTask));

echo "Задание отправлено в очередь.\n";