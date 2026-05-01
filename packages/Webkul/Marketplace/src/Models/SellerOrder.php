<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webkul\Sales\Models\OrderProxy;
use Webkul\Marketplace\Contracts\SellerOrder as SellerOrderContract;

class SellerOrder extends Model implements SellerOrderContract
{
    protected $table = 'mp_seller_orders';

    protected $fillable = [
        'seller_id', 'order_id', 'base_grand_total', 'grand_total',
        'commission', 'seller_total', 'status', 'is_paid',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(SellerProxy::modelClass(), 'seller_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderProxy::modelClass(), 'order_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(TransactionProxy::modelClass(), 'seller_order_id');
    }
}
