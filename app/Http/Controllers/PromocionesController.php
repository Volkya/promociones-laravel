<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;

class PromocionesController extends Controller{

    public function import(){

        if($_FILES["import_excel"]["name"] != ''){
            $allowed_extension = array('xls', 'csv', 'xlsx');
            $file_array = explode(".", $_FILES["import_excel"]["name"]);
            $file_extension = end($file_array);
        
            if(in_array($file_extension, $allowed_extension)){
                $file_name = time() . '.' . $file_extension;
                move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
                $spreadsheet = $reader->load($file_name);
                unlink($file_name);
                $data = $spreadsheet->getActiveSheet()->toArray();
                // del array total hacemos un recorrido especifico 


                // hay 42 columnas!
                for ($row=10; $row < count($data); $row++) { 
                    $statement = DB::insert("INSERT INTO CODJ_Promociones(n_promocion, tipo_promo, descripcion, descripcion_pmt, descuento, precio_fijo_total, tipo_codificacion, codigo, items_ejecutar, item_aplicar, fecha_desde, hora_desde, fecha_hasta, hora_hasta,
                        codificacion_excluidos, codigos_excluidos, medio_pago, beneficio_exceso_transaccion, clientes_frecuentes_perfiles, flag_dinamico, promocion_no_acumulable, transaccion_factura,
                        modo_impresion, grupo_promocion, centro_costo_1, porcentaje_centro_costo_1, centro_costo_2, porcentaje_centro_costo_2, prioridad, valor_medio_pago, grupo_sucursales, sucursales, precios_iguales,
                        lista_descuentos_anteriores, plan_desde, plan_hasta, tipo_condicion, valor_condicion, tipo_codificacion_items, codigo_codificacion, promovar, promovar_valor
                    ) VALUES (
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?)",
                        [
                            strval($data[$row][0]), strval($data[$row][1]), strval($data[$row][2]), strval($data[$row][3]),
                            strval($data[$row][4]), strval($data[$row][5]), strval($data[$row][6]), strval($data[$row][7]),
                            strval($data[$row][8]), strval($data[$row][9]), strval($data[$row][10]), strval($data[$row][11]),
                            strval($data[$row][12]), strval($data[$row][13]), strval($data[$row][14]), strval($data[$row][15]),
                            strval($data[$row][16]), strval($data[$row][17]), strval($data[$row][18]), strval($data[$row][19]),
                            strval($data[$row][20]), strval($data[$row][21]), strval($data[$row][22]), strval($data[$row][23]),
                            strval($data[$row][24]), strval($data[$row][25]), strval($data[$row][26]), strval($data[$row][27]),
                            strval($data[$row][28]), strval($data[$row][29]), strval($data[$row][30]), strval($data[$row][31]),
                            strval($data[$row][32]), strval($data[$row][33]), strval($data[$row][34]), strval($data[$row][35]),
                            strval($data[$row][36]), strval($data[$row][37]), strval($data[$row][38]), strval($data[$row][39]),
                            strval($data[$row][40]), strval($data[$row][41])
                        ]
                    );

                } // end for filas excel

                $message = '<div class="alert alert-success">Promociones importadas correctamente</div>';

            }
            else{
                $message = '<div class="alert alert-danger">Unicamente formatos permitidos: .xls .csv or .xlsx file allowed</div>';
            }
        }
        else{
            $message = '<div class="alert alert-danger">No has cargado ningun archivo!</div>';
        }
        
        echo $message;

    } // end function

    public function export(){
        return "nada por ahora";
    }

} // end controller
