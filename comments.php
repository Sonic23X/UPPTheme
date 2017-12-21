<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf(__('1 comentario'));
			} else {
				printf(
					_nx(
						'%1$s comentario',
						'%1$s comentarios',
						$comments_number,
						'comments title'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<div class="comment-list">
			<?php
				wp_list_comments('type=comment&callback=UPP_Comentarios');
			?>
		</div>

<?php

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e('Comments are closed.'); ?></p>
	<?php
	endif;

	comment_form(array(
		'fields' => apply_filters( 'comment_form_default_fields', modify_comments_fields($fields)),
    'title_reply' => __('Si tienes dudas, ¡Comenta!'),
    'label_submit' => __('Publicar comentario'),
		'class_submit' => 'submit btn',
    'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="8" class="form-control"
                        aria-required="true" placeholder="'.__('Escribe aqui tu comentario...').'" required ></textarea>',
    'comment_notes_before' => ''.__('Tu correo no se visualizará. Los campos con * son obligatorios').'<br><br>',
    'comment_notes_after' => '<br>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf(
    										__( 'Usuario: %2$s. <a href="%3$s">¿Deseas Salir?</a>' ),
      admin_url('profile.php'),
      $user_identity,
      wp_logout_url(apply_filters('the_permalink', get_permalink()))
    ) . '</p>'
  ));
	?>

</div><!-- #comments -->
