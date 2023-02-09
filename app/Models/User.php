<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
   /* protected $fillable = [
        'name',
        'email',
        'password',
    ];*/

    protected $guarded = ['id','created_at','updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Relacion uno a muchos
    public function links(){
        return $this->hasMany(Link::class);
    }

    public function Marketplaces(){
        return $this->hasMany(Marketplace::class);
    }

    public function SaleMarketplaces(){
        return $this->hasMany(saleMarketplace::class);
    }

    //Relacion uno a muchos
    public function comments(){
        return $this->hasMany(Comments::class);
    }
    public function comments_markets(){
        return $this->hasMany(CommentsMarket::class);
    }
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
    public function messagess(){
        return $this->hasMany(Message::class);
    }

    public function userPayments(){
        return $this->hasMany(UserPaymentMethods::class);
    }

    //Relacion muchos a muchos
    public function linkPoints(){
        return $this->belongsToMany(Link::class)->withPivot('point');
    }
    public function chats(){
        return $this->belongsToMany(Chat::class)->withPivot('color','active')->withTimestamps();
    }

}
