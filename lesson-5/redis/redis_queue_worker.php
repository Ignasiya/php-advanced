<?php
require_once __DIR__.'/vendor/autoload.php'; // Путь к файлу autoload.php из Composer
use Predis\Client;

// Подключение к Redis
$redis = new Client(['host' => 'localhost', 'port' => 6379]);

while (true) {
    // Получение задачи из очереди
    $emailTaskJson = $redis->brpop('email_queue', 0)[1];

    // Распаковка JSON
    $emailTask = json_decode($emailTaskJson, true);

    // Имитация отправки электронного письма (замените этот блок на свой код)
    echo "Отправляю сообщение для: {$emailTask['recipient']}, Сообщение: {$emailTask['message']}\n";
    
    // Здесь вы можете использовать ваш код для отправки электронного письма
    
    // Пауза для имитации обработки
    sleep(1);
}