<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Marketplace\Contracts\SubSeller as SubSellerContract;

class SubSeller extends Model implements SubSellerContract
{
    protected $table = 'mp_sub_sellers';

    protected $fillable = [
        'seller_id', 'customer_id', 'name', 'email', 'password', 'permissions', 'is_active',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'permissions' => 'array',
        'is_active'   => 'boolean',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(SellerProxy::modelClass(), 'seller_id');
    }
}
