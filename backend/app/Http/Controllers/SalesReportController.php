<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalesReportService;
use App\Jobs\SendDailySalesReportJob;
use App\Models\Seller;

class SalesReportController extends Controller
{
    protected SalesReportService $reportService;

    public function __construct(SalesReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function sendSellerReport(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'date' => 'nullable|date',
        ]);

        $seller = Seller::findOrFail($request->seller_id);
        $date = $request->date ?? now()->toDateString();

        $report = $this->reportService->sellerDailyReport($seller->id, $date);

        SendDailySalesReportJob::dispatch(
            $seller->email,
            $seller->name,
            $report['total_sales'],
            $report['total_amount'],
            $report['total_commission']
        );

        return response()->json([
            'message' => "Relatório para {$seller->name} solicitado com sucesso!",
        ]);
    }
}
