<?php

namespace App\Helpers;

use App\Models\EquipoUserReq;

class Helper
{
	public static function user_role()
	{
		foreach (auth()->user()->roles as $rol) {
			$tipo_usuario = $rol->name;
		}
		return $tipo_usuario;
	}

	public static function order($sort_actual, $sort, $direction)
	{
		if ($sort_actual == $sort) {

			if ($direction == 'desc') {
				$direction = 'asc';
			} else {
				$direction = 'desc';
			}
		} else {
			$sort_actual = $sort;
			$direction = 'asc';
		}

		return array($sort_actual, $direction);
	}

	public static function equipo_status($equipo_id, $user_id){
		$data = EquipoUserReq::where('equipo_id', $equipo_id)
					->where('user_id', $user_id)->first();

		if($data){
			return $data;
		}else{
			return false;
		}

	}
}
