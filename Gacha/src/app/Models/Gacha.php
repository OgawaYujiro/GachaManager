<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gacha extends Model
{
    use HasFactory;

    protected $table = "gachas";
    
    protected $fillable = [
        "id",
        "name",
        "content"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
