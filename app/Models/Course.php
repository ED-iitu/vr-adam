<?php

namespace App\Models;

use App\Filesystem\File;
use App\Filesystem\Source;
use App\Filesystem\Validator\ImageValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'author_id',
        'is_active',
        'old_price',
        'current_price',
        'is_cashback_available',
        'cashback_percent',
        'category_id',
        'start_date',
        'end_date',
        'image',
        'video_link'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function (Course $course) {
            if (request()->hasFile('image')) {
                $validator = (new ImageValidator(['image']));
                $image = (new File(new Source('image')))->load('image')->validate($validator)->save();
                if (!$image->failed) {
                    $course->image = $image->getStoredPath();
                } else {
                    unset($course->image);
                }
            }

            if (request()->has('is_cashback_available')) {
                $course->is_cashback_available = true;
            } else {
                $course->is_cashback_available = false;
            }
        });

        static::updating(function (Course $course) {
            if (request()->hasFile('image')) {
                $validator = (new ImageValidator(['image']));
                $image = (new File(new Source('image')))->load('image')->validate($validator)->save();
                if (!$image->failed) {
                    $course->image = $image->getStoredPath();
                } else {
                    unset($course->image);
                }
            }

            if (request()->has('is_cashback_available')) {
                $course->is_cashback_available = true;
            } else {
                $course->is_cashback_available = false;
            }
        });
    }
}
