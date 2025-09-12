<?php

namespace App\Jobs;

use App\Mail\DailySummaryReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailySummaryReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $adminEmail;
    public string $adminName;
    public int $totalSales;
    public float $totalAmount;
    public float $totalCommission;

    public function __construct(string $adminEmail, string $adminName, int $totalSales, float $totalAmount, float $totalCommission)
    {
        $this->adminEmail = $adminEmail;
        $this->adminName = $adminName;
        $this->totalSales = $totalSales;
        $this->totalAmount = $totalAmount;
        $this->totalCommission = $totalCommission;
    }

    public function handle(): void
    {
        Mail::to($this->adminEmail)->send(
            new DailySummaryReportMail(
                $this->adminName,
                $this->totalSales,
                $this->totalAmount,
                $this->totalCommission
            )
        );
    }
}
