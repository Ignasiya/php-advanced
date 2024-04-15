<?php

namespace App;

use Exception;

class FreelanceMoneyCollector implements FreelanceMoneyCollectorInterface
{
    private $name;
    private $totalEarnings;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->totalEarnings = 0;
    }

    public function earnMoney(float $amount): void
    {
        if ($amount < 0) {
        throw new Exception("Заработок не может быть отрицательным.");
        }
        $this->totalEarnings += $amount;
    }

    public function withdrawMoney(): string
    {
        $result = $this->prepareResultString();
        $this->totalEarnings = 0;
        return $result;
    }
    
    private function prepareResultString(): string
    {
        if ($this->totalEarnings > 1000000) {
        throw new Exception("{$this->name} заработал слишком много денег!");
        }
        return "{$this->name} заработал {$this->totalEarnings} руб. на фрилансе.";
    }
}