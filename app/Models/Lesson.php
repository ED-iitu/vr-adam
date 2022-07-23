<?php

namespace App\Models;

use App\Filesystem\File;
use App\Filesystem\Source;
use App\Filesystem\Validator\ImageValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'description', 'preview', 'video', 'course_id'
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected static function booted()
    {
        static::creating(function (Lesson $lesson) {
            if (request()->hasFile('preview')) {
                $validator = (new ImageValidator(['preview']));
                $preview = (new File(new Source('image')))->load('preview')->validate($validator)->save();
                if (!$preview->failed) {
                    $lesson->preview = $preview->getStoredPath();
                } else {
                    unset($lesson->preview);
                }
            }
        });

        static::updating(function (Lesson $lesson) {
            if (request()->hasFile('preview')) {
                $validator = (new ImageValidator(['preview']));
                $preview = (new File(new Source('image')))->load('preview')->validate($validator)->save();
                if (!$preview->failed) {
                    $lesson->preview = $preview->getStoredPath();
                } else {
                    unset($lesson->preview);
                }
            }
        });
    }
}
