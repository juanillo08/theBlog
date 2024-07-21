<?php get_header()?>
    <?php while(have_posts()) : the_post() ?>
    <section class="single__banner bg--dark clr--light py--10">
      <div class="container">
          <div class="single__banner__header flex justify--between align--end">
              <h1><?php the_title()?></h1>
              <ul>
                  <li>Date: <?php the_date()?></li>
                  <li>By: <?php echo get_the_author_meta('first_name')?> <?php echo get_the_author_meta('last_name')?></li>
              </ul>
          </div>
          <div class="single__banner__body">
              <p><?php echo get_the_excerpt()?></p>
               <?php if(has_post_thumbnail()){
                the_post_thumbnail();
               }?>
          </div>
      </div>
    </section>

    <main class="single__article py--10">
        <div class="container">
            <div class="single__article__wrapper">
                <div class="single__article__info  bg--dark clr--light">
                    <div class="single__article__meta">
                        <h4>Category</h4>
                        <p><?php echo get_the_category()[0]->name ?></p>
                    </div>

                    <div class="single__article__meta">
                        <h4>Tags</h4>
                        <p><?php 
                            $post_tags = get_the_tags();
                           
                            if( $post_tags ) {
                                foreach($post_tags as $tag ){
                                    echo $tag->name . ', ';
                                }
                            }
                        ?>
                        </p>
                            
                      
                    </div>

                    <div class="single__article__meta">
                        <h4>Author</h4>
                        <p>by: <span><?php echo get_the_author_meta('first_name')?> <?php echo get_the_author_meta('last_name')?></span></p>
                    </div>

                    <div class="single__article__meta">
                        <h4>Reading</h4>
                        <p><?php echo get_post_meta( get_the_ID() ,'reading', true)?></p>
                    </div>
                </div>

                <div class="single__article__body">
                    <div class="wrapper">
                        <?php the_content()?>
                    </div>
                    
                    <div class="single__navigation mt--10">
                        <ul class="flex justify--between ">
                            <li><?php previous_post_link('%link', '<i class="fas fa-angle-left"></i>Prev')?></li>
                            <li><?php next_post_link('%link', 'Next<i class="fas fa-angle-right"></i>')?></li>
                        </ul>
                    </div>
                </div>

              
            </div>

            
        </div>
    </main>
        <?php endwhile?>

    <div class="single__other">
        <div class="container">
            <div class="single__other__wrapper">
                <div class="single__other__sidebar">
                    <?php $otherside = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'orderby' => 'rand',
                        'post__not_in' => array(get_the_ID())
                        ,

                    ))  ?>
                    <?php if($otherside->have_posts()) : while($otherside->have_posts()) : $otherside->the_post() ?>
                    <div class="card__sidebar">
                        <ul class="card__meta flex">
                          <li class="article__date"><?php the_date()?></li>
                        </ul>
                        <h3><?php the_title()?></h3>
                        <a href="<?php the_permalink()?>">Read more</a>
                      </div>

                      <?php endwhile;
                        else: 
                            echo "no more post";
                        endif;
                        wp_reset_postdata();
                      ?>
                </div>

                <div class="single__other__main">
                <?php        
              $singleMain = new WP_Query(array(
              'post_type' => 'post',
               'posts_per_page' => 1,
                'orderby' => 'rand',
                'post__not_in' => array(get_the_ID())
                ,

                    ))?>
       <?php if($singleMain->have_posts()) : while($singleMain->have_posts()) : $singleMain->the_post()?>
                    <div class="card__other">
                    <?php 
                 if(has_post_thumbnail()){
                    the_post_thumbnail('', array(
                    ));
                }
            ?>
                        <div class="overlay"></div>
                        <div class="card__other__body">
                            <h3><?php the_title()?></h3>
                            <p><?php the_content()?></p>
                            <a href="<?php the_permalink()?>">Continue Reading</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile;
                        else: 
                            echo "no more post";
                        endif;
                        wp_reset_postdata();
                      ?>


<?php get_footer()?>