<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * المسارات المستثناة من حماية CSRF.
     *
     * @var array
     */
    protected $except = [
        'logout',
        'api/*',
        'exam',  // استثناء صفحة الامتحان
        'exam/save-answer', // استثناء حفظ الإجابات
    ];
}
