<?php

namespace App\Services;

use App\Repositories\SellerRepository;
use App\Models\Seller;

class SellerService
{
    protected SellerRepository $repository;

    public function __construct(SellerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createSeller(array $data): Seller
    {
        return $this->repository->create($data);
    }

    public function listSellers()
    {
        return $this->repository->getAll();
    }
}
