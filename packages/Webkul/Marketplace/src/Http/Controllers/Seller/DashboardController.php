<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\SellerOrderRepository;
use Webkul\Marketplace\Repositories\SellerProductRepository;

class DashboardController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected SellerOrderRepository $sellerOrderRepository,
        protected SellerProductRepository $sellerProductRepository
    ) {}

    public function index()
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        $stats = [
            'total_products'  => $this->sellerProductRepository->findWhere(['seller_id' => $seller->id])->count(),
            'total_orders'    => $this->sellerOrderRepository->findWhere(['seller_id' => $seller->id])->count(),
            'total_revenue'   => $seller->total_revenue,
            'total_payout'    => $seller->total_payout,
            'remaining_payout'=> $seller->remaining_payout,
        ];

        $recentOrders = $this->sellerOrderRepository
            ->with(['order'])
            ->findWhere(['seller_id' => $seller->id]);

        return view('marketplace::seller.dashboard.index', compact('seller', 'stats', 'recentOrders'));
    }
}
