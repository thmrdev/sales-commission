<?php

namespace Tests\Unit\Services;

use App\Models\Sale;
use App\Models\Seller;
use App\Services\SalesReportService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesReportServiceTest extends TestCase
{
    use RefreshDatabase;

    protected SalesReportService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SalesReportService(10);
    }

    public function test_calculate_commission(): void
    {
        $amount = 1000;
        $commission = $this->service->calculateCommission($amount);

        $this->assertEquals(100, $commission);
    }

    public function test_seller_daily_report(): void
    {
        $seller = Seller::factory()->create();
        $date = '2025-09-11';

        Sale::factory()->create([
            'seller_id' => $seller->id,
            'amount' => 500,
            'sale_date' => $date,
        ]);

        Sale::factory()->create([
            'seller_id' => $seller->id,
            'amount' => 300,
            'sale_date' => $date,
        ]);

        $report = $this->service->sellerDailyReport($seller->id, $date);

        $this->assertEquals(2, $report['total_sales']);
        $this->assertEquals(800, $report['total_amount']);
        $this->assertEquals(80, $report['total_commission']);
        $this->assertCount(2, $report['sales']);
    }

    public function test_all_sellers_daily_report(): void
    {
        $seller1 = Seller::factory()->create();
        $seller2 = Seller::factory()->create();
        $date = '2025-09-11';

        Sale::factory()->create([
            'seller_id' => $seller1->id,
            'amount' => 200,
            'sale_date' => $date,
        ]);

        Sale::factory()->create([
            'seller_id' => $seller2->id,
            'amount' => 300,
            'sale_date' => $date,
        ]);

        $reports = $this->service->allSellersDailyReport($date);

        $this->assertCount(2, $reports);

        $this->assertEquals(200, $reports[0]['total_amount']);
        $this->assertEquals(300, $reports[1]['total_amount']);
    }

    public function test_daily_summary_report(): void
    {
        $seller1 = Seller::factory()->create();
        $seller2 = Seller::factory()->create();
        $date = '2025-09-11';

        Sale::factory()->create([
            'seller_id' => $seller1->id,
            'amount' => 400,
            'sale_date' => $date,
        ]);

        Sale::factory()->create([
            'seller_id' => $seller2->id,
            'amount' => 600,
            'sale_date' => $date,
        ]);

        $report = $this->service->dailySummaryReport($date);

        $this->assertEquals(2, $report['total_sales']);
        $this->assertEquals(1000, $report['total_amount']);
        $this->assertEquals(100, $report['total_commission']);
        $this->assertCount(2, $report['sales']);
    }
}
