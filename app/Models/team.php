<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory;
    use HasUuids;
    public $fillable = ["name","age","image","gender","from"];

    public $hidden = ["created_at","updated_at"];

    public function getImageAttribute($value){

        return public_path( $value);

    }


    public function experience(){


        return $this->hasMany(experience::class, "team_id");
    }
}
