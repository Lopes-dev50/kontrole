<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AvisoRenovacaoAssinatura;

class RenovarAssinaturas extends Command
{
    protected $signature = 'assinar:renovar';

    protected $description = 'Verifica as assinaturas expiradas e envia e-mails de renovação';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $usuarios = User::where('status', 'ativo')->get();
        //$usuarios = DB::table('users')->where('status', 'ativo')->get();

        foreach ($usuarios as $usuario) {
            $fimDate = Carbon::parse($usuario->fim_date);
           
            if (Carbon::now()->greaterThanOrEqualTo($fimDate)) {
                // A assinatura expirou, alterar o status para "desativado"
                $usuario->status = 'desativado';
                $usuario->plano = 'Free';
                $usuario->save();

                // Enviar e-mail de aviso para renovar a assinatura
                Mail::to($usuario->email)->send(new AvisoRenovacaoAssinatura($usuario));
            }
        }

        $this->info('As assinaturas foram verificadas e atualizadas com sucesso.');
    }
}