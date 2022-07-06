<?php

namespace App\Models;

use App\Services\CloudinaryService;
use Carbon\Carbon;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;

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
        'summary',
        'image',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    /**
     * Setter : image
     * @param $value
     * @throws ApiError
     */
    public function setImageAttribute($value){
        if ($value instanceof UploadedFile || substr($value, 0, 5) == 'data:') {
            $value = CloudinaryService::upload($value);
        }
        $this->attributes['image'] = $value;
    }

    /**
     * @param $value
     * @return array|string
     */
    public function getImageAttribute($value): array|string
    {
        return (!str_contains($value, 'upload/f_auto,q_auto')) ? str_replace('upload/', 'upload/f_auto,q_auto,w_auto:100:1000/', $value) : $value;
    }

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
