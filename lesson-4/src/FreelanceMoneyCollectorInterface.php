<?php

namespace App;

interface FreelanceMoneyCollectorInterface
{
    public function earnMoney(float $amount): void;

    public function withdrawMoney(): string;
}