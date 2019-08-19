<?php

/** Se requiere la conexion a la bd para el registro del form
 * Creacion: domingo 18/ago/2019
 */
require_once(JMMR_RUTA . 'includes/conexion-bd.php');

/** Funciones arriba -- cuerpo del formulario despues */
function jmmr_mostrar_mensaje_error($mensajeError)
{
	  echo "<p class='error'><b>Campo requerido. </b>".$mensajeError ."</p>";		
}

/** Valida cada uno de los campos del formulario */
function jmmr_validar_formulario()
{
	if( $_POST['nombre'] == '' || $_POST['nombre'] == ' ' ){
		//mostrar_mensaje("Favor ingrese el nombre");              
		jmmr_mostrar_mensaje_error( "Favor ingrese el nombre");
		$hasError = true;
	}
	if( $_POST['apellido'] == '' || $_POST['apellido'] == ' ' ){
		jmmr_mostrar_mensaje_error( "Favor ingrese el apellido"); 
		$hasError = true;              
	}
	if( $_POST['correo'] == '' || $_POST['correo'] == ' '){
		jmmr_mostrar_mensaje_error( "Favor ingrese el correo electronico"); 
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
function jmmr_registrar_usuario() 
{
    // Carga esta hoja de estilo para poner más bonito el formulario
    wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));

    // Esta función de PHP activa el almacenamiento en búfer de salida (output buffer)
    // Cuando termine el formulario lo imprime con la función ob_get_clean
    ob_start();
    ?>
       <form action="<?php get_the_permalink(); ?>" method="post" id="form_aspirante" 
        class="formulario">
        <?php 
        /** Validacion de formulario */
        wp_nonce_field('registro_usuario', 'registro_usuario_nonce'); ?>
        <div class="form-input">
            <label for="rol">Rol</label>
            <select name="rol" id="rol" required>
                <option value="Select">Seleccione</option>}
                <option value="medico">Medico</option>
                <option value="paciente">Paciente</option>  
            </select> 
        </div>
        <div class="form-input">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div class="form-input">
            <label for="name">Apellido</label>
		    <input type="text" name="apellido" id="apellido" required>
        </div>
        <div class="form-input">
            <label for='correo'>Correo</label>
            <input type="email" name="correo" id="correo" required>
        </div>
        <div class="form-input">
            <label for="password">Contraseña:</label>
		    <input type="password" name="password" id="pwd" required>        </div>
        <div class="form-input">
            <label for="confirm_password">Confirmar contraseña:</label>
		    <input type="password" name="confirm_password" id="conf_pwd" required>
        </div>
        <div class="form-input">
            <label for="nivel_html">¿Cuál es tu nivel de HTML?</label>
            <input type="radio" name="nivel_html" value="1" required> Nada
            <br><input type="radio" name="nivel_html" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_html" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_html" value="4" required> Lo 
                domino al dedillo
        </div>

        <div class="form-input">
            <label for="motivacion">¿Porqué quieres aprender a programar en 
                    WordPress?</label>
            <textarea name="motivacion" id="motivacion" required></textarea>
        </div>
        <div class="form-input">
            <label for="aceptacion">Mi nombre es Fulano de Tal y Cual y me 
                comprometo a custodiar de manera responsable los datos que vas 
                a enviar. Su única finalidad es la de participar en el proceso 
                explicado más arriba. 
                En cualquier momento puedes solicitar el acceso, la rectificación 
                o la eliminación de tus datos desde esta página web.</label>
            <input type="checkbox" id="aceptacion" name="aceptacion" value="1" 
            required> Entiendo y acepto las condiciones
        </div>
        <div class="form-input">
            <input  name="submit" id="submit" type="submit" value="Enviar" >
        </div>
    </form>
    <?php
     
    // Devuelve el contenido del buffer de salida
    return ob_get_clean();
}
?>

<?php

/** Aqui se valida el formulario y se hace la insercion del registro */
if (isset($_POST['submit']) )
{		
    //validar_password();
    if (!jmmr_validar_formulario())
    {			
        jmmr_mostrar_mensaje_error("Campos no validos. No se puede realizar el registro.");
    } 
    else 
    {
        /** Instanciamos la conexion a la bd */
        $db = new BaseDatos();
        if($db->conectar())
        {
            $db->insert_user(
                sanitize_text_field($_POST['nombre']), 
                sanitize_email($_POST['correo']).'hola'
            );             
            $db->desconectar();
        } 
    }	
}
    
