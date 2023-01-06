<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saleMarketplace extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    const PAGADO_ENTREGADO = 1;
    const NO_PAGADO_NO_ENTREGADO = 2;

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
