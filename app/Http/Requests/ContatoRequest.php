<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
            'nome' => 'required|string|alpha|min:5',
            'idade' => 'required|integer',
            'email' => 'email:rfc,dns',
        ];
    }

    public function messages()
    {
        return [
            'min' => 'Campo deve ter no mínimo 5 caractere',
            'integer' => 'Campo preenchido somente com número ',
            'email' => 'E-mail não é válido ',
            'alpha' => 'Inserir sommente letra alfabetica'
        ];
    }
}