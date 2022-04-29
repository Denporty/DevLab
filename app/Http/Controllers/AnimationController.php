<?php

namespace App\Http\Controllers;

use App\Http\Requests\Animation\StoreAnimationRequest;
use App\Http\Resources\BackOffice\Animation\AnimationCollection;
use App\Models\Animation;
use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AnimationController extends Controller
{
    /**
     * @var int
     */
    protected $nbPerPage = 100;

    public function index()
    {
        $users = User::all();
        $department = Department::all();
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                if (is_array($value)) $value = implode( ',', $value);
                $query->where('name', 'LIKE', "%{$value}%");
            });
        });
        $animations = QueryBuilder::for(Animation::class)
            ->defaultSort('created_at')
            ->allowedSorts(['id', 'name', 'created_at'])
            ->allowedFilters(['id', 'name', $globalSearch])
            ->paginate($this->nbPerPage)
            ->withQueryString();

        return Inertia::render('BackOffice/Animation/Index', [
            'animations' => new AnimationCollection($animations),
            'departments' => $department,
            'users' => $users
        ])->table();
    }

    /**
     * Show the form for creating or update a resource.
     *
     * @param Animation|null $animation
     * @return \Inertia\Response
     */
    public function form(Animation $animation = null)
    {
        $departments = Department::all();
        $categories = Category::all();
        return Inertia::render('BackOffice/Animation/Form', [
            'animation' => $animation,
            'admin' => User::ADMIN,
            'department' => $departments,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAnimationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAnimationRequest $request): RedirectResponse
    {
        Animation::create($request->validated());
        return redirect()->route('admin.animation')->with('success', "L'animation a bien été crée");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAnimationRequest $request
     * @param Animation $animation
     * @return RedirectResponse
     */
    public function update(StoreAnimationRequest $request, Animation $animation): RedirectResponse
    {
        $animation->update($request->validated());
        return redirect()->route('admin.animation')->with('success', "L'animation a bien été mise à jour");
    }

    /**
     * @param Animation $animation
     * @return RedirectResponse
     */
    public function destroy(Animation $animation): RedirectResponse
    {
        $animation->delete();
        return Redirect::route('admin.animation')->with('success', 'L\'article a bien été supprimé');
    }
}
