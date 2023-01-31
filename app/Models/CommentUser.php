<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentUser extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos inversa

    public function recibe(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function envia(){
        return $this->belongsTo(User::class, 'user_create_id');
    }

    public function sale_marketplace(){
        return $this->belongsTo(saleMarketplace::class);
    }
    
    


}
