<?php

namespace Webkul\Marketplace\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\SellerProductRepository;
use Webkul\Marketplace\Repositories\SellerReviewRepository;

class SellerController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected SellerProductRepository $sellerProductRepository,
        protected SellerReviewRepository $sellerReviewRepository
    ) {}

    public function index()
    {
        $sellers = $this->sellerRepository->getApproved();

        return view('marketplace::shop.marketplace.sellers', compact('sellers'));
    }

    public function show(string $slug)
    {
        $seller  = $this->sellerRepository->findBySlug($slug);
        if (! $seller || ! $seller->is_approved) abort(404);

        $reviews = $this->sellerReviewRepository->getApproved($seller->id);

        return view('marketplace::shop.marketplace.seller-profile', compact('seller', 'reviews'));
    }

    public function products(string $slug)
    {
        $seller   = $this->sellerRepository->findBySlug($slug);
        if (! $seller || ! $seller->is_approved) abort(404);

        $products = $this->sellerProductRepository->getApprovedProducts($seller->id);

        return view('marketplace::shop.marketplace.seller-products', compact('seller', 'products'));
    }

    public function storeReview(Request $request, string $slug)
    {
        $seller = $this->sellerRepository->findBySlug($slug);
        if (! $seller) abort(404);

        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'rating'  => 'required|integer|min:1|max:5',
            'title'   => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        $data['seller_id']   = $seller->id;
        $data['customer_id'] = auth()->guard('customer')->id();
        $data['status']      = 'pending';

        $this->sellerReviewRepository->create($data);

        return redirect()->back()->with('success', trans('marketplace::app.shop.review-success'));
    }
}
