<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kopi extends Model
{
    public function kopi_owner()
    {
        return $this->belongsTo('App\Models\Owner', 'owner', 'id_user');
    }

    use HasFactory;
    protected $table = 'kopis';
    protected $fillable = [
        'jenis_kopi',
        'jumlah',
        'asal',
        'owner',
    ];
}
