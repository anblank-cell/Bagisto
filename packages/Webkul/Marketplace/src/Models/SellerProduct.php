<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Product\Models\ProductProxy;
use Webkul\Marketplace\Contracts\SellerProduct as SellerProductContract;

class SellerProduct extends Model implements SellerProductContract
{
    protected $table = 'mp_seller_products';

    protected $fillable = [
        'seller_id', 'product_id', 'is_owner', 'is_approved', 'price', 'quantity',
    ];

    protected $casts = [
        'is_owner'    => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(SellerProxy::modelClass(), 'seller_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductProxy::modelClass(), 'product_id');
    }
}
