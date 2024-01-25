<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'file_name',
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
