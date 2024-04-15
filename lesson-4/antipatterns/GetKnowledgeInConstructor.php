<?php
class GetKnowledgeInConstructor
{
    private User $user;
    private Order $order;

    // 1 вариант
    // public function __construct(Response $response)
    // {
        // $this->user = $response->getUser();
        // $this->order = $response->getOrder();
    // }

    // 2 вариант
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }
}
