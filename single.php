<?php get_header(); ?>
<?php
	$portfolio_id = 10;
	global $post;
	$post->post_parent = $portfolio_id;
?>

<div class="content-100 is-singular" id="subslider">
	<ul>
		<li style="background-image: url('<?php $slider = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); echo $slider['0']; ?>');">
			<span class="before"></span>
			<div class="container center displaytable mover">
				<div class="table">
					<h5>Blog</h5>
				</div>	
			</div>
		</li>
	</ul>
</div>

<div id="crumblepath" class="content-100 lightgrey">
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>
	</div>
</div>

<div id="content" class="content-100 white">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// check if the flexible content field has rows of data
	if( have_rows('blog_content') ):
	     // loop through the rows of data
	    while ( have_rows('blog_content') ) : the_row();
	        if( get_row_layout() == 'wp_content' ):
	?>
	<section id="intro" class="content-100 white center">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
			<header class="entry-header">
				<h4><?php the_field('type_content'); ?></h4>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-meta">
				<?php /*<span><?php echo app_posted_on(); ?></span>*/ ?>
				<span class="screen-reader-text post-date updated"><?php the_date('d-m-Y'); ?></span>
				<span class="screen-reader-text vcard author post-author" style="display: none;"><span class="fn"><?php the_author(); ?></span></span>
			</div>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<?php endwhile; // end of the loop. ?>
		</div>
	</section>
	<?php
	    elseif( get_row_layout() == 'content' ): 
	?>
	<section class="content content-100 overflow-hidden white center">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
			<?php if( get_sub_field('titel') ): ?>
			<header class="entry-header">
				<h2 class="entry-title"><?php the_sub_field('titel'); ?></h2>
			</header>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_sub_field('content'); ?>
			</div><!-- .entry-content -->
			<?php endwhile; // end of the loop. ?>
		</div>
	</section>
	<?php
	    elseif( get_row_layout() == 'bol' ): 
	?>
	<section id="bol" class="content-100 overflow-hidden white center">
		<div class="container">
			<header class="entry-header">
				<h4 class="entry-title">Interessante artikelen voor dit bericht</h4>
			</header>
			<div class="entry-content">
				<?php the_field('bolcom'); ?>
			</div>
		</div>
	</section>
	<?php
	    elseif( get_row_layout() == 'booking' ): 
	?>
	<section id="booking" class="content-100 black">
		<div class="overlay spacetop spacebottom">
			<div class="container">
				<div class="content-66">
					<h5>Boek een hotel in <?php the_sub_field('stad'); ?></h5>
					<p>Overtuigd? Boek dan direct een hotel in <?php the_sub_field('stad'); ?> via Booking.com</p>
				</div>
				<div class="content-33 bookingsearch"><?php dynamic_sidebar('booking'); ?></div>
			</div>
			<br class="clear" />
		</div>
	</section>
	<?php
	    elseif( get_row_layout() == 'tags' ): 
	?>
	<?php if( has_tag() ) { ?>
	<section id="tags" class="content-100 center white">
		<div class="container">
			<div class="intro content-100">
				<header class="entry-title">
					<h4>Tags</h4>
				</header>
			</div>
			<?php
			$tags = wp_get_post_tags($post->ID);
			$html = '<div class="post_tags">';
			foreach ( $tags as $tag ) {
				$tag_link = get_tag_link( $tag->term_id );
						
				$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
				$html .= "{$tag->name}</a>";
			}
			$html .= '</div>';
			echo $html;
			?>
		</div>
	</section>
	<?php } else {} ?>
	<?php
		elseif( get_row_layout() == 'losse_afbeelding' ): 
	?>
	<section class="losse-afbeelding content-100 overflow-hidden white center">
		<div class="container">
			<div class="entry-content">
			<?php if (is_mobile()) { ?>
				<?php 
					$image = get_sub_field('losse_afbeelding');
					if( !empty($image) ): 
					// vars
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];
					// thumbnail
					$size = 'mobiles';
					$thumb = $image['sizes'][ $size ];
					$width = $image['sizes'][ $size . '-width' ];
					$height = $image['sizes'][ $size . '-height' ];
				?>
					<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />						
				<?php endif; ?>
			<?php } else { ?>
				<?php 
					$image = get_sub_field('losse_afbeelding');
					if( !empty($image) ): 
					// vars
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];
					// thumbnail
					$size = 'full';
					$thumb = $image['sizes'][ $size ];
					$width = $image['sizes'][ $size . '-width' ];
					$height = $image['sizes'][ $size . '-height' ];
				?>
					<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" />
				<?php endif; ?>
			<?php } ?>
			</div>
		</div>
	</section>
	<?php
		elseif( get_row_layout() == 'dubbele_afbeelding' ): 
	?>
	<section class="dubbele-afbeelding content-100 overflow-hidden white center">
		<div class="container">
			<div class="content-100">
				<div class="content-50">
					<?php if (is_mobile()) { ?>
						<?php 
							$image = get_sub_field('losse_afbeelding_1');
							if( !empty($image) ): 
							// vars
							$url = $image['url'];
							$title = $image['title'];
							$alt = $image['alt'];
							$caption = $image['caption'];
							// thumbnail
							$size = 'mobiles';
							$thumb = $image['sizes'][ $size ];
							$width = $image['sizes'][ $size . '-width' ];
							$height = $image['sizes'][ $size . '-height' ];
						?>
							<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />						
						<?php endif; ?>
					<?php } else { ?>
						<?php 
							$image = get_sub_field('losse_afbeelding_1');
							if( !empty($image) ): 
							// vars
							$url = $image['url'];
							$title = $image['title'];
							$alt = $image['alt'];
							$caption = $image['caption'];
							// thumbnail
							$size = 'full';
							$thumb = $image['sizes'][ $size ];
							$width = $image['sizes'][ $size . '-width' ];
							$height = $image['sizes'][ $size . '-height' ];
						?>
							<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" />
						<?php endif; ?>
					<?php } ?>
				</div>
				<div class="content-50">
					<?php if (is_mobile()) { ?>
						<?php 
							$image = get_sub_field('losse_afbeelding_2');
							if( !empty($image) ): 
							// vars
							$url = $image['url'];
							$title = $image['title'];
							$alt = $image['alt'];
							$caption = $image['caption'];
							// thumbnail
							$size = 'mobiles';
							$thumb = $image['sizes'][ $size ];
							$width = $image['sizes'][ $size . '-width' ];
							$height = $image['sizes'][ $size . '-height' ];
						?>
							<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />						
						<?php endif; ?>
					<?php } else { ?>
						<?php 
							$image = get_sub_field('losse_afbeelding_2');
							if( !empty($image) ): 
							// vars
							$url = $image['url'];
							$title = $image['title'];
							$alt = $image['alt'];
							$caption = $image['caption'];
							// thumbnail
							$size = 'full';
							$thumb = $image['sizes'][ $size ];
							$width = $image['sizes'][ $size . '-width' ];
							$height = $image['sizes'][ $size . '-height' ];
						?>
							<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" />
						<?php endif; ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<?php
		elseif( get_row_layout() == 'afbeelding_alt' ): 
	?>
	<section class="content-100 overflow-hidden white center alt-afbeelding">
		<div class="container">
			<div class="entry-content">
				<?php the_sub_field('afbeelding_omschrijving'); ?>
			</div>
		</div>
	</section>
	<?php
		elseif( get_row_layout() == 'google_maps' ): 
	?>
	<section class="content-100 overflow-hidden " id="googlemaps">
	<!-- Google Maps -->
	<script type="text/javascript">
	function initialize() {
		var map = new google.maps.Map(
			document.getElementById('googlemap'), {
				center: new google.maps.LatLng(<?php the_sub_field('main_latitude_&_longitude'); ?>),
				zoom: <?php the_sub_field('zoom'); ?>,
				scrollwheel: false,
				mapTypeControl: false,
				disableDefaultUI: true, 
				navigationControl: false,
				zoomControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]
			});

	<?php
	if( get_sub_field('markers') ):
	$i = 1; ?>
	<?php while( has_sub_field('markers') ): ?>				
			var marker<?php echo $i; ?> = new google.maps.Marker({
				icon: '<?php bloginfo('template_url'); ?>/images/marker-oranje.png',
				position: new google.maps.LatLng(<?php the_sub_field('latitude_&_longitude'); ?>),
				map: map
			});
			var info<?php echo $i; ?> = new google.maps.InfoWindow({
			    content: '<h3 style="padding: 10px 10px 0px 10px !important;"><?php the_sub_field('marker_titel'); ?></h3>'
			});
			google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() {
			   	info<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
			});
	<?php 
	$i++;
	endwhile; ?>
	<?php endif; wp_reset_query(); ?>
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
		<div id="googlemapsmap" class="content-100">
			<div id="googlemap" class="content-100"></div>
		</div>
	</section>
	<?php
		elseif( get_row_layout() == 'galerij' ): 
	?>
	<section  id="gallerij" class="content-100 overflow-hidden white center">
	<?php if (is_mobile()) { ?>
		<?php
		if( get_sub_field('afbeeldingen') ): ?>
		<?php while( has_sub_field('afbeeldingen') ): ?>
		<?php 
			$image = get_sub_field('afbeelding');
			if( !empty($image) ): 
			// vars
			$url = $image['url'];
			$title = $image['title'];
			$alt = $image['alt'];
			$caption = $image['caption'];
			// thumbnail
			$size = 'mobiles';
			$thumb = $image['sizes'][ $size ];
			$width = $image['sizes'][ $size . '-width' ];
			$height = $image['sizes'][ $size . '-height' ];
		?>
			<div class="content-25 mobile">
				<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
			</div>						
		<?php endif; ?>
		<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
			<br class="clear" />
	<?php } else { ?>
		<?php
		if( get_sub_field('afbeeldingen') ): ?>
		<?php while( has_sub_field('afbeeldingen') ): ?>
		<?php 
			$image = get_sub_field('afbeelding');
			if( !empty($image) ): 
			// vars
			$url = $image['url'];
			$title = $image['title'];
			$alt = $image['alt'];
			$caption = $image['caption'];
			// thumbnail
			$size = 'thumbnail';
			$thumb = $image['sizes'][ $size ];
			$width = $image['sizes'][ $size . '-width' ];
			$height = $image['sizes'][ $size . '-height' ];
		?>
			<div class="content-25" >
				<a href="<?php echo $url; ?>" class="colorbox-link-1 cboxElement">
					<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
				</a>
			</div>
			<?php endif; ?>
		<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
	<?php } ?>
	</section>
	<?php
	        endif;
	    endwhile;
	else :
	    // no layouts found
	endif;
	?>
	<section id="share" class="content-100 center lightgrey">
		<div class="container">
			<h2>Deel deze pagina</h2>
			<div class="social-media">
			<div style="display: none"><?php $pagina = the_ID(); $naam = the_title($pagina); $link = the_permalink($pagina); ?></div>
			<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
			    ADDTOANY_SHARE_SAVE_KIT( array( 'linkname' => $naam, 'linkurl' => $link ) );
			} ?>
			</div>
		</div>
	</section>
	<?php
	if(get_field('auteur') == "Noreen") { ?>
	<section id="hello" class="content-100 black">
		<?php
		$default_image_id = get_field('noreen', 'options');
		$default_image_size = 'full';
		$default_image_array = wp_get_attachment_image_src($default_image_id, $default_image_size);
		$default_image_url = $default_image_array[0];
		?>
		<div id="hello-image" class="content-50" style="background-image: url('<?php echo $default_image_url; ?>');">
		</div>
		<div id="hello-text" class="content-50">
			<header class="entry-title">
				<h4>Over de auteur</h4>
				<h2>Noreen Dillen-van der Meijden</h2>
			</header>
			<div class="entry-content">
				<p>Ik ben geboren in 1981 en wist al vroeg dat reizen mijn passie is. Ik heb daarom ook de hogeschool voor toerisme afgerond. Daarnaast houd ik ervan om te fotograferen en samen met het reizen is dit een mooie combinatie!</p>
				<p>Ook al duurt een reis altijd maar kort, de herinnering houd je de rest van je leven!</p>
			</div>
		</div>
	</section>
	<?php } elseif(get_field('auteur') == "Danny") { ?>
	<section id="hello" class="content-100 black">
		<?php
		$default_image_id = get_field('danny', 'options');
		$default_image_size = 'full';
		$default_image_array = wp_get_attachment_image_src($default_image_id, $default_image_size);
		$default_image_url = $default_image_array[0];
		?>
		<div id="hello-image" class="content-50" style="background-image: url('<?php echo $default_image_url; ?>');">
		</div>
		<div id="hello-text" class="content-50">
			<header class="entry-title">
				<h4>Over de auteur</h4>
				<h2>Danny van der Meijden</h2>
			</header>
			<div class="entry-content">
				<p>Ik ben een webdesigner/webdeveloper/video-editor en één van mijn grootste hobby's is het maken van reizen. Niet alleen geniet ik van al het pracht en praal dat de wereld heeft te bieden, maar tevens ben ik er gek op om video's en veel foto's te maken van datgene wat ik zie.</p>
				<p>Ik reis graag ieder jaar van continent naar continent en wil zoveel mogelijk op eigen houtje ontdekken en zien!</p>
			</div>
		</div>
	</section>
	<?php } elseif(get_field('auteur') == "Lianne") { ?>
	<section id="hello" class="content-100 black">
		<?php
		$default_image_id = get_field('lianne', 'options');
		$default_image_size = 'full';
		$default_image_array = wp_get_attachment_image_src($default_image_id, $default_image_size);
		$default_image_url = $default_image_array[0];
		?>
		<div id="hello-image" class="content-50" style="background-image: url('<?php echo $default_image_url; ?>');">
		</div>
		<div id="hello-text" class="content-50">
			<header class="entry-title">
				<h4>Over de auteur</h4>
				<h2>Lianne</h2>
			</header>
			<div class="entry-content">
				<p>Met mijn ouders reisde ik elk jaar af naar het prachtige Frankrijk. Pas toen ik Danny leerde kennen ben ik de wereld verder gaan verkennen. Ik vind het geweldig om me te verdiepen in oude mythen, sagen, sprookjes over onze bestemmingen en ben daarnaast diegene in onze relatie die graag zo goed mogelijk voorbereid op vakantie gaat.</p>
			</div>
		</div>
	</section>
	<?php } elseif(get_field('auteur') == "Anders") { ?>
	<?php if( get_field('anders_tekst') ): ?>
	<section id="hello" class="content-100 black auteur">
		<?php
		$default_image_id = get_field('anders_afbeelding');
		$default_image_size = 'full';
		$default_image_array = wp_get_attachment_image_src($default_image_id, $default_image_size);
		$default_image_url = $default_image_array[0];
		?>
		<div id="hello-image" class="content-50" style="background-image: url('<?php echo $default_image_url; ?>');">
		</div>
		<div id="hello-text" class="content-50">
			<header class="entry-title">
				<h4>Over de auteur</h4>
			</header>
			<div class="entry-content">
				<?php the_field('anders_tekst'); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<?php } ?>
	<section id="comments" class="content-100 white center">
		<div class="container">
			<div class="intro content-100">
				<header class="entry-title">
					<h4>We zijn benieuwd naar jouw mening</h4>
					<h2>Reacties</h2>
				</header>
			</div>
			<?php
			if (comments_open()) {
				echo '<div class="comments-link">';
				comments_template('', true);
				echo '</div>';
			} // End if comments_open()
			?>
		</div>
	</section>
	</article>
	<section id="blog" class="content-100 white">
		<div class="container">
			<div class="intro content-100 center">
				<header class="entry-title">
					<h4>Nog meer reisverhalen</h4>
					<h2>Meer blog berichten</h2>
				</header>
			</div>
			<div id="blog-articles" class="content-100">
			<?php
			global $post;
			$currentID = get_the_ID();
			$args = array( 'category' => 1, 'numberposts' => 3, 'exclude' => $currentID);
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) :	setup_postdata($post); ?>
				<div class="blog-article content-33">
					<article>
						<div class="entry-image">
							<a href="<?php the_permalink(); ?>" target="_top" title="<?php the_title(); ?>">
							<?php
							if ( has_post_thumbnail() ) { ?>
								<?php the_post_thumbnail( 'blog' ); ?>
							<?php }
							else {
								echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default-image.jpg" alt="<?php the_title(); ?>" />';
							}
							?>
							</a>
						</div>
						<header class="entry-title">
							<h4><?php the_field('type_content'); ?></h4>
							<a href="<?php the_permalink(); ?>" target="_top" title="<?php the_title(); ?>">
								<h3><?php the_title(); ?></h3>
							</a>
						</header>
						<div class="entry-meta">
							<?php echo app_posted_on(); ?>
						</div>
						<div class="entry-content">
							<p><?php echo get_the_popular_excerpt(); ?></p>
						</div>
					</article>
				</div>
			<?php endforeach; wp_reset_query(); ?>
			</div>
			<div id="blog-articles-more" class="content-100 center">
				<a href="<?php echo home_url( '/' ); ?>blog" target="_top" title="Meer blogberichten"><i class="fa fa-bars"></i> Meer blogberichten</a>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>