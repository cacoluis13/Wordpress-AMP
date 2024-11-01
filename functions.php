<?php
// Carga el estilo del tema padre
function storefront_child_enqueue_styles() 
{
    wp_enqueue_style('storefront-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'storefront_child_enqueue_styles');

//Calculos de Descuentos 
function aplicarDescuento($precio, $porcentaje) 
{
    $descuento = $precio * ($porcentaje / 100);
    return $precio - $descuento;
}

//Calculos de impuestos
function calcularImpuestos($precio, $tasaImpuestos) 
{
    $impuestos = $precio * ($tasaImpuestos / 100);
    return $precio + $impuestos;
}

//Gestión de Stock
function gestionarStock($product_id, $cantidad) 
{
    if ($cantidad < 0) 
    {
        return 'Cantidad inválida';
    }
    wc_update_product_stock($product_id, $cantidad);
}


/************************************************************************************************************/



//Procesamiento del Formulario Contacto
function procesarFormularioContacto() 
{
    global $wpdb; //declaramos para acceder a la instancia de la bbdd 

    //insertar las credenciales del wp-config.php
    $db_name = DB_NAME;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_host = DB_HOST;

    $wpdb = new wpdb($db_user, $db_password, $db_name, $db_host);

    if (isset($_POST['enviar'])) 
    {
        $nombre = sanitize_text_field($_POST['nombre']);
        $email = sanitize_email($_POST['email']);
        $mensaje = sanitize_textarea_field($_POST['mensaje']);
        
        if (!empty($nombre) && !empty($email) && !empty($mensaje)) 
        {
            $para = "contacto@nautifly.com";
            $asunto = "Consulta de Cliente";
            $cuerpo = "Nombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";
            wp_mail($para, $asunto, $cuerpo);

            //mostrar mensaje de formulario correcto
            echo '<script> alert("Datos enviados correctamente"); </script>' ;
            echo '<script> windows.location.href = "http://localhost:8080/?page_id=13"; </script>' ;
        } 
        else 
        {
            echo "Por favor completa todos los campos.";
        }
    }

    $tabla = 'wp_contactos';

    //insertamos en la tabla 
    $insertado = $wpdb->insert(
        $tabla,
        array(
            'nombre' => $nombre,
            'email' => $email,
            'mensaje' => $mensaje,
        ),
        array('%s', '%s', '%s')
    );

    //mensaje de exito
    if ($insertado) {
        $_SESSION['mensaje'] = "Mensaje guardado con éxito en la base de datos.";
    } else {
        $_SESSION['mensaje'] = "Hubo un error al guardar el mensaje en la base de datos.";
    }
    
    
}

add_action('wp', 'procesarFormularioContacto');

?>