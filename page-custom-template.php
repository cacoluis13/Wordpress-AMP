<?php
/**
 * Template Name: Custom Template
 * Template Post Type: page
 */

// Asegúrate de que no se puede acceder directamente al archivo
if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

// Incluir el encabezado del tema
get_header();
?>

<main id="main" class="site-main" role="main">
    <section class="custom-section">
        <h1><?php the_title(); ?></h1>
        <div class="custom-content">
            <?php
            // Loop de WordPress
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            else :
                echo '<p>No hay contenido disponible.</p>';
            endif;
            ?>
        </div>
    </section>
</main>

<?php
// Incluir el pie de página del tema
get_footer();
