<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class SellerReviewRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\SellerReview';
    }

    public function getApproved(int $sellerId)
    {
        return $this->findWhere(['seller_id' => $sellerId, 'status' => 'approved']);
    }
}
