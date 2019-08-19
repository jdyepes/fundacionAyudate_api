<?php

/*
* Plugin Name: JMMR Fundacion Ayudate
* Plugin URI: https://fundacionayudate.org.ve
* Description: Modulo que contiene formularios de Historiales clinicos, especialistas y pacientes de la fundacion ayudate
* Utiliza el shortcode [kfp_aspirante_form] para que el formulario 
* Version: 1.0
* Author: Jesus Yepes, Minerva Morales, Marco Ali, Roberto Vazquez
* Author URI: https://fundacionayudate.org.ve
* License: GPL2
*/

defined('ABSPATH') or die("Bye bye");

// Se asigna a la constante la ruta del plugin
define('JMMR_RUTA',plugin_dir_path(__FILE__));

/** Formulario Registro de usuario */
/** Estandar a seguir para la creacion de los formularios
 * prefijo : jmmr , nombre del formulario y con form al final
 */
// Define el shortcode [jmmr_registrar_usuario_form] y lo asocia a una función
add_shortcode('jmmr_registrar_usuario_form', 'jmmr_registrar_usuario');
// Llama al formulario de registro de usuario
include(JMMR_RUTA . 'forms/jmmr-registro-usuario.php');

// Define el shortcode [jmmr_registrar_usuario_form] y lo asocia a una función
add_shortcode('jmmr_registrar_usuario_form_copy', 'Kfp_Aspirante_form_copy');
// Llama al formulario de registro de usuario
include(JMMR_RUTA . 'forms/jmmr-registro-usuario copy.php');


