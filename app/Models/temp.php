<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class temp extends Model
{
    use HasFactory;

    use HasUuids;
    public $fillable = ["url"];


    public $hidden = ["created_at","updated_at"];


    public function getUrlAttribute($value){


        return public_path("temp/".$value);


    }
}
