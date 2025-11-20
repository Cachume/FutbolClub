<?php
require_once "modelo/reportesmodel.php";
require 'vendor/autoload.php';   
use Dompdf\Dompdf;

class reportes extends vistas{
    public $categoria;
    public $data;
    public function load(){
        header("Location:/FutbolClub/login");
    }
    public function cobros(){
        $partes_fecha = explode('-',$_POST['fecha']);
        $anio = intval($partes_fecha[0]);
        $mes = intval($partes_fecha[1]);
        $this->data = reportesModel::listaPagosPorMesYAnio($mes, $anio);
        ob_start();
        include './vistas/administrador/reports/cobros.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reporte_cobros.pdf", ["Attachment" => false]);
    }

    public function pagos(){
        $pago = $_POST['pago'];
        $this->data =reportesModel::datapago($pago);
        ob_start();
        include './vistas/administrador/reports/pagos.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reporte_pagos.pdf", ["Attachment" => false]);
    }
    public function categoria(){
        $categoriai = $_POST['categoria'];
        if($categoriai == "todos"){
            $this->categoria = reportesModel::categorys();
        }else{
            $this->categoria = reportesModel::categorys($categoriai);
        }
        ob_start();
        include './vistas/administrador/reports/categoria.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reporte_jugadores.pdf", ["Attachment" => false]);
        
    }

}
?>