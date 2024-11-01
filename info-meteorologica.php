<?php
/*
Plugin Name: Información Meteorológica
Description: Muestra la información meteorológica de Sevilla en el encabezado.
Version: 1.0
Author: Luis Ortiz
*/
// Mostrar información meteorológica en el encabezado
function mostrar_informacion_meteorologica() {
    $api_key = 'c5aab2189c742aa6759a668c4b3ac177';
    $ciudad = 'Sevilla';
    $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . urlencode( $ciudad ) .'&appid=' . $api_key . '&units=metric&lang=es';
    $response = wp_remote_get( $url );
    if ( is_array( $response ) && ! is_wp_error( $response ) ) {
        $data = json_decode( $response['body'], true );
        if ( $data && $data['cod'] == 200 ) {
            $temperatura = $data['main']['temp'];
            $descripcion = $data['weather'][0]['description'];
            echo '<p class="info-meteorologica">El clima en ' . esc_html( $ciudad ) . ': '. esc_html( ucfirst( $descripcion ) ) . ', ' . esc_html( $temperatura ) . '°C</p>';
        }
    }
}
add_action( 'wp_footer', 'mostrar_informacion_meteorologica' );
