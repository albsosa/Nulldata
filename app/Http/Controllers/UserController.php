<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use App\Skill;
class UserController extends ApiController
{
    public function register(Request $request){
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'puesto' => 'required',
            'fecha_nac' => 'required',
            'domicilio' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error',
                                    'code' => 400,
                                    'errors' => $validator->errors(),
                                    'message' => 'Usuario no Creado'], 
                                    400);
        }
        $User= User::create($request->all());     
        foreach ($skills as $key => $value) {
            $Skill = new Skill;
            $Skill->nombre = $value->nombre;
            $Skill->calificacion = $value->calificacion;
            $Skill->user_id = $User->id;
            $Skill->save();
        } 
        return response()->json(['User' => $User], 200);
    }
    public function verempleados(){
    	$User = User::all();
        return $this->showAll($User);
    }

    public function verempleado($id){
    	$User = User::findOrFail($id);
    	$skill = $User->skills;
    	return $this->showOne($User);
    }
}
