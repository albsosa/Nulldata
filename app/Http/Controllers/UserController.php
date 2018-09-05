<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Skill;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function register(Request $request){
   
    	$json = $request->input('json', null);
    	$params = json_decode($json);

    	$name = (!is_null($json) && isset($params->name)) ? $params->name : null;
    	$puesto = (!is_null($json) && isset($params->puesto)) ? $params->puesto : null;
    	$email = (!is_null($json) && isset($params->email)) ? $params->email : null;
    	$fecha_nac = (!is_null($json) && isset($params->fecha_nac)) ? $params->fecha_nac : null;
    	$domicilio = (!is_null($json) && isset($params->domicilio)) ? $params->domicilio : null;
    	$skills = (!is_null($json) && isset($params->skills)) ? $params->skills : null;


    	if(!is_null($email) && !is_null($name) && !is_null($fecha_nac) && !is_null($puesto) && !is_null($domicilio) && !is_null($skills)){
    		$user = new User();
    		$user->name = $name;
    		$user->puesto = $puesto;
    		$user->email = $email;
    		$user->fecha_nac = $fecha_nac;
    		$user->domicilio = $domicilio; 

    		$isset_user = User::where('email', '=', $email)->first();

    		if(count($isset_user)==0){
    			//guardar usuario
    			$user->save();
    			foreach ($skills as $key => $value) {
                        DB::table('skills')->insert(['nombre' => $value->nombre,
                        							 'calificacion' => $value->calificacion,
                        							 'user_id' => $user->id]);
                }

	    		$data = array(
	    			'status' => 'success',
	    			'code' => 200,
	    			'message' => 'Usuario Guardado'
	    		);
    		}
    		else{
	    		$data = array(
	    			'status' => 'error',
	    			'code' => 400,
	    			'message' => 'Correo duplicado'
	    		);	
    		}
    	}

    	else {
    		$data = array(
    			'status' => 'error',
    			'code' => 400,
    			'message' => 'Usuario no Creado'
    		);
    	}
    	return response()->json($data, 200);
    }

    public function verempleados(){
    	$User = User::all();
        return response()->json(['data' => $User], 200);
    }

    public function verempleado($id){
    	$User = User::findOrFail($id);
    	$skill = $User->skills;
    	return response()->json([
                'User' => $User
            ]);
    }
}
