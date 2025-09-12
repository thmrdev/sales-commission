<?php

namespace App\Jobs;

use App\Mail\DailySalesReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailySalesReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $sellerEmail;
    public string $sellerName;
    public int $totalSales;
    public float $totalAmount;
    public float $totalCommission;

    public function __construct(string $sellerEmail, string $sellerName, int $totalSales, float $totalAmount, float $totalCommission)
    {
        $this->sellerEmail = $sellerEmail;
        $this->sellerName = $sellerName;
        $this->totalSales = $totalSales;
        $this->totalAmount = $totalAmount;
        $this->totalCommission = $totalCommission;
    }

    public function handle(): void
    {
        Mail::to($this->sellerEmail)->send(
            new DailySalesReportMail(
                $this->sellerName,
                $this->totalSales,
                $this->totalAmount,
                $this->totalCommission
            )
        );
    }
}
