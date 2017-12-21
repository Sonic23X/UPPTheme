<!-- Archivo de cabecera gobal de Wordpress -->
<?php get_header(); ?>
<!-- Contenido del post -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class = "cuerpo">
      <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive responsive--full']);?>
      <h1><?php the_title(); ?></h1>
      <span class ="detalles">Post hecho por <?php the_author() ?> el <?php the_time('j'); ?> de
      <?php the_time('F'); ?> del <?php the_time('Y'); ?> - <?php the_date('H:m:s'); ?> hrs.</span>
      <br><br>
      <?php the_content(); ?>
      <!-- Comentarios -->
      <?php
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      ?>
  </section>
<?php else : ?>
  <p><?php _e('Error, esta entrada no existe.'); ?></p>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>
