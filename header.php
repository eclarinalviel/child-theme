<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Wordpress Customized Theme </title>
        <?php wp_head(); ?>
    </head>

    <?php 
    
    if( is_front_page() || is_home() ):
        $mytheme_classes = array( 'mytheme-class', 'my-class' );
    else:
        $mytheme_classes = array( 'no-mytheme-class' );
    endif;
    
    ?>
<body <?php body_class( $mytheme_classes ); ?>>
     <!-- NAVIGATION -->
    <?php if ( has_nav_menu( 'primary' ) ) { ?>
        <nav class="nav-container" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'nav navbar-nav navbar-right'
                            )
                        );
                    ?>
                </div>
            </div>
        </nav>
    <?php }else{ ?>
        <nav class="nav-container" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </div>
                
            </div>
        </nav>

    <?php } ?>
    <!-- END OF NAVIGATION -->
    
    <!-- CAROUSEL -->
            <div id="mytheme-carousel" class="carousel slide" data-ride="carousel">
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
              
            <?php 
            if( has_category() ){
                $categories = get_categories();
                // var_dump($categories);
                $count = 0;
                $bullets = '';
                foreach($categories as $category):
                    
                    $args = array( 
                        'type' => 'post',
                        'posts_per_page' => 1,
                        'category__in' => $category->term_id,
                        'category__not_in' => array(1),
                    );
                    
                    $lastBlog = new WP_Query( $args ); 
                    
                    if( $lastBlog->have_posts() ):
                        
                        while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>
                            
                            <div class="item <?php if($count == 0): echo 'active'; endif; ?>">
                              <?php the_post_thumbnail('full'); ?>
                              <div class="carousel-caption">
                                  <?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
    
                                  <small><?php the_category(' '); ?></small>
                              </div>
                            </div>
                            
                            <?php $bullets .= '<li data-target="#mytheme-carousel" data-slide-to="'.$count.'" class="'; ?>
                            <?php if($count == 0): $bullets .='active'; endif; ?>
                            
                            <?php  $bullets .= '"></li>'; ?>
                        
                        <?php endwhile;
                        
                    endif;
                    
                    wp_reset_postdata();
                
                $count++;
                endforeach;

            }
            ?>  
            <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php echo $bullets; ?>
              </ol>
          </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#mytheme-carousel" role="button" data-slide="prev">
            <!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#mytheme-carousel" role="button" data-slide="next">
            <!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
            <span class="sr-only">Next</span>
          </a>
        </div>

    <!-- END OF CAROUSEL -->