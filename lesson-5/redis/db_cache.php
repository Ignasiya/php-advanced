<?php
// Подключение к Redis
$redis = new Redis();
$redis->connect('localhost', 6379);

// Попытка получения данных из кэша
$data = $redis->get('db_result_key');

if ($data === false) {
    // Если данных нет в кэше, выполнить запрос к базе данных
    $db = new mysqli('localhost', 'user', 'password', 'mydb');
    
    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    $result = $db->query('SELECT * FROM my_table');

    if ($result) {
        // Получить результаты и преобразовать их в массив
        $data = $result->fetch_all(MYSQLI_ASSOC);

        // Сохранить результаты в кэше
        $redis->set('db_result_key', serialize($data), ['ex' => 3600]); // Кэшировать на 1 час
    }

    // Закрыть соединение с базой данных
    $result->free();
    $db->close();
}

// Использовать данные
if ($data !== false) {
    $data = unserialize($data);
    print_r($data);
} else {
    echo "Failed to retrieve data from cache or database.\n";
}