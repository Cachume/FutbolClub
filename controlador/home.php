<?php
require_once "modelo/adminmodel.php";

class home extends vistas{

    public $categoria;
    public function load(){
        $this->categoria = adminModel::getCategorys();
        $this->vistan('home');
    }

}

?>