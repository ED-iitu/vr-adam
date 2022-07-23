<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pocket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'view_count', 'price', 'available_in_subscription', 'is_active'
    ];

    protected static function booted()
    {
        static::creating(function (Pocket $pocket) {
            if (request()->has('available_in_subscription')) {
                $pocket->available_in_subscription = true;
            } else {
                $pocket->available_in_subscription = false;
            }

            if (request()->has('is_active')) {
                $pocket->is_active = true;
            } else {
                $pocket->is_active = false;
            }
        });

        static::updating(function (Pocket $pocket) {
            if (request()->has('available_in_subscription')) {
                $pocket->available_in_subscription = true;
            } else {
                $pocket->available_in_subscription = false;
            }

            if (request()->has('is_active')) {
                $pocket->is_active = true;
            } else {
                $pocket->is_active = false;
            }
        });
    }
}
