/**
 * Template Name: アイデアブック-英
 */


<?php switchLanguage();get_header(); ?>
<div class="page-header" style="background-image: url(/images/gallery/header.jpg)">
  <h1><i>Ideabook</i></h1>
</div><!-- .page-header -->
<div id="idea1">
 <!--  <section id="idea11">
     <div id="idea111" class="imgswap"><img src="/images/arc_idea21.svg" width="812" height="30" alt="ここにコピーが入ります。" /><img src="/images/sp_arc_idea21.svg" width="499" height="175" alt="ここにコピーが入ります。" /></div> 
    <p id="idea112">Here is the description of the idea plan. Here is the description of the idea plan. Here is the description of the idea plan. Here is the description of the idea plan. Here is the description of the idea plan. Here is the description of the idea plan. Here is the description of the idea plan. Here is the description of the idea plan. 
    </p>
  </section> -->
  <section id="idea12">
    <a id="list" name="list" class="innertarget"></a>
    <h3 id="idea121">
      <div id="idea1211">IDEA LIST</div>
      <!-- <div id="idea1212">コーディネートアイデア一覧</div> -->
    </h3>
    <div id="idea122">
      <div class="idea122_list tiles">
        <?php 
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
            'post_type' => 'ideabook',
            'tax_query' => array(
                array(
                    'taxonomy' => 'language_choice',
                    'field'    => 'slug',
                    'terms'    => array( 'English' ),
                )
              ),
              'posts_per_page' => 9,
              'paged' => $paged,
            );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); $loopcounter++; 
        ?>
        <a href="<?php the_permalink(); ?>" class="idea122_card tile">
          <div class="idea122_card_img">
            <?php
            $arr = post_custom('ListImage');
            foreach ((array)$arr as $img) {
              $imgs = wp_get_attachment_image_src($img,'full');
              break;
            }
            ?>
            <div class="idea122_card_img_photo" style="background-image:url(<?php echo $imgs[0]; ?>);"></div>
          </div>
          <div class="details">
            <span class="title">【<?php the_title(); ?>】</span>
            <span class="info">
              <?php
                // $taxonomy_names = get_post_taxonomies();
                // print_r( $taxonomy_names );
                $terms = wp_get_post_terms( get_the_ID(), 'idea_img' );
                foreach( $terms as $term )
                  echo '#' .$term->name . '　　' .'<br/>';
              ?>
            </span>
          </div>
        </a>
        <?php 
          endwhile; 
        ?>
      </div>
    </div>
    <?php 
      $total_pages = $loop->max_num_pages;
      if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
    ?>
    <div id="idea123">
      <?php 
        echo paginate_links(array(
          'base' => get_pagenum_link(1) . '%_%',
          'format' => '/page/%#%',
          'current' => $current_page,
          'prev_text'    => __('&lt;'),
          'next_text'    => __('&gt;'),
        ));
      ?>
    </div>
    <?php } 
    wp_reset_postdata();
    ?> 
  </section>
</div>
<?php get_footer(); ?>