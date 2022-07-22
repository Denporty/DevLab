<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Models\Animation;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DepartmentController extends Controller
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
        $department = QueryBuilder::for(Department::class)
            ->defaultSort('created_at')
            ->allowedSorts(['id', 'name', 'created_at'])
            ->allowedFilters(['id', 'name', $globalSearch])
            ->paginate($this->nbPerPage)
            ->withQueryString();

        return Inertia::render('BackOffice/Department/Index', [
            'departments' => $department,
            'users' => User::all(),
            'animations' => Animation::all()
        ])->table();
    }

    /**
     * Show the form for creating or update a resource.
     *
     * @param Department|null $department
     * @return Response
     */
    public function form(Department $department = null)
    {
        return Inertia::render('BackOffice/Department/Form', [
            'department' => $department,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartmentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());
        return redirect()->route('admin.departments')->with('success', "Le département a bien été crée");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreDepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(StoreDepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());
        return redirect()->route('admin.departments')->with('success', "Le département a bien été mise à jour");
    }

    /**
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        $department->delete();
        return Redirect::route('admin.departments')->with('success', 'Le departement a bien été supprimé');
    }

    public  function usersList(Department $department = null): Response
    {
        $users = User::all();
        return Inertia::render('BackOffice/Department/UsersList', [
            'department' => $department,
            'users' => $users
        ]);
    }

    public  function animationsList(Department $department = null): Response
    {
        $animations = Animation::all();
        return Inertia::render('BackOffice/Department/AnimationsList', [
            'department' => $department,
            'animations' => $animations
        ]);
    }
}
