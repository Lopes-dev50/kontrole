<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Moviment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

//Para hacer un hashing de password, hay que invocar a la fachada Hash
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        // Validaciones para registrar un usuario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        // Creamos al usuario
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        //$user->password = $request->password; //sin hashing
        $user->password = Hash::make($request->password);
        $user->save();

        // La API nos devuelve una respuesta
        return response()->json([
            "status" => 1,
            "msg" => 'Alta de Usuario exitosa'
        ]);

    }


//===========================================================
   public function login(Request $request) {
   // Validaciones para hacer el login
    $request->validate([
        "email" => "required|email",
        "password" => "required",
      
    ]);
    $user = User::where([["email", "=", $request->email]])->first();
    if(isset($user->id)){
        if(Hash::check($request->password, $user->password)) {
           $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                "status" => 1,
                "message" => "¡Usuario logueado exitosamente!",
                "token" => $token
            ]);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "La password es incorrecta"
            ], 404);
        }
    }else{
        return response()->json( [
            "status" => 0,
            "message" => "Usuario no registrado"
        ], 404);
    }
   }
//==========================fim login============





    public function userProfile() {
        return response()->json([

            "data" => Auth::user()
        ]);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => 1,
            "message" => "Cierre de sesión OK"
        ]);
    }

    //====================================painel

public function AppPainel($id, Request $request) {

   
 
 
        if (User::where('id', $id)->exists()) {
            $corretor = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($corretor, 200);
          } else {
            return response()->json([
              "message" => "Corretor não encontrato"
            ], 404);
          }
     
     }


    
    











}
