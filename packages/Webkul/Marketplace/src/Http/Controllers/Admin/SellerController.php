<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Marketplace\DataGrids\Admin\SellerDataGrid;
use Webkul\Marketplace\Repositories\SellerRepository;

class SellerController extends Controller
{
    public function __construct(protected SellerRepository $sellerRepository) {}

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(SellerDataGrid::class)->process();
        }

        return view('marketplace::admin.sellers.index');
    }

    public function show(int $id)
    {
        $seller = $this->sellerRepository->with(['customer', 'products', 'orders'])->findOrFail($id);

        return view('marketplace::admin.sellers.show', compact('seller'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'shop_title'          => 'required|string|max:255',
            'commission_percentage' => 'required|numeric|min:0|max:100',
            'minimum_order_price' => 'required|numeric|min:0',
            'allow_invoice'       => 'boolean',
            'allow_shipment'      => 'boolean',
            'is_active'           => 'boolean',
        ]);

        $this->sellerRepository->update($data, $id);

        return redirect()->route('admin.marketplace.sellers.show', $id)
            ->with('success', trans('marketplace::app.admin.sellers.update-success'));
    }

    public function destroy(int $id)
    {
        $this->sellerRepository->delete($id);

        return response()->json(['message' => trans('marketplace::app.admin.sellers.delete-success')]);
    }

    public function approve(int $id)
    {
        $this->sellerRepository->update(['is_approved' => true], $id);

        return response()->json(['message' => trans('marketplace::app.admin.sellers.approve-success')]);
    }

    public function disapprove(int $id)
    {
        $this->sellerRepository->update(['is_approved' => false], $id);

        return response()->json(['message' => trans('marketplace::app.admin.sellers.disapprove-success')]);
    }

    public function massDestroy()
    {
        foreach (request()->input('indices', []) as $id) {
            $this->sellerRepository->delete($id);
        }

        return response()->json(['message' => trans('marketplace::app.admin.sellers.mass-delete-success')]);
    }

    public function massApprove()
    {
        foreach (request()->input('indices', []) as $id) {
            $this->sellerRepository->update(['is_approved' => true], $id);
        }

        return response()->json(['message' => trans('marketplace::app.admin.sellers.mass-approve-success')]);
    }
}
