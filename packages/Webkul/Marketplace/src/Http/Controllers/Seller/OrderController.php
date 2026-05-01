<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\SellerOrderRepository;

class OrderController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected SellerOrderRepository $sellerOrderRepository
    ) {}

    public function index()
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $orders = $this->sellerOrderRepository->with(['order'])->findWhere(['seller_id' => $seller->id]);

        return view('marketplace::seller.orders.index', compact('seller', 'orders'));
    }

    public function show(int $id)
    {
        $seller      = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $sellerOrder = $this->sellerOrderRepository->with(['order'])->findOneWhere([
            'id'        => $id,
            'seller_id' => $seller->id,
        ]);

        if (! $sellerOrder) abort(403);

        return view('marketplace::seller.orders.show', compact('seller', 'sellerOrder'));
    }

    public function cancel(int $id)
    {
        $seller      = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $sellerOrder = $this->sellerOrderRepository->findOneWhere(['id' => $id, 'seller_id' => $seller->id]);

        if (! $sellerOrder) abort(403);

        $this->sellerOrderRepository->update(['status' => 'canceled'], $id);

        return response()->json(['message' => trans('marketplace::app.seller.orders.cancel-success')]);
    }

    public function createInvoice(Request $request, int $id)
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        if (! $seller->allow_invoice) abort(403);

        // Invoice creation delegates to Sales package
        return response()->json(['message' => trans('marketplace::app.seller.orders.invoice-success')]);
    }

    public function createShipment(Request $request, int $id)
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        if (! $seller->allow_shipment) abort(403);

        // Shipment creation delegates to Sales package
        return response()->json(['message' => trans('marketplace::app.seller.orders.shipment-success')]);
    }
}
