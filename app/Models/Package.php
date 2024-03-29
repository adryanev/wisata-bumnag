<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Package extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, PowerJoins, BlameableTrait;

    protected $fillable = [
        'name',
        'price_include',
        'price_exclude',
        'activities',
        'destination',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected $appends = [
        'photos',
        // 'review_aggregate',
        // 'tickets',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'package_categories')->using(PackageCategory::class);
    }
    public function ordersDetail()
    {
        return $this->morphMany(OrderDetail::class, 'orderable');
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }
    public function amenities()
    {
        return $this->hasMany(PackageAmenities::class);
    }

    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */


    public function scopeCategory($query, $id)
    {

        return $query->whereHas('categories', function ($query) use ($id) {
            $category = Category::where(['id' => $id])->first()->getChildren()->pluck('id')->toArray();
            $query->whereIn('categories.id', [$id, ...$category]);
        });
    }

    public function scopeLowestPriceTicket($query)
    {
        return $query->whereHas('tickets', function ($query) {
            $query->orderBy('tickets.price', 'ASC')->first();
        });
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
        return (empty($this->getMedia('Package'))) ? "" : $this->getMedia('Package')->map(function ($media) {
            return $media->getFullUrl();
        });
    }
    public function getReviewAggregateAttribute()
    {
        return ['count' => $this->reviews->count(), 'rating' => $this->reviews->avg('rating')];
    }
}
