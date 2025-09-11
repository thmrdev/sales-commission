<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Collection;

class SalesReportService
{
    protected float $commissionPercent;

    public function __construct(float $commissionPercent = 8.5)
    {
        $this->commissionPercent = $commissionPercent;
    }

    public function calculateCommission(float $amount): float
    {
        return $amount * ($this->commissionPercent / 100);
    }

    public function sellerDailyReport(int $sellerId, string $date): array
    {
        $sales = Sale::where('seller_id', $sellerId)
            ->where('sale_date', $date)
            ->get();

        $totalSales = $sales->count();
        $totalAmount = $sales->sum('amount');
        $totalCommission = $this->calculateCommission($totalAmount);

        return [
            'total_sales' => $totalSales,
            'total_amount' => $totalAmount,
            'total_commission' => $totalCommission,
            'sales' => $sales,
        ];
    }

    public function allSellersDailyReport(string $date): Collection
    {
        return collect(Sale::select('seller_id')->distinct()->pluck('seller_id'))->map(function ($sellerId) use ($date) {
            return $this->sellerDailyReport($sellerId, $date);
        });
    }

    public function dailySummaryReport(string $date): array
    {
        $sales = Sale::where('sale_date', $date)->get();

        $totalSales = $sales->count();
        $totalAmount = $sales->sum('amount');
        $totalCommission = $this->calculateCommission($totalAmount);

        return [
            'total_sales' => $totalSales,
            'total_amount' => $totalAmount,
            'total_commission' => $totalCommission,
            'sales' => $sales,
        ];
    }
}
