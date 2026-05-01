<?php

namespace Webkul\Marketplace\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Webkul\Marketplace\Models\Seller;
use Webkul\Marketplace\Models\SellerProduct;
use Webkul\Marketplace\Models\SellerOrder;
use Webkul\Marketplace\Models\Transaction;
use Webkul\Marketplace\Models\SellerReview;
use Webkul\Marketplace\Models\FlagReason;
use Webkul\Marketplace\Models\SubSeller;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        Seller::class,
        SellerProduct::class,
        SellerOrder::class,
        Transaction::class,
        SellerReview::class,
        FlagReason::class,
        SubSeller::class,
    ];
}
