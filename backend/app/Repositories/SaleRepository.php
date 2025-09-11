<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository
{
    protected Sale $model;

    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Sale
    {
        return $this->model->create($data);
    }

    public function getAll()
    {
        return $this->model->with('seller')->get();
    }

    public function getBySellerId(int $sellerId)
    {
        return $this->model->with('seller')->where('seller_id', $sellerId)->get();
    }
}
