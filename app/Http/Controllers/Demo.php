<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Demo extends Controller
{
    function info()
    {
        $a=5;
        phpinfo();
    }
}
