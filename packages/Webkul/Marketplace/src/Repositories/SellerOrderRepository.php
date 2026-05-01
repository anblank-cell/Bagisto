<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class SellerOrderRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\SellerOrder';
    }

    public function getSellerOrders(int $sellerId)
    {
        return $this->with(['order'])->findWhere(['seller_id' => $sellerId]);
    }

    public function getPendingPayouts(int $sellerId)
    {
        return $this->findWhere(['seller_id' => $sellerId, 'is_paid' => false]);
    }
}
