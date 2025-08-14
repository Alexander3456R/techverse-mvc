<?php

namespace Controllers;

use Model\Regalo;
use Model\Registro;

class APIRegalos {

    public static function index() {

        if(!is_admin()) {
            echo json_encode([]);
            return;
        }
        
        $regalos = Regalo::all();
        foreach($regalos as $regalo) {
            // Ahora usamos la propiedad declarada $total
            $regalo->total = Registro::totalArray([
                'regalo_id' => $regalo->id, 
                'paquete_id' => '1'
            ]);
        }

        // Retornamos los datos en JSON
        echo json_encode($regalos);
        return;
    }
}
