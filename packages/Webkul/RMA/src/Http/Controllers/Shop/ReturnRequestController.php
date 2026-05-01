<?php

namespace Webkul\RMA\Http\Controllers\Shop;

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
     * Display a listing of customer return requests.
     */
    public function index()
    {
        // For now, return a simple response
        // We'll enhance this with views in the Views section
        return 'Shop RMA Return Requests List - Using Controller!';
    }
    /**
     * Mass delete return requests.
     */
    public function massDestroy()
    {
        $indices = request()->input('indices');
        
        foreach ($indices as $index) {
            $this->returnRequestRepository->delete($index);
        }
        
        return response()->json(['message' => 'Selected return requests deleted successfully.']);
    }
}