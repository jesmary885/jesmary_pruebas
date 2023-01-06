<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkUrl extends Model
{
    use HasFactory;

    protected $table = "link_urls";
    
    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a mucos inversa

    public function link(){
        return $this->belongsTo(Link::class);
    }

}
