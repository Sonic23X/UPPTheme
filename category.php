<?php get_header(); ?>
<h2>Categoría: <?php single_cat_title(); ?></h2>

<?php if ( have_posts() ) : ?>

  <section class = "cuerpo">

    <?php while ( have_posts() ) : the_post(); ?>
      <article class = "post">
        <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive responsive--full']);?>
        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
        <span class ="detalles">Post hecho por <?php the_author() ?> el <?php the_time('j'); ?> de
        <?php the_time('F'); ?> del <?php the_time('Y'); ?> - <?php the_date('H:m:s'); ?> hrs.</span>
      </article>
      <hr>
    <?php endwhile; ?>
    <div class="pagination">
      <span class="in-left"><?php next_posts_link('Entradas antiguas ->'); ?></span>
      <span class="in-right"><?php previous_posts_link('<- Entradas más recientes'); ?></span>
    </div>

    <?php else : ?>
      <h1><?php _e('No hay entradas.'); ?></h1>
    <?php endif; ?>
  </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
