<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\SubSellerRepository;

class SubSellerController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected SubSellerRepository $subSellerRepository
    ) {}

    public function index()
    {
        $seller     = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $subSellers = $this->subSellerRepository->findWhere(['seller_id' => $seller->id]);

        return view('marketplace::seller.sub-sellers.index', compact('seller', 'subSellers'));
    }

    public function store(Request $request)
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:mp_sub_sellers,email',
            'password'    => 'required|string|min:8|confirmed',
            'permissions' => 'nullable|array',
        ]);

        $data['seller_id'] = $seller->id;
        $data['password']  = Hash::make($data['password']);

        $this->subSellerRepository->create($data);

        return response()->json(['message' => trans('marketplace::app.seller.sub-sellers.create-success')]);
    }

    public function update(Request $request, int $id)
    {
        $seller    = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $subSeller = $this->subSellerRepository->findOneWhere(['id' => $id, 'seller_id' => $seller->id]);

        if (! $subSeller) abort(403);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'is_active'   => 'boolean',
        ]);

        $this->subSellerRepository->update($data, $id);

        return response()->json(['message' => trans('marketplace::app.seller.sub-sellers.update-success')]);
    }

    public function destroy(int $id)
    {
        $seller    = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $subSeller = $this->subSellerRepository->findOneWhere(['id' => $id, 'seller_id' => $seller->id]);

        if (! $subSeller) abort(403);

        $this->subSellerRepository->delete($id);

        return response()->json(['message' => trans('marketplace::app.seller.sub-sellers.delete-success')]);
    }
}
