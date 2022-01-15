<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Models
 * @property string name
 * @property string localisation
 * @property string tag
 * @property string department
 * @property string places
 * @property string description
 * @property mixed id
 * @method static create(array $validated)
 * @method static find(mixed $id)
 * @method static findOrfail(mixed $article_id)
 */

class Animation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'localisation',
        'tag',
        'department',
        'places',
        'description',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s',
    ];
}
