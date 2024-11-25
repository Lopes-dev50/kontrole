<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Moviment;
use App\Models\User;
use App\Mail\InvoiceReminder;

class SendInvoiceReminder extends Command
{
    protected $signature = 'send-invoice-reminder';
    protected $description = 'Envia lembrete por e-mail para as faturas que vencem hoje';

    public function handle()
    {
        $activeUsers = User::where('status', 'ativo')->count();
    
        if ($activeUsers > 0) {
            $users = User::where('status', 'ativo')->get();
    
            foreach ($users as $user) {
                $moviments = Moviment::where('user_id', $user->id)
                    ->whereDate('data', today())
                    ->where('pago', 'N')
                    ->whereNull('sent_at')
                    ->get();
    
                foreach ($moviments as $moviment) {
                    Mail::to($user->email, $user->name)
                        ->send(new InvoiceReminder($moviment));
    
                    $moviment->sent_at = now();
                    $moviment->save();
                }
            }
    
            $this->info('Lembretes enviados para as contas vencendo.');
        } else {
            $this->info('Nenhum usuário ativo encontrado. Nenhum lembrete foi enviado.');
        }
    }
}