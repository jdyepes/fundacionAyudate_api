<?php

/** Se requiere la conexion a la bd para el registro del form
 * Creacion: domingo 18/ago/2019
 */

require_once(JMMR_RUTA . 'includes/conexion-bd.php');
//include 'jmmr-registro-usuario.php';

/** Funciones arriba -- cuerpo del formulario despues */
/* function jmmr_mostrar_mensaje_error_pac($mensajeError)
{
	  echo "<p class='error'><b>Campo requerido. </b>".$mensajeError ."</p>";		
} */



/** 
 * Define la función que ejecutará el shortcode
 * De momento sólo pinta un formulario que no hace nada
 * Cuerpo del formulario
 * Creacion Sabado 3 agosto
 * @return string
 */
function jmmr_perfil() 
{
    // Carga esta hoja de estilo para poner más bonito el formulario
    wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));

    // Esta función de PHP activa el almacenamiento en búfer de salida (output buffer)
    // Cuando termine el formulario lo imprime con la función ob_get_clean
    ob_start();
    ?>
        
        <a href="public_html/historial_clinico">Crear historial clínico</a>
        
    <?php
     
    // Devuelve el contenido del buffer de salida
    return ob_get_clean();
}
?>

<?php

/** Aqui se valida el formulario y se hace la insercion del registro */

    
