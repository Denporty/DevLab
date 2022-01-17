<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'Séminaire' => 'Séminaire',
        'Pôt de départ' => 'Pôt de départ',
        'After Work' => 'After Work',
        'Activités diverses' => 'Activités diverses',
    ];

    const DEPARTMENT = [
        'Ressources Humaines' => 'Ressources Humaines',
        'Service Informatique' => 'Service Informatique',
        'Externes' => 'Externes',
        'Resources et développement' => 'Resources et développement',
        'Marketing' => 'Marketing',
        'Community Management' => 'Community Management'
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
}
