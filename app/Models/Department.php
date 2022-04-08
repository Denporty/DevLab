<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Models
 * @property string name
 * @property mixed id
 * @method static create(array $validated)
 * @method static find(mixed $id)
 * @method static findOrfail(mixed $article_id)
 */

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
