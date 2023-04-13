<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class OpenAiAccount extends Model {
    use HasFactory, AsSource, Filterable, Attachable;

    protected $guarded = false;

    const OAS_ACTIVE = 0;
    const OAS_PAUSED = 1;
    const OAS_BANNED = 2;

    static public function getStatuses() {
        return [
            self::OAS_ACTIVE => '激活',
            self::OAS_PAUSED => '暂停',
            self::OAS_BANNED => '封禁',
        ];
    }

    protected $allowedSorts = [
        'id',
        'email',
        'first_time',
        'usd_spent',
        'usd_spent_limit',
        'api_key',
        'status',
        'query_cnt',
        'credit_used',
        'credit_available',
        'expires_at',
        'name',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_password',
    ];
}
