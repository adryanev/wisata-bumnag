<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_SETTLEMENT = 'settlement';
    const STATUS_EXPIRE = 'expire';
    const STATUS_CAPTURE = 'capture';
    const STATUS_AUTHORIZE = 'authorize';
    const STATUS_DENY = 'deny';
    const STATUS_CANCEL = 'cancel';
    const STATUS_REFUND = 'refund';
    const STATUS_PARTIAL_REFUND = 'partial_refund';
    const STATUS_CHARGEBACK = 'chargeback';
    const STATUS_PARTIAL_CHARGEBACK = 'partial_chargeback';
    const STATUS_FAILURE = 'failure';
    const STATUS_CHALLENGED = 'challenged';

    const PAYMENT_CHANNELS = [
        'credit_card', 'mandiri_clickpay', 'cimb_clicks', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'gopay', 'indomaret',
        'danamon_online', 'akulaku', 'kioson', 'echannel',
    ];

    protected $fillable = [];

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
}
