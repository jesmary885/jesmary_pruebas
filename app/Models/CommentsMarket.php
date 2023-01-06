<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsMarket extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muhos inversa
    public function marketplace(){
        return $this->belongsTo(Marketplace::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
