<?php

$totalRequests = 100;
$concurrentUser = 10;

$url = 'http://localhost:5500';

function sendRequest($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

for ($i = 0; $i < $concurrentUser; $i++) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        die("could not fork");
    } elseif ($pid) {
    } else {
        for ($j=0; $j < $totalRequests / $concurrentUser; $j++) { 
            sendRequest($url);
        }
        exit();
    }
}

while (pcntl_waitpid(0, $status) != -1) {
    $status = pcntl_wexitstatus($status);
    echo "Child process completed. Exit status: $status" . PHP_EOL;
}

echo "Load testing completed" . PHP_EOL;
