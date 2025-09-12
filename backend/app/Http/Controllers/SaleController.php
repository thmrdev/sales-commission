<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    protected SaleService $service;

    public function __construct(SaleService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $sales = $this->service->listSales();
        return response()->json(SaleResource::collection($sales));
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = $this->service->createSale($request->validated());
        return response()->json(new SaleResource($sale), 201);
    }

    public function salesBySeller(int $sellerId): JsonResponse
    {
        $sales = $this->service->listSalesBySeller($sellerId);
        return response()->json(SaleResource::collection($sales));
    }
}
