<?php

namespace App\Domain\Child\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bracelet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeForAuthParent($q)
    {
        $q->whereUserId(auth()->id());
    }
    public function measurements()
    {
        return $this->hasMany(BraceletMeasurement::class);
    }
}
