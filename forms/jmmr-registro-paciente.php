<?php

/** Se requiere la conexion a la bd para el registro del form
 * Creacion: domingo 18/ago/2019
 */

require_once(JMMR_RUTA . 'includes/conexion-bd.php');
include 'jmmr-registro-usuario.php';

/** Funciones arriba -- cuerpo del formulario despues */
/* function jmmr_mostrar_mensaje_error_pac($mensajeError)
{
	  echo "<p class='error'><b>Campo requerido. </b>".$mensajeError ."</p>";		
} */

/** Valida cada uno de los campos del formulario */
function jmmr_validar_formulario_pac()
{
	if( $_POST['nombre'] == '' || $_POST['nombre'] == ' ' ){
		//mostrar_mensaje("Favor ingrese el nombre");              
		jmmr_mostrar_mensaje_error( "Favor ingrese el nombre");
		$hasError = true;
	}
	if( $_POST['correo'] == '' || $_POST['correo'] == ' '){
		jmmr_mostrar_mensaje_error( "Favor ingrese el correo electronico"); 
		$hasError = true;              
    }
    if( $_POST['telefono'] == '' || $_POST['telefono'] == ' ' ){
		jmmr_mostrar_mensaje_error( "Favor ingrese el teléfono celular"); 
		$hasError = true;              
    }
    if( $_POST['usuario'] == '' || $_POST['usuario'] == ' ' ){
		jmmr_mostrar_mensaje_error( "Favor ingrese el usuario"); 
		$hasError = true;              
	}
    if  (!is_email($_POST['correo'])) {
        jmmr_mostrar_mensaje_error( "Favor ingrese un correo valido"); 
		$hasError = true;  
    }
	if( $_POST['password'] == '' || $_POST['password'] == ' ' ){
		jmmr_mostrar_mensaje_error( "Favor ingrese la contraseña");     
		$hasError = true;          
	}
	if( $_POST['confirm_password'] == '' || $_POST['confirm_password'] == ' ' ){
		jmmr_mostrar_mensaje_error( "Favor ingrese para confirmar la contraseña"); 
		$hasError = true;              
    }
    return $hasError;
}

/** 
 * Define la función que ejecutará el shortcode
 * De momento sólo pinta un formulario que no hace nada
 * Cuerpo del formulario
 * Creacion Sabado 3 agosto
 * @return string
 */
function jmmr_registrar_paciente() 
{
    // Carga esta hoja de estilo para poner más bonito el formulario
    wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));

    // Esta función de PHP activa el almacenamiento en búfer de salida (output buffer)
    // Cuando termine el formulario lo imprime con la función ob_get_clean
    ob_start();
    ?>
        
       <form action="<?php get_the_permalink(); ?>" method="post" id="form_aspirante" 
        class="formulario" novalidate="">
        <?php   
        /** Validacion de formulario */
        wp_nonce_field('registro_paciente', 'registro_paciente_nonce'); ?>
       
        <div class="form-input">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div class="form-input">
            <label for='correo'>Correo</label>
            <input type="email" name="correo" id="correo" required>
        </div>
        
        <div class="form-input">
            <label for='telefono'>Teléfono celular</label>
            <input type="text" name="telefono" id="tel" required>
        </div>

        <div class="form-input">
            <label for='usuario'>Usuario</label>
            <input type="text" name="usuario" id="user" required>
        </div>
    
        <div class="form-input">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="pwd" required>    
        </div>
        <div class="form-input">
            <label for="confirm_password">Confirmar contraseña:</label>
		    <input type="password" name="confirm_password" id="conf_pwd" required>
        </div>
        
    
        <div class="form-input">
            <input  name="register" id="reg" type="submit" value="Registrar" >
        </div>
    </form>
    <?php
     
    // Devuelve el contenido del buffer de salida
    return ob_get_clean();
}
?>

<?php

/** Aqui se valida el formulario y se hace la insercion del registro */
if (isset($_POST['register']) )
{	
    echo "metodo en pacientes";	
    //validar_password();
    if (jmmr_validar_formulario_pac())
    {			
        jmmr_mostrar_mensaje_error("Campos no validos. No se puede realizar el registro.");
    } 
    else 
    {
        /** Instanciamos la conexion a la bd */
        $db = new BaseDatos();
        if($db->conectar())
        {
            $db->reg_pac(
                sanitize_text_field($_POST['nombre']), 
                sanitize_email($_POST['correo']).'hola'
            );             
            $db->desconectar();
        } 
    }	
}
    
