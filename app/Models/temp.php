<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp extends Model
{
    use HasFactory;

    use HasUuids;
    public $fillable = ["url"];


    public $hidden = ["created_at","updated_at"];
}
