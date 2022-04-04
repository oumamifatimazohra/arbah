<div id="header-slider" class="arbah-slider">

		<?php 
		$posts_tag = get_theme_mod('arbah_slider_post_tag', '');
		$posts_numb = get_theme_mod('arbah_home_post_numb', '6');
		$size = 'feat-thumb';
    wp_reset_query();
    $args = array( 'tag' => $posts_tag, 'posts_per_page' => $posts_numb  );
    $latest =  get_posts($args); 
    foreach($latest  as $post) : setup_postdata($post); $do_not_duplicate[] = $post->ID; 
    if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>

    		<div class="slick-slide" style="background-image:url(<?php echo arbah_thumb_src( $size ); ?>);">
    			<a href="<?php the_permalink(); ?>" rel="bookmark">

    				<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-play"></i></span>'; ?>
    				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-volume-up"></i></span>'; ?>
    				<?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i></span>'; ?>

    				<div class="text-box">

    					<h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>

    					<h2><?php the_title(); ?></h2>

    					<div class="featured-excerpt">

    						<p><?php echo arbah_excerpt(22); ?></p>

    					</div><!--featured-excerpt-->

    				</div><!--featured-text-->

    			</a>
    				
    		</div>

    		
    		<?php endif; endforeach; ?>

</div><!--#header-slider-->

<?php if ( is_rtl() ) : ?>
  <script>
  jQuery(document).ready(function() {
  	
    jQuery('#header-slider').slick({
    rtl: true,
    dots: false,
    infinite: true,
    speed: 2000,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow : '<span type="button" class="slick-prev fa fa-angle-left"></span>',
    nextArrow : '<span type="button" class="slick-next fa fa-angle-right"></span>',
    responsive: [
        {
            breakpoint: 1239,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                autoplay: true,
                dots: false,
                autoplaySpeed: 2000,
            }
        },
        {
            breakpoint: 991,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                autoplay: true,
                dots: false,
                autoplaySpeed: 2000,
            }
        },
      {
          breakpoint: 568,
          settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              autoplay: true,
          autoplaySpeed: 2000,
        }
      }
    ]
    });

  });
  </script>
<?php else : ?>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#header-slider').slick({
    dots: false,
    infinite: true,
    speed: 2000,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow : '<span type="button" class="slick-prev fa fa-angle-left"></span>',
    nextArrow : '<span type="button" class="slick-next fa fa-angle-right"></span>',
     
    responsive: [
        {
            breakpoint: 1239,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                autoplay: true,
                dots: false,
                autoplaySpeed: 2000,
            }
        },
        {
            breakpoint: 991,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                autoplay: true,
                dots: false,
                autoplaySpeed: 2000,
            }
        },
      {
          breakpoint: 568,
          settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              autoplay: true,
          autoplaySpeed: 2000,
        }
      }
    ]
    });

  });

  </script>
<?php endif; ?>
