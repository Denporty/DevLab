<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Animation;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
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
        $category = QueryBuilder::for(Category::class)
            ->defaultSort('created_at')
            ->allowedSorts(['id', 'name', 'created_at'])
            ->allowedFilters(['id', 'name', $globalSearch])
            ->paginate($this->nbPerPage)
            ->withQueryString();

        return Inertia::render('BackOffice/Category/Index', [
            'categories' => $category,
            'animations' => Animation::all()
        ])->table();
    }

    /**
     * Show the form for creating or update a resource.
     *
     * @param Category|null $category
     * @return Response
     */
    public function form(Category $category = null)
    {
        return Inertia::render('BackOffice/Category/Form', [
            'category' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return redirect()->route('admin.categories')->with('success', "Le département a bien été crée");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('admin.categories')->with('success', "Le département a bien été mise à jour");
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return Redirect::route('admin.categories')->with('success', 'Le departement a bien été supprimé');
    }

    public  function animationList(Category $category = null): Response
    {
        $animations = Animation::all();
        return Inertia::render('BackOffice/Category/AnimationsList', [
            'category' => $category,
            'animations' => $animations
        ]);
    }
}
