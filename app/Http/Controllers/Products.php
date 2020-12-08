<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Products extends BaseController
{

    public function add(Request $request)
    {
        $product          = new \App\Models\Products();
        $product->name    = $request->name;
        $product->SKU     = $request->SKU;
        $product->barCode = $request->barCode;
    }

    public function view()
    {
        $product          = new \App\Models\Products();
        $product->where();
    }
}
