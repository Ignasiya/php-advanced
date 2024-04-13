<?php

$pid = pcntl_fork();

if ($pid == -1) {
    die("Could not fork.");
} elseif ($pid) {
    exit();
} else {
    if (posix_setsid() == -1) {
        die("Could not set session id.");
    }

    chdir('/');

    fclose(STDIN) ;
    fclose(STDOUT) ;
    fclose (STDERR) ;

    $stdin = fopen('/dev/null', 'r');
    $stdout = fopen('/var/log/output.log', 'ab');
    $stderr = fopen('/var/log/error.log', 'ab');

    while (true) {
        sleep(1);
    }
}
