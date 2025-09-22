<?php
    include_once 'modelo/usermodel.php';
    
    class Usuario extends vistas{

        public $data;
        public function __construct(){
            if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "user"){
                session_destroy();
                header("Location:/FutbolClub/login");
                exit();
            }
        }
        public function load(){
            $this->vistan('user/index');
        }

        public function misJugadores(){
            $rep_id = $_SESSION["cedula"];
            $this->data = userModel::getMysPlayers($rep_id);
            $this->vistan('user/misjugadores');
        }

        public function pagar(){
            $rep_id = $_SESSION["cedula"];
            $this->data = userModel::getMyPayments($rep_id);
            $this->vistan('user/misjugadores_pagos');
        }

        public function pago(){
            $rep_id = $_SESSION["cedula"];
            $url = $_GET['url'] ?? 'login';
            $partes= explode('/', trim($url));
            $validar = userModel::validarAccesoPago(intval($partes[2]),$rep_id);
            if($validar){
                $this->data = userModel::DatosdePago(intval($partes[2]),$rep_id);
                $this->vistan('user/pago');
            }else{
                header("Location:/FutbolClub/usuario");
            }
        }
    }
?>