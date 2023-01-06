<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplacePaymentMethods extends Model
{
    use HasFactory;

    protected $table = "marketplace_payment_methods";

    //Relacion uno a mucos inversa

    public function marketplace(){
        return $this->belongsTo(Marketplace::class);
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethods::class);
    }
}
