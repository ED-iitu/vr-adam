<?php

namespace App\Models;

use App\Filesystem\File;
use App\Filesystem\Source;
use App\Filesystem\Validator\ImageValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_deleted',
        'is_blocked',
        'balance',
        'rating',
        'role_id',
        'code',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function (User $user) {
            if (request()->hasFile('avatar')) {
                $validator = (new ImageValidator(['avatar']));
                $avatar = (new File(new Source('avatar')))->load('avatar')->validate($validator)->save();
                if (!$avatar->failed) {
                    $user->avatar = $avatar->getStoredPath();
                } else {
                    unset($user->avatar);
                }
            }

            // Role user
            if (request()->get('role')) {
                $user->assignRole(request()->get('role'));

                $roles = $user->getRoleNames();

                if (!empty($roles)) {
                    $user->role_id = $user->getStoredRole($roles[0]->id);
                }
            } else {
                $user->assignRole('user');
                $user->role_id = 2;
            }
        });

        static::updating(function (User $user) {
            if (request()->hasFile('avatar')) {
                $validator = (new ImageValidator(['avatar']));
                $avatar = (new File(new Source('avatar')))->load('avatar')->validate($validator)->save();
                if (!$avatar->failed) {
                    $user->avatar = $avatar->getStoredPath();
                } else {
                    unset($user->avatar);
                }
            }
        });
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
