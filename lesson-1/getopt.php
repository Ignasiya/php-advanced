<?php
$options = getopt("u:a:", ["username:", "age:"]);

if (!empty($options) && isset($options['u']) && isset($options['a'])) {
    $username = $options['u'];
    $age = intval($options['a']);
} elseif (!empty($options) && isset($options['username']) && isset($options['age'])) { 
    $username = $options['username'];
    $age = intval($options['age']);
} else {
    echo "Usage: php script.php	-u <username> -a <age>\n";
    echo "Usage: php script.php	--username <username> --age <age>\n";
    exit(1);
}

if ($age < 0 || $age > 120) {
    echo "Invalid age\n";
    exit(1);
}

echo "Hello, $username! You are $age years old.\n";
