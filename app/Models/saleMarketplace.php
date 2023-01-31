<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saleMarketplace extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    const SOLICITADO = 1;
    const PAGO_RECIBIDO= 2;
    const PAGO_NO_RECIBIDO= 3;
    const PRODUCTO_RECIBIDO= 4;
    const PRODUCTO_NO_RECIBIDO= 5;

    //Relacion uno a muhos inversa
    public function marketplace(){
        return $this->belongsTo(Marketplace::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethods::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
