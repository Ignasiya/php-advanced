<?php
echo "Переданные аргументы:\n";

for ($i=1; $i < $argc; $i++) { 
    echo"$i: {$argv[$i]}\n";
}