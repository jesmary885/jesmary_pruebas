<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Links_Points extends Model
{
    use HasFactory;

    protected $table = "user__links__points";
    
    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a mucos inversa

    public function link(){
        return $this->belongsTo(Link::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
