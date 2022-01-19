<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Animation\StoreAnimationRequest;
use App\Http\Requests\Animation\StoreAnimationReservationRequest;
use App\Http\Requests\Animation\StoreReservationRequest;
use App\Models\Animation;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\Inertia;

class FOAnimationController extends Controller
{
    public function index(User $user = null): Response
    {
        if($user != null){
            if($user->admin) {
                return Inertia::render('FrontOffice/Animation/Index', [
                    'items' => Animation::all(),
                    'reservations' => Reservation::all(),
                    'user' => $user,
                    'datenow' => Carbon::now()->format('Y-m-d')
                ]);
            } else {
                $scopedAnimation = DB::table('animations')->where('department', '=', $user->department)->get();
                return Inertia::render('FrontOffice/Animation/Index', [
                    'items' =>  $scopedAnimation,
                    'user' => $user,
                    'reservations' => Reservation::all(),
                    'datenow' => Carbon::now()->format('Y-m-d')
                ]);
            }
        }
        return Inertia::render('FrontOffice/Animation/Index');
    }

    public function more(Animation $animation) {
        return Inertia::render('FrontOffice/Animation/More', [
            'animation' =>  $animation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAnimationReservationRequest $request
     * @param Animation $animation
     */
    public function update(StoreAnimationReservationRequest $request, Animation $animation)
    {
        $animation->update($request->validated());
    }
}
