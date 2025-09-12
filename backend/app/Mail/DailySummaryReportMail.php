<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailySummaryReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminName;
    public $totalSales;
    public $totalAmount;
    public $totalCommission;

    public function __construct(string $adminName, int $totalSales, float $totalAmount, float $totalCommission)
    {
        $this->adminName = $adminName;
        $this->totalSales = $totalSales;
        $this->totalAmount = $totalAmount;
        $this->totalCommission = $totalCommission;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resumo Diário Geral de Vendas'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily_summary_report'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
