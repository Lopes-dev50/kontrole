<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DinheiroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'etiqueta' => ['required', 'string', 'max:255'],
            'motivo' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'string', 'max:255'],
            'dia' => ['required', 'string', 'max:255'],
            'parcelas' => ['required', 'integer', 'max:255'],
            
          
        ];
        
       
    }

    public function messages()
{
    return [
        'etiqueta.required' => 'Faltou',
        'motivo.required'  => 'Faltou',
        'valor.required'  => 'Faltou',
        'dia.required'  => 'Faltou',
        'parcelas.required'  => 'Faltou',
        
        
    ];
}
}
