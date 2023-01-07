<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|unique:people,name,' . $this->id,
            'email'     => 'required|email|unique:people,email,' . $this->id,
            'phone'     => 'nullable',
            'whatsapp'  => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'O nome é obrigatório',
            'name.unique'       => 'O nome já existe',
            'email.required'    => 'O e-mail é obrigatório',
            'email.unique'      => 'O e-mail já existe',
        ];
    }
}
