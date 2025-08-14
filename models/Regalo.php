<?php
namespace Model;

class Regalo extends ActiveRecord {
    protected static $tabla = 'regalos';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
    
    // Declaramos la propiedad total para evitar propiedades dinámicas
    public $total = 0;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->total = $args['total'] ?? 0; // Inicializamos total
    }
}