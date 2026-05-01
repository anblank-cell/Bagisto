<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\ReturnRequest as ReturnRequestContract;

class ReturnRequest extends Model implements ReturnRequestContract
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'rma_requests';

    protected $fillable = [
        'customer_id',
        'order_id',
        'product_sku',
        'product_name',
        'product_quantity',
        'status',
        'reason',
        'admin_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Add your attribute casts here
    ];
    
}