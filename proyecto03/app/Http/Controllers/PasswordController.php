<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;

class PasswordController extends Controller
{
    public function index()
    {
        $passwords = Password::orderBy('created_at', 'desc')->get();
        return view('passwords.index', compact('passwords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'length' => 'required|integer|min:6|max:64',
        ]);

        $length = $request->length;
        $chars = 'abcdefghijklmnopqrstuvwxyz';

        if ($request->has('include_upper')) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($request->has('include_numbers')) $chars .= '0123456789';
        if ($request->has('include_symbols')) $chars .= '!@#$%^&*()-_=+[]{};:,.<>?';

        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $saved = Password::create([
            'value' => $password,
            'length' => $length,
            'include_upper' => $request->has('include_upper'),
            'include_numbers' => $request->has('include_numbers'),
            'include_symbols' => $request->has('include_symbols'),
        ]);

        return redirect()->route('passwords.index')->with('success', 'Contraseña generada: ' . $saved->value);
    }
}