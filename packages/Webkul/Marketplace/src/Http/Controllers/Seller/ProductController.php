<?php

namespace Webkul\Marketplace\Http\Controllers\Seller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\SellerProductRepository;
use Webkul\Product\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(
        protected SellerRepository $sellerRepository,
        protected SellerProductRepository $sellerProductRepository,
        protected ProductRepository $productRepository
    ) {}

    public function index()
    {
        $seller   = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $products = $this->sellerProductRepository->with(['product'])->findWhere(['seller_id' => $seller->id]);

        return view('marketplace::seller.products.index', compact('seller', 'products'));
    }

    public function create()
    {
        return view('marketplace::seller.products.create');
    }

    public function store(Request $request)
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        $data = $request->validate([
            'type'              => 'required|string',
            'attribute_family_id' => 'required|integer',
            'sku'               => 'required|string|unique:products,sku',
        ]);

        $product = $this->productRepository->create($data);

        $this->sellerProductRepository->create([
            'seller_id'   => $seller->id,
            'product_id'  => $product->id,
            'is_owner'    => true,
            'is_approved' => false,
        ]);

        return redirect()->route('marketplace.seller.products.edit', $product->id)
            ->with('success', trans('marketplace::app.seller.products.create-success'));
    }

    public function edit(int $id)
    {
        $seller        = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $sellerProduct = $this->sellerProductRepository->findOneWhere(['seller_id' => $seller->id, 'product_id' => $id]);

        if (! $sellerProduct) abort(403);

        $product = $this->productRepository->findOrFail($id);

        return view('marketplace::seller.products.edit', compact('seller', 'product', 'sellerProduct'));
    }

    public function update(Request $request, int $id)
    {
        $seller        = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $sellerProduct = $this->sellerProductRepository->findOneWhere(['seller_id' => $seller->id, 'product_id' => $id]);

        if (! $sellerProduct) abort(403);

        $this->sellerProductRepository->update([
            'price'    => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ], $sellerProduct->id);

        return redirect()->route('marketplace.seller.products.index')
            ->with('success', trans('marketplace::app.seller.products.update-success'));
    }

    public function destroy(int $id)
    {
        $seller        = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());
        $sellerProduct = $this->sellerProductRepository->findOneWhere(['seller_id' => $seller->id, 'product_id' => $id]);

        if (! $sellerProduct) abort(403);

        $this->sellerProductRepository->delete($sellerProduct->id);

        return response()->json(['message' => trans('marketplace::app.seller.products.delete-success')]);
    }

    public function assignIndex()
    {
        $products = $this->productRepository->all();

        return view('marketplace::seller.products.assign', compact('products'));
    }

    public function assignStore(Request $request)
    {
        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        $data = $request->validate(['product_id' => 'required|exists:products,id']);

        $this->sellerProductRepository->firstOrCreate([
            'seller_id'  => $seller->id,
            'product_id' => $data['product_id'],
        ], [
            'is_owner'    => false,
            'is_approved' => false,
        ]);

        return redirect()->route('marketplace.seller.products.index')
            ->with('success', trans('marketplace::app.seller.products.assign-success'));
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv,txt']);

        // Bulk import logic placeholder — integrates with DataTransfer package
        return redirect()->route('marketplace.seller.products.index')
            ->with('success', trans('marketplace::app.seller.products.import-success'));
    }
}
