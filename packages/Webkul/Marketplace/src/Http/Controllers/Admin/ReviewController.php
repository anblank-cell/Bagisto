<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Marketplace\DataGrids\Admin\SellerReviewDataGrid;
use Webkul\Marketplace\Repositories\SellerReviewRepository;

class ReviewController extends Controller
{
    public function __construct(protected SellerReviewRepository $sellerReviewRepository) {}

    public function index()
    {
        if (request()->ajax()) {
            return datagrid(SellerReviewDataGrid::class)->process();
        }

        return view('marketplace::admin.reviews.index');
    }

    public function approve(int $id)
    {
        $this->sellerReviewRepository->update(['status' => 'approved'], $id);

        return response()->json(['message' => trans('marketplace::app.admin.reviews.approve-success')]);
    }

    public function disapprove(int $id)
    {
        $this->sellerReviewRepository->update(['status' => 'rejected'], $id);

        return response()->json(['message' => trans('marketplace::app.admin.reviews.disapprove-success')]);
    }

    public function destroy(int $id)
    {
        $this->sellerReviewRepository->delete($id);

        return response()->json(['message' => trans('marketplace::app.admin.reviews.delete-success')]);
    }
}
