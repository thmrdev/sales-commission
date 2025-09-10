<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSellerRequest;
use App\Http\Resources\SellerResource;
use App\Services\SellerService;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    protected SellerService $service;

    public function __construct(SellerService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $sellers = $this->service->listSellers();
        return response()->json(SellerResource::collection($sellers));
    }

    public function store(StoreSellerRequest $request): JsonResponse
    {
        $seller = $this->service->createSeller($request->validated());
        return response()->json(new SellerResource($seller), 201);
    }
}
