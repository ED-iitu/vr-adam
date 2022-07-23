<?php

namespace App\Models;

use App\Filesystem\File;
use App\Filesystem\Source;
use App\Filesystem\Validator\ImageValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'is_cashback_available', 'cashback_percent',
        'category_id', 'price'
    ];

//$request->has('is_cashback_available')

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function (Product $product) {
            if (request()->hasFile('image')) {
                $validator = (new ImageValidator(['image']));
                $image = (new File(new Source('image')))->load('image')->validate($validator)->save();
                if (!$image->failed) {
                    $product->image = $image->getStoredPath();
                } else {
                    unset($product->image);
                }
            }
        });

        static::updating(function (Product $product) {
            if (request()->hasFile('image')) {
                $validator = (new ImageValidator(['image']));
                $image = (new File(new Source('image')))->load('image')->validate($validator)->save();
                if (!$image->failed) {
                    $product->image = $image->getStoredPath();
                } else {
                    unset($product->image);
                }
            }

            if (request()->has('is_cashback_available')) {
                $product->is_cashback_available = true;
            } else {
                $product->is_cashback_available = false;
            }
        });
    }
}
