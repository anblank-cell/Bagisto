<?php

namespace Webkul\RMA\Repositories;

use Webkul\Core\Eloquent\Repository;

class ReturnRequestRepository extends Repository
{
    /**
     * Specify the Model contract class name.
     */
    public function model(): string
    {
        return 'Webkul\RMA\Contracts\ReturnRequest';
    }

    /**
     * Get pending return requests for a specific customer.
     */
    public function getPendingForCustomer(int $customerId)
    {
        return $this->findWhere([
            'customer_id' => $customerId,
            'status' => 'pending'
        ]);
    }

    /**
     * Get return requests statistics.
     */
    public function getStats(): array
    {
        return [
            'total' => $this->count(),
            'pending' => $this->findWhere(['status' => 'pending'])->count(),
            'approved' => $this->findWhere(['status' => 'approved'])->count(),
            'rejected' => $this->findWhere(['status' => 'rejected'])->count(),
        ];
    }

    /**
     * Get recent return requests.
     */
    public function getRecent(int $limit = 10)
    {
        return $this->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}