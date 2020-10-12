<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'ghumti' ) ?></span>
		<input type="search" class="search-field"
		placeholder="<?php esc_attr_e( 'Search...', 'ghumti' ) ?>"
		value="<?php echo get_search_query() ?>" name="s"
		title="<?php esc_attr_e( 'Search for:', 'ghumti' ) ?>" />
	</label>
	<?php
	if(class_exists('WooCommerce')){
		?>
		<input type="hidden" name="post_type" value="product" />
		<?php
	}
	?>
	<input type="submit" class="search-submit"
	value="<?php esc_attr_e( 'Search', 'ghumti' ) ?>" />
</form>