<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Marketplace\DataGrids\Admin\SellerOrderDataGrid;
use Webkul\Marketplace\Repositories\SellerOrderRepository;
use Webkul\Marketplace\Repositories\TransactionRepository;
use Webkul\Marketplace\Repositories\SellerRepository;

class OrderController extends Controller
{
    public function __construct(
        protected SellerOrderRepository $sellerOrderRepository,
        protected TransactionRepository $transactionRepository,
        protected SellerRepository $sellerRepository
    ) {}

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(SellerOrderDataGrid::class)->process();
        }

        return view('marketplace::admin.orders.index');
    }

    public function show(int $id)
    {
        $sellerOrder = $this->sellerOrderRepository->with(['seller', 'order'])->findOrFail($id);

        return view('marketplace::admin.orders.show', compact('sellerOrder'));
    }

    public function payout(Request $request, int $id)
    {
        $sellerOrder = $this->sellerOrderRepository->findOrFail($id);

        if ($sellerOrder->is_paid) {
            return response()->json(['error' => trans('marketplace::app.admin.orders.already-paid')], 422);
        }

        $this->transactionRepository->create([
            'seller_id'       => $sellerOrder->seller_id,
            'seller_order_id' => $sellerOrder->id,
            'amount'          => $sellerOrder->seller_total,
            'type'            => 'payout',
            'status'          => 'completed',
            'notes'           => $request->input('notes'),
        ]);

        $this->sellerOrderRepository->update(['is_paid' => true], $id);

        $seller = $this->sellerRepository->find($sellerOrder->seller_id);
        $this->sellerRepository->update([
            'total_payout' => $seller->total_payout + $sellerOrder->seller_total,
        ], $seller->id);

        return response()->json(['message' => trans('marketplace::app.admin.orders.payout-success')]);
    }
}
