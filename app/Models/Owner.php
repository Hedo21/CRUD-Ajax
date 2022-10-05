<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function Owner()
    {
        return $this->hasMany(kopi::class);
    }

    use HasFactory;
    protected $table = 'owners';
}
