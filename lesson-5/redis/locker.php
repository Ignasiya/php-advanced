<?php

// Подключение к Redis
$redis = new Redis();
$redis->connect('localhost', 6379);

// Имя семафора
$semaphoreKey = 'my_semaphore';

// Попытка установки семафора
$acquiredSemaphore = $redis->set($semaphoreKey, 'locked', ['nx' => true, 'ex' => 10]);

if ($acquiredSemaphore) {
    try {
        // Выполнение операций, защищенных семафором
        echo "Выполняю очень долгую работу...\n";
        sleep(5); // Для имитации долгой работы
    } finally {
        // Освобождение семафора
        $redis->del($semaphoreKey);
        echo "Семафор освобожден.\n";
    }
} else {
    echo "Не удалось получить семафор. Семафор может быть у другого процесса.\n";
}