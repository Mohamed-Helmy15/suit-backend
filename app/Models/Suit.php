<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suit extends Model
{
    use HasFactory;
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'name',
        'description',
        'image',
        'fabric_name',
        'type_id',
        'user_id',
    ];
    
    protected $hidden = [
        'type_id',
        'user_id',
    ];

    protected $with = [
        'user',
        'type',
    ];
}


