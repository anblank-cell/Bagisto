<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Webkul\RMA\DataGrids\Admin\ReturnRequestDataGrid;
use Webkul\RMA\Http\Controllers\Controller;
use Webkul\RMA\Repositories\ReturnRequestRepository;

class ReturnRequestController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected ReturnRequestRepository $returnRequestRepository
    ) {}

    /**
     * Display a listing of return requests.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(ReturnRequestDataGrid::class)->process();
        }

        return view('rma::admin.return-requests.index');
    }

    /**
     * Show the specified return request.
     */
    public function show($id)
    {
        $returnRequest = $this->returnRequestRepository->findOrFail($id);

        return view('rma::admin.return-requests.show', compact('returnRequest'));
    }

    /**
     * Delete the specified return request.
     */
    public function destroy($id)
    {
        $this->returnRequestRepository->delete($id);

        return response()->json(['message' => trans('rma::app.admin.return-requests.delete-success')]);
    }

    /**
     * Mass delete return requests.
     */
    public function massDestroy()
    {
        $indices = request()->input('indices', []);

        foreach ($indices as $index) {
            $this->returnRequestRepository->delete($index);
        }

        return response()->json(['message' => trans('rma::app.admin.return-requests.mass-delete-success')]);
    }
}