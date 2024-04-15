<?php

class InstallationInConstructor
{
    private Order $order;
   
    // 1 вариант
    // public function __construct()
    // {
    //     $this->order = new Order(new User);
    // }

    // 2 вариант
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}