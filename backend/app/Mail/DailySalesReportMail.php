<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailySalesReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sellerName;
    public $totalSales;
    public $totalAmount;
    public $totalCommission;

    public function __construct(string $sellerName, int $totalSales, float $totalAmount, float $totalCommission)
    {
        $this->sellerName = $sellerName;
        $this->totalSales = $totalSales;
        $this->totalAmount = $totalAmount;
        $this->totalCommission = $totalCommission;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Relatório Diário de Vendas'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily_sales_report'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
