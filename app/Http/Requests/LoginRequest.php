<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];
    }

    // Este método se ejecuta inmediatamente despues de que laravel haya hecho la validación de campos
    public function failedValidation(Validator $validator)
    {
        // Obtener el primer error con su campo
        $firstError = $validator->errors()->keys()[0];
        $errorMessage = $validator->errors()->first();

        // Devolver el error junto con el campo que lo generó
        throw new HttpResponseException(
            response()->json(
                [
                    $firstError => $errorMessage,
                ],
                422,
            ),
        );
    }

    // Este método se jecuta después de las validaciones en los campos, de haber algún error hace el match con el campó correspondiente y te devuelve ese valor con el texto personalizado
    public function messages(): array
    {
        return [
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.exists' => 'El correo electrónico no está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];
    }
}
