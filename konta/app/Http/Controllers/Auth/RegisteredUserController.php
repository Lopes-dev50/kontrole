<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BoasVindas;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'origem' => ['required', 'string', 'max:255'],
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5',
            
        ]);

       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'origem' => $request->origem,
            'valorpormes' => 7,
            'valorporano' => 49,
            'inicio_date' => Carbon::now()->format('Y-m-d'),
            'fim_date' => Carbon::now()->addDays(60)->format('Y-m-d')
            
                        
        ]);

       

        event(new Registered($user));

        Auth::login($user);

        $mailData = [
       
            'title' => 'Ola! '.Auth::user()->name,
            'body' => ' Obrigado por se juntar à plataforma Kontrole! Estamos entusiasmados por ter você como parte da nossa comunidade e mal podemos esperar para ajudá-lo a gerenciar suas finanças com facilidade.',
            
            
          ];
        
          Mail::to(Auth::user()->email)->send(new BoasVindas($mailData));

        return redirect(RouteServiceProvider::HOME);
    }
}
