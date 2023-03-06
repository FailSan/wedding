<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    protected $hidden = [];

    protected $casts = [];

    public $timestamps = false;

    public function guests() {
        return $this->hasMany(Guest::class);
    }
}
