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
function jmmr_validar_formulario_hist()
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
function jmmr_historial_clinico() 
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
        wp_nonce_field('historial_paciente', 'historial_paciente_nonce'); ?>
            <h1>Crear historial clínico</h1>
            <h4>Ficha de identificación</h4>
        <div class="form-input">
            <label for="nombre">Nombre del paciente</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div class="form-input">
            <label for='parentesco'>Parentesco del informante</label>
            <select name="parentesco" id="rolpar" required>
                <option value="select">Seleccione</option>
                <option value="padre">Padre</option>
                <option value="madre">Madre</option>
                <option value="familiar">Familiar cercano</option>  
                <option value="amigo">Amigo</option>  
            </select> 
        </div>
        
        <div class="form-input">
            <label for='direccion'>Dirección</label>
            <textarea name="direccion" id="dir" cols="30" rows="10" style="height:100px;"></textarea>
        </div>

        <div class="form-input">
            <label for='telefono'>Teléfono celular</label>
            <input type="text" name="telefono" id="tel" required>
        </div>

        <div class="form-input">
            <label for='medico'>Medico de familia o pediatra</label>
            <input type="text" name="medico" id="med" required>
        </div>
    
        <div class="form-input">
            <label for="centro">Centro de salud de referencia</label>
            <input type="text" name="centro" id="cnt" required>    
        </div>
        <div class="form-input">
            <label for="ci">Cédula de identidad del paciente</label>
            <input type="number" name="ci" id="cid" required>    
        </div>
        <div class="form-input">
            <label for="numref">Numero de evaluación</label>
		    <input type="text" name="numref" id="nmref" required>
        </div>
        <div class="form-input">
            <label for="fechref">Fecha de evaluación</label>
		    <input type="datetime-local" name="fechref" id="feref" required>
        </div>
         <h3>Variables Sociodemográficas</h3>

         <div class="form-input">
            <label for="edad">Edad</label>
		    <input type="number" name="edad" id="age" required>
        </div>
        <div class="form-input">
            <label for="fechnac">Fecha de nacimiento</label>
		    <input type="datetime-local" name="fechnac" id="fenac" required>
        </div>

        <div class="form-input">
            <label for='parentesco'>Sexo</label>
            <select name="sexo" id="rolsex" required>
                <option value="select">Seleccione</option>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
                
            </select> 
        </div>
        <div class="form-input">
            <label for='parentesco'>Estado civil</label>
            <select name="estadociv" id="rolciv" required>
                <option value="select">Seleccione</option>
                <option value="soltero">Soltero/a</option>
                <option value="casado">Casado/a</option>
                <option value="viudo">Viudo/a</option>
                <option value="divorciado">Divorciado/a</option>
                <option value="convivencia">Convivencia</option>
                
            </select> 
        </div>
        <div class="form-input">
            <label for='estudio'>Nivel de estudio</label>
            <select name="estudio" id="rolest" required>
                <option value="select">Seleccione</option>
                <option value="sinestudio">Sin estudio</option>
                <option value="primaria">Primaria</option>
                <option value="secundaria">Secundaria</option>
                <option value="universitario">Universitario</option>                
            </select> 
        </div>
        <div class="form-input">
            <label for='situacion'>Situación lavoral</label>
            <select name="situacion" id="rolsit" required>
                <option value="select">Seleccione</option>
                <option value="amadecasa">Ama de casa</option>
                <option value="estudiante">Estudiante</option>
                <option value="autonomo">Autonomo</option>
                <option value="tranajador">Trabajador</option>                
            </select> 
        </div>
        <div class="form-input">
            <label for='ayuda'>Recibe ayuda economica?</label>
            <select name="ayuda" id="rolayu" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>               
            </select> 
        </div>
        <h3>Datos de la familia</h3>
        <div class="form-input">
            <label for='profesionpad'>Profesión del padre</label>
            <select name="profesionpadre" id="rolpad" required>
                <option value="select">Seleccione</option>
                <option value="autonomo">Autonomo</option>
                <option value="trabajadorcali">Trabajador cualificado</option>
                <option value="trabajadornocali">Trabajador no cualificado</option>
                <option value="jubilado">Jubilado</option>
                <option value="paro">En paro</option>                
                <option value="estudiante">Estudiante</option>                
            </select> 
        </div>
        <div class="form-input">
            <label for='profesionmad'>Profesión de la madre</label>
            <select name="profesionmad" id="rolmad" required>
                <option value="select">Seleccione</option>
                <option value="amadecasa">Ama de casa</option>
                <option value="autonomo">Autonomo</option>
                <option value="trabajadorcali">Trabajador cualificado</option>
                <option value="trabajadornocali">Trabajador no cualificado</option>
                <option value="jubilado">Jubilado</option>
                <option value="paro">En paro</option>                
                <option value="estudiante">Estudiante</option>                
            </select> 
        </div>
        
        <div class="form-input">
            <label for='profesionpareja'>Profesión de la pareja</label>
            <select name="profesionpareja" id="rolpar" required>
                <option value="select">Seleccione</option>
                <option value="noaplica">No aplica, sin pareja</option>
                <option value="amadecasa">Ama de casa</option>
                <option value="autonomo">Autonomo</option>
                <option value="trabajadorcali">Trabajador cualificado</option>
                <option value="trabajadornocali">Trabajador no cualificado</option>
                <option value="jubilado">Jubilado</option>
                <option value="paro">En paro</option>                
                <option value="estudiante">Estudiante</option>                
            </select> 
        </div>
        <div class="form-input">
            <label for='numhermanos'>Número de hermanos</label>
            <select name="numhermanos" id="rolher" required>
                <option value="select">Seleccione</option>
                <option value="notengo">No tengo hermanos</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="masdecuatro">más de 4</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for="hermanos">En caso afirmativo, es el hermano número:</label>
            <input type="number" name="hermano" id="numher" required>
        </div>
        <div class="form-input">
            <label for='numhijos'>Número de hijos</label>
            <select name="numhijos" id="rolhij" required>
                <option value="select">Seleccione</option>
                <option value="notengo">No tengo hijos</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="masdecuatro">más de 4</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='situapadres'>Situación de los padres</label>
            <select name="situapadres" id="rolsitpadr" required>
                <option value="select">Seleccione</option>
                <option value="casados">Casados</option>
                <option value="separados">Separados</option>
                <option value="concubinato">Concubinato</option>
                <option value="fallecido">Padre o madre han fallecido</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='ambiente'>Ambiente familiar conflictivo?</label>
            <select name="ambiente" id="rolamb" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>              
                <option value="no">No</option>              
            </select> 
        </div>

        <div class="form-input">
            <label for='conflicto'>En caso afirmativo, especificar:</label>
            <textarea name="conflicto" id="dir" cols="30" rows="10" style="height:100px;"></textarea>
        </div>

        <h3>Frecuencia de alimentación</h3>
        <div class="form-input">
            <label for='desayuno'>Indique frecuencia de desayunos en la semana</label>
            <select name="desayuno" id="roldes" required>
                <option value="select">Seleccione</option>
                <option value="diariamente">Diariamente</option>
                <option value="cincodias">5 días a la semana</option>
                <option value="tresdias">3 días a la semana</option>
                <option value="undia">1 día a la semana</option>               
                <option value="nunca">Casi nunca</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='almuerzo'>Indique frecuencia de almuerzos en la semana</label>
            <select name="almuerzo" id="rolalm" required>
                <option value="select">Seleccione</option>
                <option value="diariamente">Diariamente</option>
                <option value="cincodias">5 días a la semana</option>
                <option value="tresdias">3 días a la semana</option>
                <option value="undia">1 día a la semana</option>               
                <option value="nunca">Casi nunca</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='merienda'>Indique frecuencia de meriendas en la semana</label>
            <select name="merienda" id="rolmeri" required>
                <option value="select">Seleccione</option>
                <option value="diariamente">Diariamente</option>
                <option value="cincodias">5 días a la semana</option>
                <option value="tresdias">3 días a la semana</option>
                <option value="undia">1 día a la semana</option>               
                <option value="nunca">Casi nunca</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='cena'>Indique frecuencia de cenas en la semana</label>
            <select name="cena" id="rolcena" required>
                <option value="select">Seleccione</option>
                <option value="diariamente">Diariamente</option>
                <option value="cincodias">5 días a la semana</option>
                <option value="tresdias">3 días a la semana</option>
                <option value="undia">1 día a la semana</option>               
                <option value="nunca">Casi nunca</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='alimento'>Tiene alimentos prohibidos?</label>
            <select name="alimento" id="rolali" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='esconde'>Esconde comida?</label>
            <select name="esconde" id="rolescond" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='comeescondida'>Come a escondidas?</label>
            <select name="comeescondida" id="rolcomesc" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='seleccionaali'>Selecciona alimentos?</label>
            <select name="seleccionaali" id="rolseleali" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>

        <div class="form-input">
            <label for='desmigaja'>Desmigaja alimentos?</label>
            <select name="desmigaja" id="roldesmi" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='comelento'>Come lentamente durante las comidas?</label>
            <select name="comelento" id="rolcomelento" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='cocina'>Cocina o le preocupa la comida de los demás?</label>
            <select name="cocina" id="rolcocina" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='lugarcomida'>Come en un lugar diferente al resto de la familia?</label>
            <select name="lugarcomida" id="rolcomida" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>
        <div class="form-input">
            <label for='horario'>Come en un horario diferente al resto de la familia?</label>
            <select name="horario" id="rolhorario" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>              
            </select> 
        </div>

        <h3>Actitudes hacia la enfermedad y el tratamiento</h3>
        <div class="form-input">
            <label for='enfermedadtr'>Valore la intensidad de su transtorno de alimentacion
            <br> Elige un numero del 0 al 8 <br>
            Siendo 0: ningun problema y 8: un problema muy grave
            </label>
            <select name="enfermedadtr" id="rolenfermedadtr" required>
                <option value="select">Seleccione</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>               
                <option value="4">4</option>               
                <option value="5">5</option>               
                <option value="6">6</option>               
                <option value="7">7</option>               
                <option value="8">8</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='tratamiento'>Valore su deseo actual de recibir tratamiento
            <br> Elige un numero del 0 al 8 <br>
            Siendo 0: Ningún interés y 8: Muy interesado
            </label>
            <select name="tratamiento" id="roltrat" required>
                <option value="select">Seleccione</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>               
                <option value="4">4</option>               
                <option value="5">5</option>               
                <option value="6">6</option>               
                <option value="7">7</option>               
                <option value="8">8</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='gradotr'>Grado en que el transtorno alimenticio le limita su vida
            <br> Elige un numero del 0 al 8 <br>
            Siendo 0: Casi nada y 8: Mucho
            </label>
            <select name="gradotr" id="rolgradotr" required>
                <option value="select">Seleccione</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>               
                <option value="4">4</option>               
                <option value="5">5</option>               
                <option value="6">6</option>               
                <option value="7">7</option>               
                <option value="8">8</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='gradopreo'>Grado de preocupación por su transtorno alimenticio
            <br> Elige un numero del 0 al 8 <br>
            Siendo 0: Ninguna preocupación y 8: Muy preocupado
            </label>
            <select name="gradopreo" id="rolgradopreo" required>
                <option value="select">Seleccione</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>               
                <option value="4">4</option>               
                <option value="5">5</option>               
                <option value="6">6</option>               
                <option value="7">7</option>               
                <option value="8">8</option>               
            </select> 
        </div>
        <div class="form-input">
            <label for='gradopreo'>Grado de preocupación de familiares su transtorno 
            <br> Elige un numero del 0 al 8 <br>
            Siendo 0: Ninguna preocupación y 8: Muy preocupado
            </label>
            <select name="gradopreo" id="rolgradopreo" required>
                <option value="select">Seleccione</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>               
                <option value="4">4</option>               
                <option value="5">5</option>               
                <option value="6">6</option>               
                <option value="7">7</option>               
                <option value="8">8</option>               
            </select> 
        </div>

        <div class="form-input">
            <label for='gradopreo'>Consciencia de la enfermedad que tiene: </label>
            <select name="gradopreo" id="rolgradopreo" required>
                <option value="select">Seleccione</option>
                <option value="completa">Completa</option>
                <option value="parcial">Parcial</option>
                <option value="ausente">Ausente</option>             
            </select> 
        </div>

        <h1>Autorización de estadísticas</h1>

        <div class="form-input">
            <label for='autoriza'>Autoriza a la fundación ayudate a tomar y utilizar estos <br>
            resultados suministrados para realizar estadísticas e investigaciones <br>
            para darle los mejores tratamientos </label>
            <select name="autoriza" id="rolautoriza" required>
                <option value="select">Seleccione</option>
                <option value="si">Si</option>
                <option value="no">No</option>             
            </select> 
        </div>

        <div class="form-input">
            <input  name="enviaresp" id="reg" type="submit" value="Enviar" >
        </div>

       <!--  <button type="button" onclick="window.location.href='public_html/formacion'">Enlace </button> -->
    </form>
    <?php
     
    // Devuelve el contenido del buffer de salida
    return ob_get_clean();
}
?>

<?php

/** Aqui se valida el formulario y se hace la insercion del registro */
if (isset($_POST['enviaresp']) )
{	
    echo "metodo en pacientes";	
    //validar_password();
    if (jmmr_validar_formulario_hist())
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
    
