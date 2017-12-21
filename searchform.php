
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" id="buscar" class="btn" value="<?php echo esc_attr_x('Search', 'submit button') ?>"/>
</form>
