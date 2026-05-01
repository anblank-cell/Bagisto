<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class SellerRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\Seller';
    }

    public function findBySlug(string $slug)
    {
        return $this->findOneByField('slug', $slug);
    }

    public function findByCustomer(int $customerId)
    {
        return $this->findOneByField('customer_id', $customerId);
    }

    public function getApproved()
    {
        return $this->findWhere(['is_approved' => true, 'is_active' => true]);
    }

    public function getTopSellers(int $limit = 6)
    {
        return $this->model->where('is_approved', true)
            ->where('is_active', true)
            ->orderByDesc('total_revenue')
            ->limit($limit)
            ->get();
    }
}
