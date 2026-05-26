<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $username = 'admin'; // Логин
        $password = '185225'; // Пароль

        if ($request->getUser() == $username && $request->getPassword() == $password) {
            return $next($request);
        }

        // Если пароль неверный или не введен — браузер снова покажет окно
        return response('Требуется авторизация', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
