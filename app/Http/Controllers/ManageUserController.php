<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\Animation;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ManageUserController extends Controller
{
    /**
     * @var int
     */
    protected $nbPerPage = 100;

    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                if (is_array($value)) $value = implode( ',', $value);
                $query->where('name', 'LIKE', "%{$value}%");
            });
        });
        $users = QueryBuilder::for(User::class)
            ->defaultSort('created_at')
            ->allowedSorts(['id', 'name', 'created_at'])
            ->allowedFilters(['id', 'name', $globalSearch])
            ->paginate($this->nbPerPage)
            ->withQueryString();

        return Inertia::render('BackOffice/Users/Index', [
            'users' => $users,
        ])->table();
    }

    /**
     * Show the form for creating or update a resource.
     *
     * @param User|null $user
     * @return \Inertia\Response
     */
    public function form(User $user = null)
    {
        $departments = Department::all();
        return Inertia::render('BackOffice/Users/Form', [
            'user' => $user,
            'department' => $departments,
            'admin' => User::ADMIN
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(StoreUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        return redirect()->route('admin.users')->with('success', "L'utilisateur a bien été mise à jour");
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return Redirect::route('admin.users')->with('success', 'L\'utilisateur a bien été supprimé');
    }
}
