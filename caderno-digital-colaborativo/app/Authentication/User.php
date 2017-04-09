<?php

namespace App\Authentication;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    protected $table = 'usuario';
    public $timestamps = false;
    protected $primaryKey = 'usuario_id';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_email', 'usuario_email', 'usuario_senha',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usuario_senha', 'remember_token',
    ];

    // overriding getter & setter
    function getEmailAttribute() {
        return $this->attributes['usuario_email'];
    }

    public function getAuthUsername() {
        return $this->attributes['usuario_email'];
    }

    public function getAuthPassword() {
        return $this->attributes['usuario_senha'];
    }
    
    
    
    /**
     * ESSA PARTE AQUI EVITA CHAMAR O UPDATE DO REMEMBER TOKEN
     */
    
    
    /**
     * @return string
     */
    public function getRememberToken()
    {
        // Return the token used for the "remember me" functionality
    }

    /**
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Store a new token user for the "remember me" functionality
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        // Return the name of the column / attribute used to store the "remember me" token
    }

}
