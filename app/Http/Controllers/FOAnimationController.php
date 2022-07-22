<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreReservationRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\Animation;
use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FOAnimationController extends Controller
{
    public function index(User $user = null): Response
    {
        $departments = Department::all();
        $tags = Category::all();
        $users = User::all();
        if($user != null){
            if($user->admin) {
                return Inertia::render('FrontOffice/Animation/Index', [
                    'items' => Animation::all(),
                    'user' => $user,
                    'datenow' => Carbon::now()->format('Y-m-d'),
                    'departments' => $departments,
                    'tags' => $tags,
                    'users' => $users
                ]);
            } else {
                $scopedAnimation = DB::table('animations')->where('department', '=', $user->department)->get();
                return Inertia::render('FrontOffice/Animation/Index', [
                    'items' =>  $scopedAnimation,
                    'user' => $user,
                    'datenow' => Carbon::now()->format('Y-m-d'),
                    'departments' => $departments,
                    'tags' => $tags,
                    'users' => $users
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
        $departments = Department::all();
        $tags = Category::all();
        $users = User::all();
        return Inertia::render('FrontOffice/Animation/More', [
            'animation' =>  $animation,
            'departments' => $departments,
            'tags' => $tags,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreReservationRequest $request
     * @param User $user
     */
    public function reservation(StoreReservationRequest $request, User $user)
    {
        $user->update($request->validated());
    }
}
