<?php

namespace App\PhpCli;

class Calculator
{
    public function add(...$args)
    {
        return array_sum($args);
    }
};
