<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class EditorController extends Controller
{
    public function index()
    {
        return Inertia::render('Editor');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
