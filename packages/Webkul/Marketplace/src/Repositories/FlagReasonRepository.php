<?php

namespace Webkul\Marketplace\Repositories;

use Webkul\Core\Eloquent\Repository;

class FlagReasonRepository extends Repository
{
    public function model(): string
    {
        return 'Webkul\Marketplace\Contracts\FlagReason';
    }

    public function getActive(string $type)
    {
        return $this->findWhere(['type' => $type, 'is_active' => true]);
    }
}
