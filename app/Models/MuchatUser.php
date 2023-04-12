<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class MuchatUser extends Model {
    use HasFactory, AsSource, Filterable, Attachable;

    protected $allowedSorts = [
        'id',
        'expires_at',
        'bad_cnt',
        'usage',
        'max_usage',
        'first_time',
        'max_days',
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'name',
        'slug',
        'expires_at',
        'bad_cnt',
        'usage',
        'max_usage',
        'first_time',
        'max_days',
        'created_at',
        'updated_at'
    ];
}
