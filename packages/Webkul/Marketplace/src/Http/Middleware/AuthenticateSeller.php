<?php

namespace Webkul\Marketplace\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Webkul\Marketplace\Repositories\SellerRepository;

class AuthenticateSeller
{
    public function __construct(protected SellerRepository $sellerRepository) {}

    public function handle(Request $request, Closure $next)
    {
        // Not logged in — go to login
        if (! auth()->guard('customer')->check()) {
            return redirect()->route('shop.customer.session.index');
        }

        $seller = $this->sellerRepository->findByCustomer(auth()->guard('customer')->id());

        // No seller profile at all — go to register
        if (! $seller) {
            // Avoid redirect loop: if already on register page, let it through
            if ($request->routeIs('marketplace.seller.register') || $request->routeIs('marketplace.seller.register.store')) {
                return $next($request);
            }

            return redirect()->route('marketplace.seller.register')
                ->with('warning', trans('marketplace::app.seller.not-approved'));
        }

        // Has profile but not approved yet — show pending page, not dashboard
        if (! $seller->is_approved) {
            // Avoid redirect loop: if already on register/pending page, let it through
            if ($request->routeIs('marketplace.seller.register') || $request->routeIs('marketplace.seller.register.store')) {
                return $next($request);
            }

            return redirect()->route('marketplace.seller.register')
                ->with('warning', trans('marketplace::app.seller.not-approved'));
        }

        return $next($request);
    }
}
