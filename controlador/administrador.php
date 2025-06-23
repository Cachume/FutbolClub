<?php
    class administrador extends vistas
    {   
        private $db;
        public $mensaje;
        public function __CONSTRUCT(){
            //parent::__construct();
            $this->db = new database();
            $contador=$this->db->selecionar("COUNT(*)","carnets","WHERE estado='En espera'");
            $contador2=$this->db->selecionar("COUNT(*)","usuarios","");
            $this->soli=$contador->fetch_assoc();
            $this->soli2=$contador2->fetch_assoc();
            if(isset($_SESSION['id'])){
                if($_SESSION['rol']!=1){
                    header('location: index.php?u=perfil');
                }  
                if($_SESSION['imagen']==""){
                    header('location: index.php?u=completar'); 
                }
            }else{
                header('location: index.php?u=login');
                exit();
            }
        }

        //Funciona que carga la vista principal
        public function load(){
            $this->vistad('index');
        }

        //funcion que carga la solicitud a revisar
        public function solicitud(){
            $info=$this->db->selecionar("id,nombres,apellidos,cdi,correo,imagen,sexo,fecha,carrera,direccion,tramo","usuarios", "WHERE id=".$_POST['idu']);
            $this->inf=$info->fetch_array();
            $userCarrera = $this->db->selecionar("carrera", "carreras", "WHERE id=".$this->inf['carrera']);
            $this->carre =$userCarrera->fetch_array(); 
            $this->vistad('solicitud');
        }

        //funcion que carga todas las solicitudes pendientes
        public function solicitudes(){
            $data=$this->db->mostrar("id,nombres,apellidos,cdi","usuarios","WHERE id IN (SELECT id_remitente FROM carnets WHERE estado='En espera')");
            $this->datos=$data;
            $this->vistad('solicitudes');
        }
        //funcion que carga todos los usuarios registrados
        public function usuarios(){
            $data=$this->db->mostrar("id,nombres,apellidos,cdi,correo,fecha,sexo,direccion","usuarios","");
            $this->datos=$data;
            $this->vistad('usuarios');
        }

        public function carreras(){
            $data=$this->db->mostrar("id,carrera","carreras","");
            $this->datos=$data;
            $this->vistad('carreras');
        }

        public function crearcarrera(){
            if(isset($_POST['enviado'])){
                if(isset($_POST['carrera'])){
                    $carrera = $_POST['carrera'];
                    $resultado=$this->db->insertar("carreras","carrera","'$carrera'");
                    if($resultado){
                        $mensaje=['mensaje'=>"Se añadio correctamente la carrera", 'pam'=> 'good'];
                        $this->mensaje= $mensaje;
                        $this->carreras();
                    }else{
                        $mensaje=['mensaje'=>"No se ha podido añadir la carrera", 'pam'=> 'good'];
                        $this->mensaje= $mensaje;
                        $this->carreras();
                    }
                   }else{
                    $this->carreras();
                   }
                }else{
                    $this->carreras();
                }
        }

        public function eliminarcarrera(){
            if(isset($_POST['ec'])){
               if(isset($_POST['idu'])){
                $idc=$_POST['idu'];
                $resultado=$this->db->eliminar("carreras","id=".$idc);
                if($resultado){
                    $mensaje=['mensaje'=>"Se elimino correctamente la carrera", 'pam'=> 'good'];
                    $this->mensaje= $mensaje;
                    $this->carreras();
                }else{
                    $mensaje=['mensaje'=>"No se ha podido eliminar la carrera", 'pam'=> 'good'];
                    $this->mensaje= $mensaje;
                    $this->carreras();
                }
               }else{
                $this->carreras();
               }
            }else{
                $this->carreras();
            }
        }
        //funcion para salir del panel de administrador
        public function salir(){
            header('location: index.php?u=perfil');
        }

        //funcion que carga los datos y la vista para editar los usuarios
        public function editarusuario(){
            if(isset($_POST['solic'])){
                if(is_numeric($_POST['idu'])){
                    //Consulta para traer los datos del usuarios
                    $query=$this->db->selecionar("nombres,cdi,apellidos,rol,correo,id","usuarios","WHERE id=".$_POST['idu']);
                    //Convertimos la consulta en un array y lo cargamos para que pueda ser accesible para la vita
                    $this->consulta=$query->fetch_assoc();
                    //Carga de la vista
                    $this->vistad('editarusuarios');
                }else{
                    //Si se pasa un valor que no sea tipo numerico se carga la vista usuarios
                    $this->usuarios();
                }
            }else{
                $this->usuarios();
            }
        }
        //Funcion para editar los datos de los usuarios
        public function edicionus(){
            //Verificacion que se viene del formulario correspondiente
            if(isset($_POST['modifiuser'])){
                //Variable que almacena el id del usuario el cual se modificara sus datos
                $idu=$_GET['id'];
                //Verificacion que el id sea numerico
                if(is_numeric($idu)){
                    //Almacenamos los datos que provienen del formulario
                    $nombres=$_POST['nombres'];
                    $apellidos=$_POST['apellidos'];
                    $correo=$_POST['correo'];
                    $rol=$_POST['rol'];
                    $cedula=$_POST['cedula'];
                    //Actualizamos los datos del usuario en bd
                    $query=$this->db->actualizar("nombres='".$nombres."', apellidos='".$apellidos."', cdi=".$cedula.", correo='".$correo."', rol=".$rol."","usuarios"," id=".$idu);
                    //Verificacion de actualzacion correcta
                    if($query){
                        $mensaje=['mensaje'=>"Se han actualizado los datos correctamente", 'pam'=> 'good'];
                        $this->mensaje= $mensaje;
                        $this->usuarios();
                    }else{
                        $mensaje=['mensaje'=>"Ha ocurrido un error al actualizar los datos", 'pam'=> 'error'];
                        $this->mensaje= $mensaje;
                        $this->usuarios();
                    }
                }else{
                    $this->usuarios();  
                }
            }else{
                $this->usuarios();
            }
        }
        //Funcion para aceptar o rechazar solicitudes de carnets
        public function csolicitud(){
            //Verificacion que la solicitud proviene del formulario
            if(isset($_POST['accion'])){
                //Switch para manejar las acciones acorde a lo que se preciono
                switch ($_POST['accion']) {
                    //En caso de precionar el boton aceptar
                    case 'aceptar':
                        //Almacenamos en una variable la id del usuario
                        $id=$_POST['iduser'];
                        //Actualizamos su estado a Aceptado
                        $cambio=$this->db->actualizar("estado='Aceptado'","carnets","id_remitente=".$id."");
                        //Verificacion que se actualizo correctamente
                        if($cambio){
                            $this->vistad('soliaceptar');
                        }   
                        break;
                    //En case de precionar el boton rechazar
                    case 'rechazar':
                        //Alcanamos el motivo en una variable
                        $motivo=$_POST['motivo'];
                        //Carga del motivo para la vista
                        $this->motivo=$_POST['motivo'];
                        //Almacenamos en una variable la id del usuario
                        $id=$_POST['iduser'];
                        //Actualizamos el estado a Rechazado
                        $cambio=$this->db->actualizar("estado='Rechazado', motivo='".$motivo."'","carnets","id_remitente=".$id."");
                        //Verificacion que se actualizo correctamente
                        if($cambio){
                            $this->vistad('solirechazar');
                        }   
                        break;
                }
            }else{
                header('location: index.php?u=administrador&m=solicitudes');
                }
        }
        //Funcion para registrar un nuevo usuario en el sistema
        public function registerus()
        {   
            if(isset($_POST['enviado']))
            {
                $datos [0]=$_POST['nombre']; //nombres
                $datos [1]=$_POST['apellido']; //apellidos
                $datos [2]=$_POST['cdi'];// cedula
                $datos [3]=$_POST['correo']; //correo
                $datos [4]=$_POST['password']; //contrasena
                $datos [5]=$_POST['passwordc']; //confirmacioncontrasena
                $patron = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[.$%#&]).{1,}$/';
                //Verificacion que los nombres y apellidos tengan menos de 8 y mas de 30
                if(strlen($datos[0])<8 || strlen($datos[0])>30 || strlen($datos[1])<8 || strlen($datos[1])>30){
                    $mensaje=['mensaje'=>"El tamaño del nombre y apellido debe contener min 8, max 30", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                    exit();
                }
                //Verificacion que la cedula de identidad tenga una longitud menor a 8 y mayor a 8
                if(strlen($datos[2])<8 || strlen($datos[2])>8 ){
                    $mensaje=['mensaje'=>"La cedula ingresada no es valida", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                    exit();
                }
                //Verificacion si el correo esta incorrecto
                if(!filter_var($datos[3], FILTER_VALIDATE_EMAIL)){
                    $mensaje=['mensaje'=>"El correo electronico ingresado no es valido", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                    exit();
                }
                //Verificacion de la contraseña si contiene menos de 8 caracteres o mas de 30
                if(strlen($datos[4])<8 || strlen($datos[4])>30){ 
                    $mensaje=['mensaje'=>"La contraseña debe tener un longitud min de 8 y max de 30", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                    exit();
                    //Verificacion que las contraseñas sean distintas
                }elseif($datos[4] !== $datos[5]){
                    $mensaje=['mensaje'=>"Las contraseñas no coinciden", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                    exit();
                    //Verificacion que la contraseña cumpla con el patron definido anteriormente
                }elseif (!preg_match($patron,$datos[4])) {
                    $mensaje=['mensaje'=>"La contraseña no cumple con los requisitos.", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                    exit();
                }
                //Consulta para verificar que la cedula ingresada ya este en la bd
                $con=$this->db->selecionar("cdi","usuarios","WHERE cdi=".$datos[2]);
                //Verificacion que la cedula no este ya registrada
                if ($con->num_rows ==1)
                {
                    $mensaje=['mensaje'=>"La cedula de identidad se encuentra en uso", 'pam'=>'error'];
                    $this->mensaje= $mensaje;
                    $this->usuarios();
                }else{
                    //Consulta para traer algun registro con el correo ingresado
                    $con=$this->db->selecionar("correo","usuarios","WHERE correo='".$datos[3]."'");
                    //Verificacion que el correo no este registrado
                    if ($con->num_rows == 1){
                        $mensaje=['mensaje'=>"El correo electronico se encuentra uso", 'pam'=> 'error'];
                        $this->mensaje= $mensaje;
                        $this->usuarios();
                    }else{//Registro del usuario en la base de datos
                        //Establecemos la variable rol en 2 que significa "Estudiante"
                        $rol = 2;
                        //Encriptación de la contraseña
                        $passwordpro = password_hash($datos[4], PASSWORD_BCRYPT);
                        //Creamos el registro en la base de datos
                        $resultado=$this->db->insertar("usuarios","nombres, apellidos, cdi, rol, correo, contrasena","'".$datos[0]."', "."'".$datos[1]."', "."".$datos[2].",".$rol.","."'".$datos[3]."', "."'".$passwordpro."'");
                        $mensaje=['mensaje'=>"Se ha registrado el usuario exitosamente", 'pam'=> 'good'];
                        $this->mensaje= $mensaje;
                        $this->usuarios();
                    }   
                }
            }
        }


    }
?>