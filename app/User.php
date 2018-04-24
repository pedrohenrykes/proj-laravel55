<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Balance;
use App\Models\Historic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // retorna o saldo do usuario
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    // retorna os historicos de transacoes do usuario
    public function historics()
    {
        return $this->hasMany(Historic::class);
    }

    public function searchReceiver(String $receiver)
    {
        return $this->where('name', 'LIKE', "%{$receiver}%")
            ->orWhere('email', $receiver)->get()->first();
    }
}
