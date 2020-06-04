<?php

namespace Controller;

use Model\QueryResult;

class OrderController extends Controller
{
    public function createOrder(float $total, string $userId): QueryResult
    {
        return $this->model->createOrder($total, $userId);
    }
}
