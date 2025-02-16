<?php

namespace App\Http\Requests\Auth;

use App\DTO\Auth\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login'                 => ['required', 'string', 'min:8', 'max:225', 'unique:users,name'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'max:18', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function messages() :array
    {
        return [
            'login.required'      => 'Поле "Логин" обязательно для заполнения.',
            'login.string'        => 'Поле "Логин" должно быть строкой.',
            'login.min'           => 'Минимальная длина логина :min символов.',
            'login.max'           => 'Максимальная длина логина :max символов.',
            'login.unique'        => 'Пользователь с таким логином уже существует.',

            'email.required'      => 'Поле "Email" обязательно для заполнения.',
            'email.email'         => 'Поле "Email" должно быть корректным email-адресом.',
            'email.unique'        => 'Пользователь с таким email-адресом уже существует.',

            'password.required'   => 'Поле "Пароль" обязательно для заполнения.',
            'password.string'     => 'Поле "Пароль" должно быть строкой.',
            'password.min'        => 'Минимальная длина пароля :min символов.',
            'password.max'        => 'Максимальная длина пароля :max символов.',
            'password.confirmed'  => 'Пароли не совпадают.',

            'password_confirmation.required' => 'Поле "Подтвердите пароль" обязательно для заполнения.'
        ];
    }

    public function requestData(): RegisterDTO
    {
        return new RegisterDTO([
            'login'                  => $this->input('login'),
            'email'                  => $this->input('email'),
            'password'               => $this->input('password'),
            'password_confirmation'  => $this->input('password_confirmation'),
        ]);
    }
}
