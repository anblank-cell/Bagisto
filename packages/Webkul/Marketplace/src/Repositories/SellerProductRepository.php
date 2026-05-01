<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class SellerProductRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\SellerProduct';
    }

    public function getSellerProducts(int $sellerId)
    {
        return $this->with(['product'])->findWhere(['seller_id' => $sellerId]);
    }

    public function getApprovedProducts(int $sellerId)
    {
        return $this->findWhere(['seller_id' => $sellerId, 'is_approved' => true]);
    }
}
