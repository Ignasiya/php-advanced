<?php
declare(ticks = 1);
function signalHandler($signal) {
    switch ($signal) {
        case SIGTERM:
            echo "Получил SIGTERM. Завершаю работу...\\n";
            exit;
        case SIGINT:
            echo "Получил SIGINT. Завершаю работу...\\n";
            exit;
        case SIGKILL:
            echo "Получен сигнал SIGKILL. Завершаю работу...\\n";
            break;
    }
}

pcntl_signal(SIGTERM, "signalHandler");
pcntl_signal(SIGINT, "signalHandler");

while (true) {
    echo "Выполнение работы...\n";
    sleep(1);
}
