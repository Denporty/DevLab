<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\Inertia;

class FOAnimationController extends Controller
{
    public function index(User $user = null): Response
    {
        if($user != null){
            if($user->department === "ADMIN") {
                return Inertia::render('FrontOffice/Animation/Index', [
                    'items' => Animation::all(),
                    'user' => $user
                ]);
            } else {
                $scopedAnimation = DB::table('animations')->where('department', '=', $user->department)->get();
                return Inertia::render('FrontOffice/Animation/Index', [
                    'items' =>  $scopedAnimation,
                    'user' => $user
                ]);
            }
        }
        return Inertia::render('FrontOffice/Animation/Index');
    }

    public function indexGuest(): Response
    {
        return Inertia::render('FrontOffice/Animation/Index');
    }

    public function more(Animation $animation) {
        return Inertia::render('FrontOffice/Animation/More', [
            'animation' =>  $animation
        ]);
    }
}
