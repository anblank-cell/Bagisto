<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected TransactionRepository $transactionRepository
    ) {}

    public function index()
    {
        $seller       = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $transactions = $this->transactionRepository->findWhere(['seller_id' => $seller->id]);

        return view('marketplace::seller.transactions.index', compact('seller', 'transactions'));
    }
}
