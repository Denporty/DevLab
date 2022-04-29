<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Article
 * @package App\Models
 * @property string name
 * @property string localisation
 * @property string tag
 * @property string department
 * @property integer places
 * @property string description
 * @property string map
 * @property string section_title
 * @property string description_section
 * @property boolean active_section
 * @property string summary
 * @property mixed id
 * @method static create(array $validated)
 * @method static find(mixed $id)
 * @method static findOrfail(mixed $article_id)
 */

class Animation extends Model
{
    use HasFactory;

    const CATEGORIES = [
        1 => 'Séminaire',
        2 => 'Pôt de départ',
        3 => 'After Work',
        4 => 'Activités diverses',
    ];

    const DEPARTMENT = [
        1 => 'Ressources Humaines',
        2 => 'Service Informatique',
        3 => 'Externes',
        4 => 'Resources et développement',
        5 => 'Marketing',
        6 => 'Community Management'
    ];

    protected $fillable = [
        'name',
        'localisation',
        'tag',
        'department',
        'places',
        'description',
        'map',
        'section_title',
        'description_section',
        'active_section',
        'start_date',
        'end_date',
        'summary'
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    /**
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class);
    }

    /**
     * @return HasOne
     */
    public function tag(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}
