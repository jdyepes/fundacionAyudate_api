<?php
/** 
 * Define la función que ejecutará el shortcode
 * De momento sólo pinta un formulario que no hace nada
 * 
 * @return string
 */
function Kfp_Aspirante_form_copy() 
{
    // Carga esta hoja de estilo para poner más bonito el formulario
    wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));

    // Esta función de PHP activa el almacenamiento en búfer de salida (output buffer)
    // Cuando termine el formulario lo imprime con la función ob_get_clean
    ob_start();
    ?>
       <form action="<?php get_the_permalink(); ?>" method="post" id="form_aspirante2" 
        class="formulario">
        <?php wp_nonce_field('graba_aspirante', 'aspirante_nonce'); ?>
        <div class="form-input">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div class="form-input">
            <label for='correo'>Correo</label>
            <input type="email" name="correo" id="correo" required>
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
            <label for="nivel_css">¿Cuál es tu nivel de CSS?</label>
            <input type="radio" name="nivel_css" value="1" required> Nada
            <br><input type="radio" name="nivel_css" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_css" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_css" value="4" required> Lo 
                domino al dedillo
        </div>
        <div class="form-input">
            <label for="nivel_js">¿Cuál es tu nivel de JavaScript?</label>
            <input type="radio" name="nivel_js" value="1" required> Nada
            <br><input type="radio" name="nivel_js" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_js" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_js" value="4" required> Lo domino al 
            dedillo
        </div>
        <div class="form-input">
            <label for="nivel_php">¿Cuál es tu nivel de PHP?</label>
            <input type="radio" name="nivel_php" value="1" required> Nada
            <br><input type="radio" name="nivel_php" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_php" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_php" value="4" required> Lo domino 
                al dedillo
        </div>
        <div class="form-input">
            <label for="nivel_wp">¿Cuál es tu nivel de WordPress?</label>
            <input type="radio" name="nivel_wp" value="1" required> Nada
            <br><input type="radio" name="nivel_wp" value="2" required> Estoy 
            aprendiendo
            <br><input type="radio" name="nivel_wp" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_wp" value="4" required> Lo domino 
                al dedillo
        </div>
        <div class="form-input">
            <label for="motivacion">¿Porqué quieres aprender a programar en 
                    WordPress?</label>
            <textarea name="motivacion" id="motivacion" required></textarea>
        </div>      
        <div class="form-input">
            <input type="submit" value="Enviar">
        </div>
    </form>
    <?php
     
    // Devuelve el contenido del buffer de salida
    return ob_get_clean();
}

?>