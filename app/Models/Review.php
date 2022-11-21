<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use PhpParser\Node\Expr\FuncCall;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Review extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, PowerJoins;

    protected $fillable = [
        'reviewable_type',
        'reviewable_id',
        'rating',
        'title',
        'description',
        'user_id',
        'order_detail_id',
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
    public function ticket()
    {
        return $this->morphTo(Ticket::class);
    }
    public function package()
    {
        return $this->morphTo(Package::class);
    }
    public function souvenir()
    {
        return $this->morphTo(Souvenir::class);
    }
    public function destination()
    {
        return $this->morphTo(Destination::class);
    }
    public function reviewable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

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
        return (empty($this->getMedia('Review'))) ? "" : $this->getMedia('Review')->map(function ($media) {
            return $media->getFullUrl();
        });
    }
}
