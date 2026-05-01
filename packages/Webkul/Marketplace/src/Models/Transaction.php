<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Marketplace\Contracts\Transaction as TransactionContract;

class Transaction extends Model implements TransactionContract
{
    protected $table = 'mp_transactions';

    protected $fillable = [
        'seller_id', 'seller_order_id', 'amount', 'type', 'status', 'transaction_id', 'notes',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(SellerProxy::modelClass(), 'seller_id');
    }

    public function sellerOrder(): BelongsTo
    {
        return $this->belongsTo(SellerOrderProxy::modelClass(), 'seller_order_id');
    }
}
