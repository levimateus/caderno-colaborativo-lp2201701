<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller {

    public function cadastrar() {
        //cadastrar novo usuário utilizando um arquivo csv
    }

    
    
    /**
     * Baseado na seguinte publicacao:
     * http://stackoverflow.com/questions/39586104/change-password-user-laravel-5-3
     * 
     * 
     * @param Request $request
     * @return string
     */
    public function trocasenha(Request $request) {
        if (Auth::Check()) {
            $request_data = $request->All();
            $validator = $this->validacao($request_data);
            if ($validator->fails()) {
                $message = array('error' => reset(array_values($validator->getMessageBag()->toArray())[0]));
            } else {                
                $user_id = Auth::User()->usuario_id;
                $senha_antiga_aberta = $request_data['current-password'];
                $senha_antiga_md5 = md5($senha_antiga_aberta.\Config::get('constants.SALT'));
                
                //procuramos o usuario que tenha o id e a senha 
                $obj_user = \App\models\dao\Usuario::where('usuario_id',$user_id)
                        ->where('usuario_senha', $senha_antiga_md5)
                        ->first();
                if ($obj_user) {
                    $senha_nova_aberta = $request_data['password'];
                    $senha_nova_md5 = md5($senha_nova_aberta.\Config::get('constants.SALT'));
                    
                    $obj_user->usuario_senha = $senha_nova_md5;
                    $obj_user->save();
                    
                    //mandamos para a tela de perfil                    
                    $message = array('success' => 'Senha modificada!');
                } else { 
                    $message = array('error' => 'Senha inválida!');
                }
            }        
            //passamos a mensagem para o controller de perfil 
            //http://stackoverflow.com/questions/29870267/how-to-pass-a-value-from-one-controller-to-another-controller-in-laravel
            
            return redirect('perfil')->with('message', $message);
        } else {
            
            //se nao esta logando vai pro inicio
            return redirect()->to('/');
        }
        
    }

    public function validacao(array $data) {
        $messages = [
            'current-password.required' => 'Indique a senha atual',
            'password.required' => 'Indique a nova senha',
//            'password_confirmation.required' => 'Indique a nova senha',
        ];

        $validator = Validator::make($data, [
                    'current-password' => 'required',
                    'password' => 'required|same:password',
                    'password_confirmation' => 'required|same:password',
                        ], $messages);

        return $validator;
    }

}
