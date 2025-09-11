<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use App\Models\Sale;

class SaleService
{
    protected SaleRepository $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createSale(array $data): Sale
    {
        return $this->repository->create($data);
    }

    public function listSales()
    {
        return $this->repository->getAll();
    }

    public function listSalesBySeller(int $sellerId)
    {
        return $this->repository->getBySellerId($sellerId);
    }
}
