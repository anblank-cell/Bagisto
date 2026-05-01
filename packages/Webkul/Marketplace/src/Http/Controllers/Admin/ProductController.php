<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Marketplace\DataGrids\Admin\SellerProductDataGrid;
use Webkul\Marketplace\Repositories\SellerProductRepository;
use Webkul\Marketplace\Repositories\SellerRepository;

class ProductController extends Controller
{
    public function __construct(
        protected SellerProductRepository $sellerProductRepository,
        protected SellerRepository $sellerRepository
    ) {}

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(SellerProductDataGrid::class)->process();
        }

        return view('marketplace::admin.products.index');
    }

    public function approve(int $id)
    {
        $this->sellerProductRepository->update(['is_approved' => true], $id);

        return response()->json(['message' => trans('marketplace::app.admin.products.approve-success')]);
    }

    public function disapprove(int $id)
    {
        $this->sellerProductRepository->update(['is_approved' => false], $id);

        return response()->json(['message' => trans('marketplace::app.admin.products.disapprove-success')]);
    }

    public function assign(Request $request)
    {
        $data = $request->validate([
            'seller_id'  => 'required|exists:mp_sellers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $this->sellerProductRepository->firstOrCreate($data, [
            'is_owner'    => false,
            'is_approved' => true,
        ]);

        return response()->json(['message' => trans('marketplace::app.admin.products.assign-success')]);
    }

    public function destroy(int $id)
    {
        $this->sellerProductRepository->delete($id);

        return response()->json(['message' => trans('marketplace::app.admin.products.delete-success')]);
    }

    public function massDestroy()
    {
        foreach (request()->input('indices', []) as $id) {
            $this->sellerProductRepository->delete($id);
        }

        return response()->json(['message' => trans('marketplace::app.admin.products.mass-delete-success')]);
    }
}
