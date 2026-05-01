<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class SubSellerRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\SubSeller';
    }

    public function getForSeller(int $sellerId)
    {
        return $this->findWhere(['seller_id' => $sellerId]);
    }
}
