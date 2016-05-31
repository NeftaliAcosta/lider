<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Skacero Pro
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'skacero-pro' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'skacero-pro' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'skacero-pro' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'skacero-pro' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'skacero_pro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function skacero_pro_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'skacero-pro' ),
		$time_string
	);

	echo '<span class="posted-on"><i class="space fa fa-calendar"></i> ' . $posted_on . '</span>';

}
endif;

// Prints Author Name.
if ( ! function_exists( 'skacero_pro_entry_author' ) ) :
function skacero_pro_entry_author() {
    if ( 'post' == get_post_type() ) {
            $byline = sprintf(
		_x( '%s', 'post author', 'skacero-pro' ),
		'<span class="author vcard"><span class="url fn"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( get_the_author() ) . '</a></span></span>'
	);
            echo '<span class="theauthor"><i class="fa fa-user"></i> ' . $byline . '</span>';
    }
}
endif;

// Prints Category.
if ( ! function_exists( 'skacero_pro_entry_category' ) ) :
function skacero_pro_entry_category() {
    if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'skacero-pro' ) );
		if ( $categories_list && skacero_pro_categorized_blog() ) {
			printf( '<div class="thecategory"><i class="fa fa-folder-open"></i> ' . __( '%1$s', 'skacero-pro' ) . '</div>', $categories_list );
		}
    }
}
endif;

// Prints number of Comments.
if ( ! function_exists( 'skacero_pro_entry_comments' ) ) :
function skacero_pro_entry_comments() {
	if ( get_theme_mod('comments_count') != 'off' ) {
		if ( 'post' == get_post_type() ) {
              $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                  if ( comments_open() ) {
                       if ( $num_comments == 0 ) {
		       $comments = __('No Comments', 'skacero-pro' );
	               } elseif ( $num_comments > 1 ) {
		       $comments = $num_comments . __(' Comments', 'skacero-pro' );
	               } else {
           	       $comments = __('1 Comment', 'skacero-pro' );
	               }
	               $write_comments = $comments;
                       } else {
	               $write_comments =  __('Comments Off!', 'skacero-pro' );
                  }
    
		if ( $write_comments ) {
			printf( '<span class="comments"><i class="fa fa-comments"></i> ' . __( '%1$s', 'skacero-pro' ) . '</span>', $write_comments );
			}
		}
	}
}
endif;

// Prints Post Tags.
if ( ! function_exists( 'skacero_pro_entry_tags' ) ) :
function skacero_pro_entry_tags() {
    if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'skacero-pro' ) );
		if ( $tags_list ) {
			printf( '<span class="thetags"><i class="fa fa-tags"></i> ' . __( '%1$s', 'skacero-pro' ) . '</span>', $tags_list );
		}
    }
}
endif;


if ( ! function_exists( 'skacero_pro_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function skacero_pro_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'skacero-pro' ) );
		if ( $categories_list && skacero_pro_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'skacero-pro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'skacero-pro' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'skacero-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'skacero-pro' ), esc_html__( '1 Comment', 'skacero-pro' ), esc_html__( '% Comments', 'skacero-pro' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'skacero-pro' ), '<span class="edit-link">', '</span>' );
}
endif;





/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function skacero_pro_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'skacero_pro_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'skacero_pro_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so skacero_pro_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so skacero_pro_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in skacero_pro_categorized_blog.
 */
function skacero_pro_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'skacero_pro_categories' );
}
add_action( 'edit_category', 'skacero_pro_category_transient_flusher' );
add_action( 'save_post',     'skacero_pro_category_transient_flusher' );
