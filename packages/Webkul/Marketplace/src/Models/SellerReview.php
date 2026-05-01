<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Marketplace\Contracts\SellerReview as SellerReviewContract;

class SellerReview extends Model implements SellerReviewContract
{
    protected $table = 'mp_seller_reviews';

    protected $fillable = [
        'seller_id', 'customer_id', 'name', 'email', 'rating', 'title', 'comment', 'status',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(SellerProxy::modelClass(), 'seller_id');
    }
}
