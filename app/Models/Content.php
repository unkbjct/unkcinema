<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    public function getDateAsCarbonAttribute()
    {
        return Carbon::parse($this->created_at);
    }
}
