<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Article
 * @package App\Models
 * @property string budget
 * @property mixed $id
 * @method static create(array $validated)
 * @method static find(mixed $id)
 * @method static findOrfail(mixed $article_id)
 */

class GlobalBudget extends Model
{
    use HasFactory;


    protected $fillable = [
        'budget'
    ];

    /**
     * @return HasOne
     */
    public function animation(): HasOne
    {
        return $this->hasOne(Animation::class);
    }
}
