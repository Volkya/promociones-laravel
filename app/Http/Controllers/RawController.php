<?php

namespace App\Http\Controllers;

// use DB;
use Illuminate\Support\Facades\DB;

class RawController extends Controller{

    public function crear(){

        DB::insert("INSERT INTO CODJ_Promociones(id, n_promocion, tipo_promo) VALUES(?, ?, ?)", [
        1, 2, "golosinas"]);

    }
    
    public function eliminar(){
        
        DB::update("DELETE FROM CODJ_Promociones WHERE id=?", 
        [1]);

    }
    
    public function updatear(){
        
        DB::update("UPDATE CODJ_Promociones SET tipo_promociones='tipo cambiado' WHERE ID = ?", 
        [2]);

    }
    
    public function listar(){
        
        $golosinas = DB::select("SELECT * FROM CODJ_Promociones WHERE tipo_promociones = ? ", 
        ["golosinas"]);

        foreach ($golosinas as $golosina) {
            return $golosina->n_promocion;
        }

    }

}
