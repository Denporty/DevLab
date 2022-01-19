<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Models
 * @property integer place_take
 * @property mixed id
 * @method static create(array $validated)
 * @method static find(mixed $id)
 */

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_take'
    ];
}
