<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::where('is_featured', true)->ordered()->take(3)->get();
        if ($featured->isEmpty()) {
            $featured = Product::ordered()->take(3)->get();
        }
        $steps = ProcessStep::ordered()->get();

        return view('home', compact('featured', 'steps'));
    }

    public function profil()
    {
        $steps = ProcessStep::ordered()->get();

        return view('profil', compact('steps'));
    }
}
