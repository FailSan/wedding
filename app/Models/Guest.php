<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        "name",
        "surname",
        "diet",
        "allergies",
        "church_confirm",
        "castle_confirm",
        "updated",
        "code",
        "password",
    ];

    protected $hidden = [
    ];

    protected $casts = [
        "church_confirm" => "boolean",
        "castle_confirm" => "boolean",
        "updated" => "boolean",
    ];

    public function uniqueIds() {
        return ['code'];
    }

    public function guests() {
        return $this->hasMany(Guest::class);
    }

    public function host() {
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    public function table() {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
