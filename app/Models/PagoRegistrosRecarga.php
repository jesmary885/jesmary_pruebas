<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoRegistrosRecarga extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos inversa

    public function user_cliente(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin_verific(){
        return $this->belongsTo(User::class, 'admin_first_id');
    }

    public function admin_verific2(){
        return $this->belongsTo(User::class, 'admin_second_id');
    }
}
