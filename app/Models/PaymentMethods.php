<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos

    public function userPayments(){
        return $this->hasMany(UserPaymentMethods::class);
    }

    public function SaleMarketplaces(){
        return $this->hasMany(saleMarketplace::class);
    }

    
}
