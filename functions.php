<?php

//walker
require_once get_template_directory() . '/wp-bootstrap-navwalker.php';

//imagen
if (function_exists('add_theme_support'))
add_theme_support('post-thumbnails');
set_post_thumbnail_size(590, auto);

function mis_menus()
{
  register_nav_menus(
    array(
      'navegation' => __( 'Menú de navegación' ),
    )
  );
}
add_action( 'init', 'mis_menus' );

function mis_widgets()
{
  register_sidebar(
    array(
    	'name'          => __( 'Sidebar' ),
    	'id'            => 'sidebar',
    	'before_widget' => '<div class="widget">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h3>',
    	'after_title'   => '</h3>',
    )
  );
}
add_action('init','mis_widgets');

function buscar_solo_posts($query)
{
  if($query->is_search) {
    $query->set('post_type','post');
  }
  return $query;
}
add_filter('pre_get_posts','buscar_solo_posts');

function estilos()
{
  wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css' );
  wp_enqueue_style( 'font-awesome_css', get_template_directory_uri() . '/vendor/fortawesome/font-awesome/css/font-awesome.min.css' );
  wp_enqueue_style( 'GOB_css', get_template_directory_uri() . '/seph/style.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'estilos');

function scripts()
{

	global $wp_scripts;

  wp_enqueue_script( 'jquery_js', get_template_directory_uri() . '/vendor/components/jquery/jquery.min.js' );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/js/bootstrap.min.js' );

}
add_action( 'wp_enqueue_scripts', 'scripts');

//comentarios
function modify_comments_fields($fields)
{
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

  $fields =  array(
    'author' =>
      '<input id="author" class ="form-control" name="author" type="text" placeholder="Tu nombre" value="'
      . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' required /><br>',

    'email' =>
      '<input id="email" class ="form-control" name="email" type="email" placeholder="Tu correo electronico" value="'
      . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' required /><br>',

    'url' =>
      '<input id="url" class ="form-control" name="url" type="text" placeholder="Tu sitio Web" value="'
      . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><br>',
  );

  return $fields;
}

function UPP_Comentarios($comment, $args, $depth)
{
  ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('hentry'); ?>>

  	<div class="vcard author entry-title image">
  		<?php if (function_exists('get_avatar')) { echo get_avatar($comment, 115); } ?>
  	</div>

  	<div class="entry-content comentario">
      <span class="n"><?php comment_author_link(); ?></span>
      <span class="published"><?php comment_date(); ?> - <?php comment_time(); ?></span>
      <br><br>

  		<?php if ($comment->comment_approved == '0') : ?>
  		<p class="notification"><em><?php _e('Your comment is awaiting moderation'); ?></em></p>
      <?php else : ?>
  		<?php comment_text(); ?>
      <?php endif; ?>
      <?php
        if (function_exists('comment_reply_link'))
        {
          comment_reply_link(array_merge( $args, array(
            'respond_id' => 'respond',
            'depth' => $depth,
            'max_depth' => $args['max_depth']
          )), $comment, $post);
        }
      ?>
      <!-- editar entrada -->
    	<?php edit_comment_link(); ?>
  	</div>
  </div>
  <br><br>
  <?php
}
