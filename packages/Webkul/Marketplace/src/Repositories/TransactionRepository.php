<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class TransactionRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\Transaction';
    }

    public function getSellerTransactions(int $sellerId)
    {
        return $this->findWhere(['seller_id' => $sellerId]);
    }
}
