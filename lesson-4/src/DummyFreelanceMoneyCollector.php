<?php

namespace App;

class DummyFreelanceMoneyCollector implements FreelanceMoneyCollectorInterface
{
    public function earnMoney(float $amount): void
    {
        
    }

    public function withdrawMoney(): string
    {
        return '';
    }
}