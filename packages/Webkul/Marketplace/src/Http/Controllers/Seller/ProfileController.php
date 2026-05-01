<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Webkul\Marketplace\Repositories\SellerRepository;

class ProfileController extends Controller
{
    public function __construct(protected SellerRepository $sellerRepository) {}

    public function index()
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        return view('marketplace::seller.profile.index', compact('seller'));
    }

    public function update(Request $request)
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        $data = $request->validate([
            'shop_title'      => 'required|string|max:255',
            'slug'            => 'required|string|alpha_dash|unique:mp_sellers,slug,' . $seller->id,
            'description'     => 'nullable|string',
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string',
            'country'         => 'nullable|string',
            'state'           => 'nullable|string',
            'city'            => 'nullable|string',
            'postcode'        => 'nullable|string',
            'return_policy'   => 'nullable|string',
            'shipping_policy' => 'nullable|string',
            'facebook_url'    => 'nullable|url',
            'twitter_url'     => 'nullable|url',
            'instagram_url'   => 'nullable|url',
            'youtube_url'     => 'nullable|url',
            'meta_title'      => 'nullable|string|max:255',
            'meta_description'=> 'nullable|string',
            'meta_keywords'   => 'nullable|string',
            'logo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            if ($seller->logo) Storage::delete($seller->logo);
            $data['logo'] = $request->file('logo')->store('marketplace/sellers/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($seller->banner) Storage::delete($seller->banner);
            $data['banner'] = $request->file('banner')->store('marketplace/sellers/banners', 'public');
        }

        $this->sellerRepository->update($data, $seller->id);

        return redirect()->route('marketplace.seller.profile')
            ->with('success', trans('marketplace::app.seller.profile.update-success'));
    }
}
