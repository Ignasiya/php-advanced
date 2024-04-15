<?php

class StaticCallsInConstructor
{
    private User $user;
    
    // 1 вариант
    // public function __construct(string $userName)
    // {
    // $this->user = User::getUserByName($userName);
    // }

    // 2 вариант
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
