<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class experinece extends Model
{
    use HasFactory;
    use HasUuids;
    public $fillable = ["name","precent","team_id"];
    public $hidden = ["created_at", "updated_at","team_id"];
    public function team(){


        return $this->belongsTo(team::class, "team_id");
    }

    public $appends = ["team"];

    public function getTeamAttribute(){

        
        return $this->team()->get();

    }

}
