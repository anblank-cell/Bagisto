<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Marketplace\DataGrids\Admin\TransactionDataGrid;
use Webkul\Marketplace\Repositories\TransactionRepository;
use Webkul\Marketplace\Repositories\SellerRepository;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionRepository $transactionRepository,
        protected SellerRepository $sellerRepository
    ) {}

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(TransactionDataGrid::class)->process();
        }

        return view('marketplace::admin.transactions.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'seller_id'      => 'required|exists:mp_sellers,id',
            'amount'         => 'required|numeric|min:0.01',
            'transaction_id' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $data['type']   = 'payout';
        $data['status'] = 'completed';

        $this->transactionRepository->create($data);

        $seller = $this->sellerRepository->find($data['seller_id']);
        $this->sellerRepository->update([
            'total_payout' => $seller->total_payout + $data['amount'],
        ], $seller->id);

        return response()->json(['message' => trans('marketplace::app.admin.transactions.create-success')]);
    }
}
