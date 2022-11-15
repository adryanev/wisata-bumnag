<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone_number',
        'email',
        'latitude',
        'longitude',
        'start_date',
        'end_date',
        'term_and_condition',
        'instagram',
        'website',
        'capacity',
    ];

    protected $appends = [
        'photos',
        // 'review_aggregate',
        // 'tickets',
    ];
    protected $casts = [
	'latitude' => 'double',
	'longitude' => 'double',
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

    public function orders()
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

    public function scopeUpcoming($query)
    {

        return $query->where('start_date', '>', now()->addHours(12));
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
        return (empty($this->getMedia('Event'))) ? "" : $this->getMedia('Event')->map(function ($media) {
            return $media->getFullUrl();
        });
    }
}
