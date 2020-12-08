<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Demo extends Controller
{
    public function info()
    {
        $a=5;
        phpinfo();
    }
}
