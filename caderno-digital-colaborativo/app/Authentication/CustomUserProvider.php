<?php

namespace App\Authentication;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as IlluminateUserProvider;


class CustomUserProvider implements IlluminateUserProvider {

    /**
     * https://laracasts.com/discuss/channels/laravel/replacing-the-laravel-authentication-with-a-custom-authentication
     * esta classe é instanciada pela 'CustomAuthProvider'e se encarrega de 
     * verificar as credenciais de login no nosso DB
     */
    
    
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier) {
        // TODO: Implement retrieveById() method.


        $qry = User::where('usuario_id', '=', $identifier);

        if ($qry->count() > 0) {
            $user = $qry->select('usuario_id', 'usuario_email', 'usuario_nome', 'usuario_sobrenome', 'usuario_email', 'usuario_senha', 'usuario_cargo', 'usuario_estado_acesso')->first();

            $attributes = array(
                'id' => $user->usuario_id,
                'usuario_email' => $user->usuario_email,
                'usuario_senha' => $user->usuario_senha,
                'usuario_nome' => $user->usuario_nome . ' ' . $user->usuario_sobrenome,
                'usuario_cargo' => $user->usuario_cargo
            );

            return $user;
        }
        return null;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token) {
        // TODO: Implement retrieveByToken() method.
        $qry = User::where('usuario_email', '=', $identifier)->where('remember_token', '=', $token);

        if ($qry->count() > 0) {
            $user = $qry->select('usuario_email', 'usuario_email', 'usuario_senha')->first();

            $attributes = array(
                'Username' => $user->username,
                'Password' => $user->password,
            );

            return $user;
        }
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token) {
        // TODO: Implement updateRememberToken() method.
        $user->setRememberToken($token);

        $user->save();
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) {
        // TODO: Implement retrieveByCredentials() method.
        //verifica se existe o usuário
        
        $qry = User::where('usuario_email', '=', $credentials['email']);

        if ($qry->count() > 0) {
            $user = $qry->select('usuario_id', 'usuario_email', 'usuario_senha')->first();
            return $user;
        }
        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials) {
        // TODO: Implement validateCredentials() method.
        // we'll assume if a user was retrieved, it's good
        // compara a senha e o usuário (novamente)
        if ($user->usuario_email == $credentials['email'] && $user->getAuthPassword() == md5($credentials['password'] . \Config::get('constants.SALT'))) {

//            $user->last_login_time = Carbon::now();
//            $user->save();  
            $estadoDeAcesso = User::findOrFail($user->usuario_id)->usuario_estado_acesso;

            if($estadoDeAcesso == 2) {
                return false;
            }
            
            return true;
        }
        return false;
    }

}
