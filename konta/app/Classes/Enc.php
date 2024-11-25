<?php

namespace App\Classes;

class Enc{

    public function encriptar($valor){

       return bin2hex(openssl_encrypt($valor, 'AES-256-CBC', 'UYTg45tFi8zZoKLhyt97BvfdKiplwqmN', OPENSSL_RAW_DATA, 'AQ3wDzEyxEe917Xn'));
    }


    public function desencriptar($valor_encriptado ){

       // verifica se hash é valido
       if(strlen($valor_encriptado)%2 !=0){
             return null;
       }

          return openssl_decrypt(hex2bin($valor_encriptado), 'AES-256-CBC', 'UYTg45tFi8zZoKLhyt97BvfdKiplwqmN', OPENSSL_RAW_DATA, 'AQ3wDzEyxEe917Xn');
    }
}
