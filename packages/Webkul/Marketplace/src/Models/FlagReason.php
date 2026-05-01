<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Marketplace\Contracts\FlagReason as FlagReasonContract;

class FlagReason extends Model implements FlagReasonContract
{
    protected $table = 'mp_flag_reasons';

    protected $fillable = ['title', 'type', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
