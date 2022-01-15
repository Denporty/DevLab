<?php

namespace App\Http\Controllers;

use App\Http\Resources\BackOffice\Animation\AnimationCollection;
use App\Models\Animation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AnimationController extends Controller
{
    /**
     * @var int
     */
    protected $nbPerPage = 10;

    public function index()
    {
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
        ])->table();
    }
}
