<?php

namespace App\Domain\Management\Models;

use App\Support\Concerns\HasFactory;
use App\Support\Traits\HasPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasPassword;
    use InteractsWithMedia;

    protected $fillable = ['name', 'phone', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $with = ['media'];

    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl();
    }
}
