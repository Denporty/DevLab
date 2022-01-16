<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animation;
use Inertia\Response;
use Inertia\Inertia;

class FOAnimationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('FrontOffice/Animation/Index', [
            'items' =>  Animation::all()
        ]);
    }

    public function more(Animation $animation) {
        return Inertia::render('FrontOffice/Animation/More', [
            'animation' =>  $animation
        ]);
    }
}
