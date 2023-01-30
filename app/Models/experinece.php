<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class experinece extends Model
{
    use HasFactory;
    use HasUuids;
    public $fillable = ["name","precent"];
    public $hidden = ["created_at", "updated_at"];
    public function team(){


        return $this->belongsTo(team::class, "team_id");
    } 

}
