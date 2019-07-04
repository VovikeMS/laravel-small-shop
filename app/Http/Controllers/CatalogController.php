<?php

namespace App\Http\Controllers;

class CatalogController extends Controller
{
    /**
     * Catalog handler
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('catalog');
    }
}
