<?php

namespace App\Http\Controllers;

use App\Models\Listey;
use Illuminate\Http\Request;

class ListKeyController extends Controller
{
    public function ListKey($key, $site,  Request $request) {
        $akey = Listey::where([ ['chave', '=', $key], ['site', '=', $site] ])->first();

        if ($akey) {
            // Encontrou uma correspondência, retornar JSON com valid=true
            return response()->json([
                "valid" => true
            ], 200);
        } else {
            // Não encontrou correspondência, retornar JSON com valid=false
            return response()->json([
                "valid" => false
            ], 404);
        }
    }
}

