<?php

namespace Controllers;
use Model\Expositor;

class APIExpositores {

    public static function index() {
        $expositores = Expositor::all();
        echo json_encode($expositores);

    }

    public static function expositor() {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id || $id < 1) {
            echo json_encode([]);
            return;
        }

        $expositor = Expositor::find($id);
        echo json_encode($expositor, JSON_UNESCAPED_SLASHES);
    }
}