<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_set_global' ) ) :

    function supermag_set_global() {
        /*Getting saved values start*/
        $supermag_saved_theme_options = supermag_get_theme_options();
        $GLOBALS['supermag_customizer_all_values'] = $supermag_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'supermag_action_before_head', 'supermag_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_doctype' ) ) :
    function supermag_doctype() {
        ?>
        <!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'supermag_action_before_head', 'supermag_doctype', 10 );

/**
 * Code inside head tags but before wp_head function
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_before_wp_head' ) ) :

    function supermag_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="<?php echo esc_url('http://gmpg.org/xfn/11')?>">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'supermag_action_before_wp_head', 'supermag_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_body_class' ) ) :

    function supermag_body_class( $supermagbody_classes ) {
        global $supermag_customizer_all_values;
        if ( $supermag_customizer_all_values['supermag-default-layout'] == 'boxed') {
            $supermagbody_classes[] = 'boxed-layout';
        }
        if ( $supermag_customizer_all_values['supermag-blog-archive-image-layout'] == 'large-image') {
            $supermagbody_classes[] = 'blog-large-image';
        }
        elseif ( $supermag_customizer_all_values['supermag-blog-archive-image-layout'] == 'alternate-image') {
            $supermagbody_classes[] = 'blog-alternate-image';
        }
        elseif ( $supermag_customizer_all_values['supermag-blog-archive-image-layout'] == 'no-image') {
            $supermagbody_classes[] = 'blog-no-image';
        }
        $supermagbody_classes[] = supermag_sidebar_selection();
        if( 1 == $supermag_customizer_all_values['supermag-enable-sticky-sidebar'] ){
            $supermagbody_classes[] = 'at-sticky-sidebar';
        }
        return $supermagbody_classes;

    }
endif;
add_action( 'body_class', 'supermag_body_class', 10, 1);

/**
 * Intro Loader
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_intro_loader' ) ) :

    function supermag_intro_loader() {
        global $supermag_customizer_all_values;
        $supermag_enable_intro_loader = $supermag_customizer_all_values['supermag-enable-intro-loader'];
        if( 1 != $supermag_enable_intro_loader ){
            return;
        }
        $supermag_intro_image =  $supermag_customizer_all_values['supermag-intro-image'];
        $supermag_intro_bg_image = $supermag_customizer_all_values['supermag-intro-bg-color'];
        ?>
        <div id="supermag-intro-loader" style="background: <?php echo esc_url( $supermag_intro_bg_image ); ?>">
            <div id="supermag-mask" class="loader-outer">
                <?php
                if( !empty( $supermag_intro_image ) ){
                    echo "<img src='".esc_url( $supermag_intro_image )."'>";
                }
                else{
                    echo "<div class='at-loader'></div>";
                }
                ?>
            </div>
        </div>
    <?php
}
endif;
add_action( 'supermag_action_before', 'supermag_intro_loader', 10 );

/**
 * Page start
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_page_start' ) ) :

    function supermag_page_start() {
        ?>
        <div id="page" class="hfeed site">
<?php
    }
endif;
add_action( 'supermag_action_before', 'supermag_page_start', 15 );

/**
 * Skip to content
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_skip_to_content' ) ) :

    function supermag_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content" title="link"><?php esc_html_e( 'Skip to content', 'supermag' ); ?></a>
    <?php
    }
endif;
add_action( 'supermag_action_before_header', 'supermag_skip_to_content', 10 );

/**
 * Main header
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_header' ) ) :

    function supermag_header() {
        global $supermag_customizer_all_values;
        ?>
        <header id="masthead" class="site-header">
            <div class="top-header-section clearfix">
                <div class="wrapper">
                    <?php
                    if ( 1 == $supermag_customizer_all_values['supermag-show-date'] || 1 == $supermag_customizer_all_values['supermag-show-time']){
                        echo ' <div class="header-latest-posts float-left bn-title">';
                        if( 1 == $supermag_customizer_all_values['supermag-show-date'] ){
                            supermag_date_display();
                        }
                        if( 1 == $supermag_customizer_all_values['supermag-show-time'] ){
                            echo "<div class='supermag-clock'></div>";
                        }
                        echo "</div>";
                    }
                    if ( isset($supermag_customizer_all_values['supermag-enable-breaking-news']) && $supermag_customizer_all_values['supermag-enable-breaking-news'] == 1 ) {

                        $supermag_number_bn = $supermag_customizer_all_values['supermag-breaking-news-number'];
                        $supermag_breaking_news_selection_from = $supermag_customizer_all_values['supermag-breaking-news-selection-from'];
                        if( 'from-category' == $supermag_breaking_news_selection_from ){
                            $supermag_breaking_news_category = $supermag_customizer_all_values['supermag-breaking-news-from-category'];
                            if( 0 != $supermag_breaking_news_category ){
                                $supermag_bn_args =    array(
                                    'category' => $supermag_breaking_news_category,
                                    'posts_per_page' => $supermag_number_bn
                                );
                            }
                            else{
                                $supermag_bn_args = array(
                                    'post_status' => 'publish',
                                    'posts_per_page' => $supermag_number_bn
                                );
                            }
                        }
                        else{
                            $supermag_bn_args = array(
                                'post_status' => 'publish',
                                'posts_per_page' => $supermag_number_bn
                            );
                        }

                        $recent_posts = wp_get_recent_posts($supermag_bn_args);
                        if ( !empty( $recent_posts ) ):
                            if ( !empty( $supermag_customizer_all_values['supermag-breaking-news-title'] ) ){
                                $bn_title = $supermag_customizer_all_values['supermag-breaking-news-title'];
                            }
                            else{
                                $bn_title = __( 'Recent posts', 'supermag' );
                            }
                            $supermag_breaking_news_speed = $supermag_customizer_all_values['supermag-breaking-news-speed'];
                            $supermag_breaking_news_per_slide = $supermag_customizer_all_values['supermag-breaking-news-per-slide'];
                            ?>
                            <div class="header-latest-posts bn-wrapper float-left">
                                <div class="bn-title">
                                    <?php echo esc_html( $bn_title ); ?>
                                </div>
                                <ul class="bn" data-speed="<?php echo absint( $supermag_breaking_news_speed ); ?>" data-mode="horizontal" data-column="<?php echo absint( $supermag_breaking_news_per_slide );?>">
                                    <?php foreach ($recent_posts as $recent): ?>
                                        <li class="bn-content">
                                            <a href="<?php echo esc_url( get_permalink($recent["ID"]) ); ?>" title="<?php echo esc_attr( $recent['post_title'] ); ?>">
                                                <?php echo esc_html( $recent['post_title'] ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div> <!-- .header-latest-posts -->
                            <?php
                        endif;
                    }
                    ?>
                    <div class="right-header float-right">
                        <?php
                        if ( isset($supermag_customizer_all_values['supermag-enable-social'] ) && $supermag_customizer_all_values['supermag-enable-social'] == 1 ) {
                            /* Social Links*/
                            ?>
                            <div class="socials">
                                <?php
                                if ( !empty( $supermag_customizer_all_values['supermag-facebook-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-facebook-url'] ); ?>" class="facebook" data-title="Facebook" target="_blank">
                                        <span class="font-icon-social-facebook"><i class="fa fa-facebook"></i></span>
                                    </a>
                                <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-twitter-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-twitter-url'] ); ?>" class="twitter" data-title="Twitter" target="_blank">
                                        <span class="font-icon-social-twitter"><i class="fa fa-twitter"></i></span>
                                    </a>
                                    <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-linkedin-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-linkedin-url'] ); ?>" class="linkedin" data-title="Linkedin" target="_blank">
                                        <span class="font-icon-social-linkedin"><i class="fa fa-linkedin"></i></span>
                                    </a>
                                <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-instagram-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-instagram-url'] ); ?>" class="instagram" data-title="Instagram" target="_blank">
                                        <span class="font-icon-social-instagram"><i class="fa fa-instagram"></i></span>
                                    </a>
                                    <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-youtube-url'] ) ) { ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-youtube-url'] ); ?>" class="youtube" data-title="Youtube" target="_blank">
                                        <span class="font-icon-social-youtube"><i class="fa fa-youtube"></i></span>
                                    </a>
                                    <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-google-plus-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-google-plus-url'] ); ?>" class="google-plus" data-title="Google Plus" target="_blank">
                                        <span class="font-icon-social-google-plus"><i class="fa fa-google-plus"></i></span>
                                    </a>
                                    <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-pinterest-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-pinterest-url'] ); ?>" class="pinterest" data-title="Pinterest" target="_blank">
                                        <span class="font-icon-social-pinterest"><i class="fa fa-pinterest"></i></span>
                                    </a>
                                    <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-flickr-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-flickr-url'] ); ?>" class="flickr" data-title="Flickr" target="_blank">
                                        <span class="font-icon-social-flickr"><i class="fa fa-flickr"></i></span>
                                    </a>
                                    <?php
                                }
                                if ( !empty( $supermag_customizer_all_values['supermag-tumblr-url'] ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-tumblr-url'] ); ?>" class="tumblr" data-title="Tumblr" target="_blank">
                                        <span class="font-icon-social-tumblr"><i class="fa fa-tumblr"></i></span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- .top-header-section -->
            <div class="wrapper header-wrapper clearfix">
                <div class="header-container">
                    <div class="site-branding clearfix">
                        <?php if ( 'disable' != $supermag_customizer_all_values['supermag-header-id-display-opt'] ):?>
                        <div class="site-logo float-left">
                            <?php
                            if ( 'logo-only' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-title' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                            ):
                                if ( function_exists( 'the_custom_logo' ) ) :
                                    the_custom_logo();
                                else :
                                    if( !empty( $supermag_customizer_all_values['supermag-header-logo'] ) ):
                                        $supermag_header_alt = get_bloginfo('name');
                                        ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                            <img src="<?php echo esc_url( $supermag_customizer_all_values['supermag-header-logo'] ); ?>" alt="<?php echo esc_attr( $supermag_header_alt ); ?>">
                                        </a>
                                        <?php
                                    endif;/*supermag-header-logo*/
                                endif;
                            endif;
                            if( 'title-only' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-title' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                            ):/*else is title-only or title-and-tagline*/
                                if ( is_front_page() && is_home() ) : ?>
                                    <h1 class="site-title">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                    </h1>
                                <?php else : ?>
                                    <p class="site-title">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                    </p>
                                <?php
                                endif;
                            endif;
                            if ( 'title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                                || 'logo-and-title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']
                            ):
                                    $description = get_bloginfo( 'description', 'display' );
                                    if ( $description || is_customize_preview() ) : ?>
                                        <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                    <?php endif;
                                endif;
                            ?>
                        </div><!--site-logo-->
                        <?php endif;?><!--supermag-header-id-display-opt-->
                        <?php
                        if (  'hide' != $supermag_customizer_all_values['supermag-header-main-show-banner-ads'] ):
                            if( 'image' == $supermag_customizer_all_values['supermag-header-main-show-banner-ads']
                            || 1 == $supermag_customizer_all_values['supermag-header-main-show-banner-ads'] ){
                                $supermag_header_main_banner_ads_link = $supermag_customizer_all_values['supermag-header-main-banner-ads-link'];
                                $supermag_header_main_banner_new_tab = $supermag_customizer_all_values['supermag-header-main-banner-new-tab'];
                                $blank = '';
                                if( 1 == $supermag_header_main_banner_new_tab ){
                                    $blank = "target='_blank'";
                                }
                                ?>
                                <div class="header-ads float-right">
                                    <a href="<?php echo esc_url( $supermag_header_main_banner_ads_link ); ?>" <?php echo $blank;?>>
                                        <img src="<?php echo esc_url( $supermag_customizer_all_values['supermag-header-main-banner-ads'] )?>" alt="<?php _e('Banner Ads','supermagpro')?>">
                                    </a>
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <div class="header-ads float-right">
                                    <?php
                                    $supermag_header_main_google_ads = $supermag_customizer_all_values['supermag-header-main-google-ads'];
                                    echo $supermag_header_main_google_ads;
                                    ?>
                                </div>
                                <?php
                            }
                        endif; ?>
                              <div class="header-ads float-right">
                                <?php dynamic_sidebar( 'AGT : Top banner' ); ?>
                              </div>
                        <div class="clearfix"></div>
                        <?php
                        if ( is_active_sidebar( 'supermag-menu-before' ) ) {
                            dynamic_sidebar( 'supermag-menu-before' );
                        }
                        ?>
                    </div>
                    <?php
                    $supermag_enable_sticky_menu = '';
                    if ( 1 == $supermag_customizer_all_values['supermag-enable-sticky-menu'] ){
                        $supermag_enable_sticky_menu = 'supermag-enable-sticky-menu';
                    }
                    ?>
                    <nav id="site-navigation" class="main-navigation <?php echo esc_attr( $supermag_enable_sticky_menu );?> clearfix">
                        <div class="header-main-menu clearfix">
                            <?php
                            if (isset( $supermag_customizer_all_values['supermag-menu-show-home-icon']) && $supermag_customizer_all_values['supermag-menu-show-home-icon'] == 1 ) {
                                if ( is_front_page() ) {
                                    $home_icon_class = 'home-icon front_page_on';
                                } else {
                                    $home_icon_class = 'home-icon';
                                }
                                ?>
                                <div class="<?php echo esc_attr( $home_icon_class ); ?>">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><i class="fa fa-home"></i></a>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if( has_nav_menu( 'primary' ) ){
                                wp_nav_menu(array('theme_location' => 'primary','container' => 'div', 'container_class' => 'acmethemes-nav'));
                            }
                            ?>
                            <?php
                            if ( 1 == $supermag_customizer_all_values['supermag-enable-random-post'] ){
                                $supermag_random_post_query = new WP_Query(
                                    array (
                                        'orderby' => 'rand',
                                        'posts_per_page' => 1,
                                        'ignore_sticky_posts' => true
                                    )
                                );
                                if ( $supermag_random_post_query->have_posts() ) {
                                    echo '<div class="random-post">';
                                    while ( $supermag_random_post_query->have_posts() ) {
                                        $supermag_random_post_query->the_post();
                                        ?>
                                        <a title="<?php echo esc_attr(get_the_title())?>" href="<?php the_permalink()?>">
                                            <i class="fa fa-random icon-menu"></i>
                                        </a>
                                        <?php
                                    }
                                    echo '</div>';/*random-post*/
                                }
                                wp_reset_query();
                            }
                            if ( 1 == $supermag_customizer_all_values['supermag-menu-show-search'] ):
                                if ( 1 == $supermag_customizer_all_values['supermag-another-search-type'] ){
                                    echo '<i class="fa fa-search icon-menu search-icon-menu"></i>';
                                    echo "<div class='menu-search-toggle'>";
                                    echo "<div class='menu-search-inner'>";
                                }
                                get_search_form();
                                if ( 1 == $supermag_customizer_all_values['supermag-another-search-type'] ){
                                    echo '</div>';/*menu-search-inner*/
                                    echo '</div>';/*menu-search-toggle*/
                                }
                            endif; ?>
                        </div>
                        <div class="responsive-slick-menu clearfix"></div>
                    </nav>
                    <!-- #site-navigation -->
                </div>
                <!-- .header-container -->
            </div>
            <!-- header-wrapper-->

        </header>

        <!-- #masthead -->
        <?php
    }
endif;
add_action( 'supermag_action_header', 'supermag_header', 10 );

/**
 * Before main content
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_before_content' ) ) :

    function supermag_before_content() {
        global $supermag_customizer_all_values;
        ?>
        <div class="wrapper content-wrapper clearfix">
        <?php
        if ( is_front_page() && 1 == $supermag_customizer_all_values['supermag-enable-feature']) {
            echo '<div class="slider-feature-wrap clearfix">';
            /*Slide*/
            /**
             * supermag_action_feature_slider
             * @since supermag 1.0.0
             *
             * @hooked supermag_feature_slider -  0
             */
            do_action('supermag_action_feature_slider');
            /*Featured Post Beside Slider*/
            /**
             * supermag_action_feature_side
             * @since supermag 1.0.0
             *
             * @hooked supermag_feature_side-  0
             */
            do_action('supermag_action_feature_side');
            echo "</div>";
            $supermag_content_id = "home-content";
        } else {
            $supermag_content_id = "content";
        }
        ?>
    <div id="<?php echo esc_attr( $supermag_content_id ); ?>" class="site-content">
        <?php
        $sidebar_layout = supermag_sidebar_selection(get_the_ID());
        if( 'both-sidebar' == $sidebar_layout ) {
            echo '<div id="primary-wrap" class="clearfix">';
        }
        if( 'disable' != $supermag_customizer_all_values['supermag-breadcrumb-options'] ){
            if( 'advanced' == $supermag_customizer_all_values['supermag-breadcrumb-options'] ){
                if( function_exists('bcn_display')){
                    echo '<div id="supermag-breadcrumbs"><span class="breadcrumb">Vous &ecirc;tes</span><div class="breadcrumb-container">';
                    bcn_display();
                    echo "</div></div>";
                }
                else{
                    supermag_breadcrumbs();
                }
            }
            else{
                supermag_breadcrumbs();
            }
        }
    }
endif;
add_action( 'supermag_action_after_header', 'supermag_before_content', 10 );
