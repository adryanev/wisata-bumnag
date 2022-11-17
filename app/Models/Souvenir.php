<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Souvenir extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, PowerJoins;

    protected $fillable = ['name', 'is_free', 'price', 'term_and_conditions', 'quantity', 'description', 'destination_id'];
    protected $casts = [
        'is_free' => 'boolean',
    ];
    protected $appends = [
        'photos',

    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            'name' => 'required',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function ordersDetail()
    {
        return $this->morphMany(OrderDetail::class, 'orderable');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'souvenir_categories')->using(SouvenirCategory::class);
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0);
    }
    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
    public function registerMediaCollections(Media $media = null): void
    {
        // $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }
    public function getPhotosAttribute()
    {
        return (empty($this->getMedia('Souvenir'))) ? "" : $this->getMedia('Souvenir')->map(function ($media) {
            return $media->getFullUrl();
        });
    }
}
