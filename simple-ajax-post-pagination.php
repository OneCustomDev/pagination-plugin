<?php
$property_per_page = 6;
$paged = get_query_var('paged') ?? get_query_var('page') ?? 1;

$args = array(
  'post_type'        	=> 'projects',
  'posts_per_page'  	=> $property_per_page ? (int)$property_per_page : 6,
  'paged' 		=> $paged,
);
// the query
$property_query = new WP_Query( $args );
if ( $property_query->have_posts() ) : ?>

<div class="properties-wrapper">
  <div class="row">
    <!-- the loop -->
    <?php while ( $property_query->have_posts() ) : $property_query->the_post(); ?>
      <h2><?php the_title(); ?></h2>
    <?php endwhile; ?>
    <!-- end of the loop -->
  </div>


  <?php
  //call function after loop
  ic_custom_posts_pagination($the_query=NULL, $paged=1);
  ?>

  <!-- pagination here -->
  <div class="row">
    <div class="col-md-12">
      <?php ic_custom_posts_pagination($property_query, $paged); ?>
    </div>
  </div>
</div><!-- .properties-wrapper -->

  <?php wp_reset_postdata(); ?>
				
<?php else : ?>
    <p class="text-warning"><?php esc_html_e( 'Sorry, no property matched your criteria.', 'ichelper' ); ?></p>
<?php endif; ?>