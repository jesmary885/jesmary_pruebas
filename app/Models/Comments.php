<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muhos inversa
    public function link(){
        return $this->belongsTo(Link::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
