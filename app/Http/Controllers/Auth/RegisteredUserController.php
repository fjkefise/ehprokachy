<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[А-Яа-яЁё\s]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'driver_license' => ['required', 'string', 'regex:/^\d{2}\s[A-ZА-Я]{2}\s\d{6}$/'],
        ], [
            'full_name.required' => 'Поле ФИО обязательно для заполнения',
            'full_name.regex' => 'ФИО может содержать только русские буквы и пробелы',
            'email.required' => 'Поле Email обязательно для заполнения',
            'email.email' => 'Введите корректный email адрес',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Поле Пароль обязательно для заполнения',
            'password.confirmed' => 'Пароли не совпадают',
            'driver_license.required' => 'Поле Номер водительского удостоверения обязательно для заполнения',
            'driver_license.regex' => 'Номер водительского удостоверения должен быть в формате: 99 AA 123456',
        ]);

        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'driver_license' => $request->driver_license,
            'is_admin' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
