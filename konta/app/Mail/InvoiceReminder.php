<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Moviment;
use Carbon\Carbon;

class InvoiceReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $invoiceAmount;
    public $invoiceLabel;
    public $invoiceLabelmotivo;

    public function __construct(Moviment $invoice)
    {
        $this->data = $invoice->data;
        $this->invoiceAmount = number_format($invoice->valor/100, 2, ',', '.') ;
        $this->invoiceLabel = $invoice->etiqueta;
        $this->invoiceLabelmotivo = $invoice->motivo;
       
    }

    public function build()
    {
        $dueDate = Carbon::parse($this->data)->locale('pt_BR')->format('d/m/Y');
       
        return $this->subject('Lembrete de fatura')
                    ->markdown('emails.invoice-reminder')
                    ->with([
                        'invoiceAmount' => $this->invoiceAmount,
                        'dueDate' => $dueDate,
                        'invoiceLabel' => $this->invoiceLabel,
                        'invoiceLabelmotivo' => $this->invoiceLabelmotivo,
                    ]);
    }
}