<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimationController extends Controller
{
    public function index()
    {
        return Inertia::render('BackOffice/Animation/Index', []);
    }
}
