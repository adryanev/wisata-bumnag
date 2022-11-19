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

class Destination extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, PowerJoins, BlameableTrait;

    protected $fillable = [
        'name', 'description', 'address', 'phone_number', 'email', 'latitude',
        'longitude', 'opening_hours', 'closing_hours', 'instagram', 'website', 'capacity', 'working_day',
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
        return [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'numeric|required',
            'email' => 'email|required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'date_format:H:i|nullable',
            'closing_hours' => 'date_format:H:i|nullable',
            'instagram' => 'nullable',
            'website' => 'url|nullable',
            'capacity' => 'numeric|min:1|nullable',
            'destination_photo' => 'image',
            'destination_category' => 'required|numeric',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'destination_categories')->using(DestinationCategory::class);
    }
    public function certifications()
    {
        return $this->hasMany(DestinationCertification::class);
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
    public function recommendation()
    {
        return $this->hasOne(Recommendation::class);
    }

    public function souvenirs()
    {
        return $this->hasMany(Souvenir::class);
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    public function scopeWisata($query)
    {
        return $query->whereHas('categories', function ($query) {
            $category = Category::where(['id' => 1])->first()->getChildren()->pluck('id')->toArray();
            $query->whereIn('categories.id', [1, ...$category]);
        });
    }

    public function scopeAkomodasi($query)
    {
        return $query->whereHas('categories', function ($query) {
            $category = Category::where(['id' => 5])->first()->getChildren()->pluck('id')->toArray();
            $query->whereIn('categories.id', [5, ...$category]);
        });
    }

    public function scopeKuliner($query)
    {

        return $query->whereHas('categories', function ($query) {
            $category = Category::where(['id' => 4])->first()->getChildren()->pluck('id')->toArray();
            $query->whereIn('categories.id', [4, ...$category]);
        });
    }

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
        return (empty($this->getMedia('Destination'))) ? "" : $this->getMedia('Destination')->map(function ($media) {
            return $media->getFullUrl();
        });
    }
    public function getReviewAggregateAttribute()
    {
        return ['count' => $this->reviews->count(), 'rating' => $this->reviews->avg('rating')];
    }
}
