<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function index()
    {
        $file = File::get('public/jawa-timur.json');

        return $file;
    }
}
