<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SalesReportService;
use App\Jobs\SendDailySalesReportJob;
use App\Models\Seller;

class SendDailySalesReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:daily-sales {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily sales reports to all sellers';

    /**
     * Execute the console command.
     */
    public function handle(SalesReportService $reportService): void
    {
        $date = $this->argument('date') ?? now()->toDateString();

        $this->info("Generating sales reports for {$date}...");

        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            $report = $reportService->sellerDailyReport($seller->id, $date);

            dispatch(new SendDailySalesReportJob(
                $seller->email,
                $seller->name,
                $report['total_sales'],
                $report['total_amount'],
                $report['total_commission']
            ));

            $this->info("Queued report for {$seller->name}");
        }

        $this->info("All reports queued successfully!");
    }
}
