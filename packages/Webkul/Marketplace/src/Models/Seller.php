<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Webkul\Customer\Models\CustomerProxy;
use Webkul\Marketplace\Contracts\Seller as SellerContract;

class Seller extends Model implements SellerContract
{
    protected $table = 'mp_sellers';

    protected $fillable = [
        'customer_id', 'shop_title', 'slug', 'description',
        'meta_title', 'meta_description', 'meta_keywords',
        'logo', 'banner', 'phone', 'address', 'country', 'state',
        'city', 'postcode', 'return_policy', 'shipping_policy',
        'facebook_url', 'twitter_url', 'instagram_url', 'youtube_url',
        'commission_percentage', 'is_approved', 'is_active',
        'allow_invoice', 'allow_shipment', 'minimum_order_price',
        'total_revenue', 'total_payout',
    ];

    protected $casts = [
        'is_approved'   => 'boolean',
        'is_active'     => 'boolean',
        'allow_invoice' => 'boolean',
        'allow_shipment'=> 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerProxy::modelClass(), 'customer_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(SellerProductProxy::modelClass(), 'seller_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(SellerOrderProxy::modelClass(), 'seller_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(TransactionProxy::modelClass(), 'seller_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(SellerReviewProxy::modelClass(), 'seller_id');
    }

    public function subSellers(): HasMany
    {
        return $this->hasMany(SubSellerProxy::modelClass(), 'seller_id');
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    public function getBannerUrlAttribute(): ?string
    {
        return $this->banner ? Storage::url($this->banner) : null;
    }

    public function getRemainingPayoutAttribute(): float
    {
        return max(0, $this->total_revenue - $this->total_payout);
    }
}
