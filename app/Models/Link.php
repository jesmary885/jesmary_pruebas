<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muhos inversa
    public function jumperType(){
        return $this->belongsTo(JumperType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion uno a muchos
    public function comments(){
        return $this->hasMany(Comments::class);
    }

    //Relacion muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('point');
    }

}
