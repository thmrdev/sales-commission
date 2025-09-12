<?php

namespace App\Repositories;

use App\Models\Seller;

class SellerRepository
{
    protected Seller $model;

    public function __construct(Seller $seller)
    {
        $this->model = $seller;
    }

    public function create(array $data): Seller
    {
        return $this->model->create($data);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById(int $id): ?Seller
    {
        return $this->model->find($id);
    }

    public function findByEmail(string $email): ?Seller
    {
        return $this->model->where('email', $email)->first();
    }
}
