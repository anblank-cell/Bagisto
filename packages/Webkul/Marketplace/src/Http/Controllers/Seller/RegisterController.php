<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;

class RegisterController extends Controller
{
    public function __construct(protected SellerRepository $sellerRepository) {}

    public function index()
    {
        if (auth()->guard('customer')->check()) {
            $existing = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
            if ($existing) {
                return redirect()->route('marketplace.seller.dashboard');
            }
        }

        return view('marketplace::seller.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shop_title' => 'required|string|max:255',
            'slug'       => 'required|string|unique:mp_sellers,slug|alpha_dash',
            'phone'      => 'nullable|string|max:20',
            'description'=> 'nullable|string',
        ]);

        if (! auth()->guard('customer')->check()) {
            return redirect()->route('shop.customer.session.index');
        }

        $data['customer_id'] = auth()->guard('customer')->id();
        $data['is_approved']  = false;

        $this->sellerRepository->create($data);

        return redirect()->route('marketplace.seller.register')
            ->with('success', trans('marketplace::app.seller.register-success'));
    }
}
