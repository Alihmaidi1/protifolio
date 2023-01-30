<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contantus extends Model
{
    use HasFactory;
    use HasUuids;
    public $fillable = ["name","email","subject","message"];

    public $hidden = ["created_at","updated_at"];

}
