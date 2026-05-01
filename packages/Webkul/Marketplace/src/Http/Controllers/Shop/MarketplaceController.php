<?php

namespace Webkul\Marketplace\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\SellerProductRepository;

class MarketplaceController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected SellerProductRepository $sellerProductRepository
    ) {}

    public function index()
    {
        $topSellers = $this->sellerRepository->getTopSellers(6);

        return view('marketplace::shop.marketplace.index', compact('topSellers'));
    }
}
