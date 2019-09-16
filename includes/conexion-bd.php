<?php

/**
 * Lectura de los parametros de conexion de la base de datos
 */
require_once(JMMR_RUTA . 'config.php');

class BaseDatos
{
    protected $conexion;
    protected $db;

    public $mensajeError = "Por favor comuniquese con el administrador del sitio web.";

    public function conectar()
    {
        $this->conexion = new mysqli(jmmr_HOST, jmmr_USER, jmmr_PASS,jmmr_DBNAME);
        if ($this->conexion == 0) DIE("<p class='error'><b>Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error(). " </b>");
        return true;

    }

    public function desconectar()
    {
        if ($this->conectar->conexion) {
            mysql_close($this->$conexion);
        }
    }

    /**
     * Se realizaran todas las operaciones necesarias de consulta e inserciones en la bdd
     * invocadas desde cada uno de los formularios (vistas)
     * Fecha: domingo 18 de agosto 2019
     */
    // ========================= Operaciones de lo que haremos para la base de datos =====================

    /**
     * Pendiente por arrelar mensaje para quitar el reenvio de formulario
     * y colocar la redireccion de la pagina a abrir cuanddo termine la insercion
     * Fecha: lun 19 agos 2019
     */
    public function insert_user($nombre, $correo){
    $conexion = $this->conexion;
        if(!$conexion)
        {              
            echo "<p class='error'><b>No se pudo realizar el registro del usuario. </b>".$this->mensajeError ."</p>";
        }
        else 
        {
            $query="INSERT INTO usuario_login (correo,password, Pacienteid,Medicoid) VALUES ('$nombre', '$correo', null,1)";

            //$ejecutar =mysql_query($query);
            $ejecutar = $conexion->query($query);
            if(!$ejecutar=== TRUE){
                echo "<p class='error'><b> Hubo un error en </b>" .$query . "<br>" . $conexion->error ."</p>";                    
            }
            else {
                //echo "Datos guardado correctamente <br> <a href=''>Volver</a>";
                //echo '<script language="javascript">alert(" ✔ Datos guardado correctamente ");</script>';			
                echo "<p class='exito' <b> ✔ Datos guardado correctamente </b></p>";
            }
            $conexion->close();
        }	
    }
    //registra paciente
    public function reg_pac($nombre, $correo){
        $conexion = $this->conexion;
            if(!$conexion)
            {              
                echo "<p class='error'><b>No se pudo realizar el registro del usuario. </b>".$this->mensajeError ."</p>";
            }
            else 
            {
                $query="INSERT INTO paciente (nombre,apellido) VALUES ('$nombre', '$correo')";
    
                //$ejecutar =mysql_query($query);
                $ejecutar = $conexion->query($query);
                if(!$ejecutar=== TRUE){
                    echo "<p class='error'><b> Hubo un error en </b>" .$query . "<br>" . $conexion->error ."</p>";                    
                }
                else {
                    //echo "Datos guardado correctamente <br> <a href=''>Volver</a>";
                    //echo '<script language="javascript">alert(" ✔ Datos guardado correctamente ");</script>';			
                    echo "<p class='exito' <b> ✔ Datos guardado correctamente </b></p>";
                }
                $conexion->close();
            }	
        }
}