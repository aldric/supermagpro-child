<?php
/**
 * Dynamic css create
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $supermag_customizer_all_values;

/*font family*/
$supermag_google_fonts = supermag_fonts_array();
$supermag_site_title_fm = $supermag_google_fonts[$supermag_customizer_all_values['supermag-site-title-fm']];
$supermag_site_tagline_fm = $supermag_google_fonts[$supermag_customizer_all_values['supermag-site-tagline-fm']];
$supermag_menu_fm = $supermag_google_fonts[$supermag_customizer_all_values['supermag-menu-fm']];
$supermag_heading_fm = $supermag_google_fonts[$supermag_customizer_all_values['supermag-heading-fm']];
$supermag_body_fm = $supermag_google_fonts[$supermag_customizer_all_values['supermag-body-fm']];

/*Color options */
$supermag_site_title_color = $supermag_customizer_all_values['supermag-site-title-color'];
$supermag_site_title_hover_color = $supermag_customizer_all_values['supermag-site-title-hover-color'];
$supermag_site_tagline_color = $supermag_customizer_all_values['supermag-site-tagline-color'];
$supermag_body_text_color = $supermag_customizer_all_values['supermag-body-text-color'];
$supermag_heading_color = $supermag_customizer_all_values['supermag-heading-color'];
$supermag_primary_color = $supermag_customizer_all_values['supermag-primary-color'];
$supermag_primary_hover_color = $supermag_customizer_all_values['supermag-primary-hover-color'];
$supermag_link_color = $supermag_customizer_all_values['supermag-link-color'];
$supermag_link_hover_color = $supermag_customizer_all_values['supermag-link-hover-color'];

/*Advanced Colors*/
$supermag_header_top_bg_color = $supermag_customizer_all_values['supermag-header-top-bg-color'];
$supermag_header_main_bg_color = $supermag_customizer_all_values['supermag-header-main-bg-color'];
$supermag_menu_main_bg_color = $supermag_customizer_all_values['supermag-menu-main-bg-color'];
$supermag_menu_active_bg_color = $supermag_customizer_all_values['supermag-menu-active-bg-color'];
$supermag_menu_hover_bg_color = $supermag_customizer_all_values['supermag-menu-hover-bg-color'];
$supermag_menu_text_color = $supermag_customizer_all_values['supermag-menu-text-color'];
$supermag_menu_border_bottom_color = $supermag_customizer_all_values['supermag-menu-border-bottom-color'];
$supermag_breadcrumb_bg_color = $supermag_customizer_all_values['supermag-breadcrumb-bg-color'];
$supermag_sidebar_bg_color = $supermag_customizer_all_values['supermag-sidebar-bg-color'];
$supermag_footer_bg_color = $supermag_customizer_all_values['supermag-footer-bg-color'];
$supermag_footer_heading_color = $supermag_customizer_all_values['supermag-footer-heading-color'];
$supermag_footer_text_color = $supermag_customizer_all_values['supermag-footer-text-color'];
$supermag_footer_link_color = $supermag_customizer_all_values['supermag-footer-link-color'];
$supermag_footer_link_hover_color = $supermag_customizer_all_values['supermag-footer-link-hover-color'];

/*button design option*/
$supermag_button_design = $supermag_customizer_all_values['supermag-button-design'];

$custom_css = '';

/*font family*/
$custom_css .= "
        .site-title,
        .site-title a{
            font-family: '{$supermag_site_title_fm}';
        }";
$custom_css .= "
        .site-description,
        .site-description a{
            font-family: '{$supermag_site_tagline_fm}';
        }";
$custom_css .= "
        .main-navigation a{
            font-family: '{$supermag_menu_fm}';
        }";
$custom_css .= "
        h1, h1 a,
        h2, h2 a,
        h3, h3 a,
        h4, h4 a,
        h5, h5 a,
        h6, h6 a {
            font-family: '{$supermag_heading_fm}';
        }";
$custom_css .= "
        body, p {
            font-family: '{$supermag_body_fm}';
        }";
/*Colors options*/
$custom_css .= "
        .site-title,
        .site-title a{
            color: {$supermag_site_title_color};
        }";
$custom_css .= "
        .site-title:hover,
        .site-title a:hover{
            color: {$supermag_site_title_hover_color};
        }";
$custom_css .= "
        .site-description,
        .site-description a{
            color: {$supermag_site_tagline_color};
        }";
$custom_css .= "
        h1, h1 a,
        h2, h2 a,
        h3, h3 a,
        h4, h4 a,
        h5, h5 a,
        h6, h6 a {
            color: {$supermag_heading_color};
        }";
$custom_css .= "
         .entry-content p,.details{
            color: {$supermag_body_text_color};
        }";
/*primary colors*/
$custom_css .= "
        .comment-form .form-submit input,
        .read-more,
        .bn-title,
        .home-icon.front_page_on,
        .slider-section .cat-links a,
        .featured-desc .below-entry-meta .cat-links a,
        .gallery-carousel .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
        #calendar_wrap #wp-calendar #today,
        #calendar_wrap #wp-calendar #today a,
        .wpcf7-form input.wpcf7-submit:hover,
        .breadcrumb{
            background: {$supermag_primary_color};
        }";
$custom_css .= "
         .breadcrumb::after {
            border-left: 5px solid {$supermag_primary_color};
        }";
$custom_css .= "
         .header-wrapper #site-navigation{
            border-bottom: 5px solid {$supermag_primary_color};
        }";
$custom_css .= "
        .search-block input#menu-search,
        .widget_search input#s,
        .slicknav_btn.slicknav_open,
        .footer-wrapper .bn-title,
        .gallery-carousel  li:hover img,
        .page-numbers:hover,
        .page-numbers:focus, .page-numbers.current,
        .wpcf7-form input.wpcf7-submit{
            border: 1px solid {$supermag_primary_color};
        }";
$custom_css .= "
         .footer-wrapper .border{
            border-top: 1px solid {$supermag_primary_color};
        }";
$custom_css .= "
        .socials a:hover,
        .search-block #searchsubmit,
        .widget_search #searchsubmit,
        .slider-section .bx-controls-direction a,
        .sm-up:hover,
        .sm-tabs-title .single-tab-title.opened,
        .page-numbers,
        .wpcf7-form input.wpcf7-submit{
            color: {$supermag_primary_color};
        }";
$custom_css .= "
         .sm-tabs-title .single-tab-title.opened::after{
            border-color: {$supermag_primary_color} transparent;
        }";
$custom_css .= "
        .slicknav_btn.slicknav_open:before{
            background: none repeat scroll 0 0 {$supermag_primary_color};
            box-shadow: 0 6px 0 0 {$supermag_primary_color}, 0 12px 0 0 {$supermag_primary_color};
        }";
$custom_css .= "
        .besides-slider .beside-post{
            border-bottom: 3px solid {$supermag_primary_color};
        }";
$custom_css .= "
        .widget-title,
        .footer-wrapper{
            border-bottom: 1px solid {$supermag_primary_color};
        }";
$custom_css .= "
        .widget-title:before,
        .footer-wrapper .bn-title:before{
            border-bottom: 7px solid {$supermag_primary_color};
        }";
$custom_css .= "
        .active img{
            border: 2px solid {$supermag_primary_color};
        }";
/*secondary color*/
$custom_css .= "
        .comment-form .form-submit input:hover,
        .slider-section .cat-links a:hover,
        .featured-desc .below-entry-meta .cat-links a:hover,
        .read-more:hover,
        .slider-section .bx-controls-direction a,
        .sm-up-container,
        .gallery-carousel .mCSB_container{
            background:{$supermag_primary_hover_color};
        }";
$custom_css .= "
        .gallery-carousel  li img {
            border:1px solid {$supermag_primary_hover_color};
        }";
$custom_css .= "
        a,
        .posted-on a,
        .cat-links a,
        .comments-link a,
        .edit-link a,
        .tags-links a,
        .byline,
        .nav-links a,
        .featured-desc .above-entry-meta i{
            color: {$supermag_link_color};
        }";

/*link color*/
$custom_css .= "
        a:hover,
        .posted-on a:hover,
        .cat-links a:hover,
        .comments-link a:hover,
        .edit-link a:hover,
        .tags-links a:hover,
        .byline a:hover,
        .nav-links a:hover,
        #supermag-breadcrumbs a:hover,
        .bn-content a:hover,
        .slider-section .slide-title:hover,
        .feature-side-slider .post-title a:hover,
        .slider-feature-wrap a:hover,
        .feature-side-slider .beside-post:hover .beside-caption a,
        .featured-desc a:hover h4,
        .featured-desc .above-entry-meta span:hover{
            color: {$supermag_link_hover_color};
        }
        .nav-links .nav-previous a:hover, .nav-links .nav-next a:hover{
            border-top: 1px solid {$supermag_link_hover_color};
        }";

/*Advanced Colors */
$custom_css .= "
        .top-header-section,
        .top-header-section .wrapper{
            background: {$supermag_header_top_bg_color};
        }";
$custom_css .= "
        .header-wrapper,
        .no-header-bn {
            background: {$supermag_header_main_bg_color};
        }";

/*menu background color*/
$custom_css .= "
        .header-wrapper #site-navigation,
        .header-wrapper .supermag_mega_menu.menu .mega-sub-menu li.menu-item-inner-mega .supermag-mega-menu-cat-wrap a,
        .header-wrapper .supermag_mega_menu.menu .mega-sub-menu li.menu-item a,
        .mega-sub-menu .supermag-mega-menu-cat-wrap,
        .header-wrapper ul.sub-menu.mega-sub-menu,
        .slicknav_btn,
        .header-wrapper .main-navigation .slicknav_nav ul.sub-menu,
        .header-wrapper .main-navigation ul ul.sub-menu li,
        .header-wrapper .supermag_mega_menu.menu .mega-sub-menu li.menu-item-inner-mega .supermag-mega-menu-cat-wrap a{
            background-color: {$supermag_menu_main_bg_color};
        }";

/*menu active color*/
$custom_css .= "
        .header-wrapper .menu > li.current-menu-item > a,
        .header-wrapper .menu > li.current-menu-parent a,
        .header-wrapper .menu > li.current_page_parent a,
        .header-wrapper .menu > li.current_page_ancestor a,
        .header-wrapper .menu > li.current-menu-item > a:before,
        .header-wrapper .menu > li.current-menu-parent > a:before,
        .header-wrapper .menu > li.current_page_parent > a:before,
        .header-wrapper .menu > li.current_page_ancestor > a:before{
            background: {$supermag_menu_active_bg_color};
        }";
$custom_css .= "
        .slicknav_nav li:hover > a,
        .slicknav_nav li.current-menu-ancestor  a,
        .slicknav_nav li.current-menu-item  > a,
        .slicknav_nav li.current_page_item a,
        .slicknav_nav li.current_page_item .slicknav_item span,
        .mega-sub-menu .mega-active-cat{
            color: {$supermag_menu_active_bg_color};
        }";

/* menu hover color*/
$custom_css .= "
        .supermag-mega-menu-con-wrap,
        .header-wrapper .menu li:hover,
        .header-wrapper .menu li:hover > a,
        .header-wrapper .supermag_mega_menu.menu .mega-sub-menu li.menu-item-inner-mega .supermag-mega-menu-cat-wrap a.mega-active-cat{
            background-color: {$supermag_menu_hover_bg_color};
        }";

$custom_css .= "
        .supermag_mega_menu .header-wrapper .main-navigation ul ul.sub-menu li:hover > a,
        .icon-menu:hover,
        .header-wrapper .supermag_mega_menu.menu .mega-sub-menu li.menu-item a:hover,
        .slicknav_nav li .slicknav_item:hover a{
            color:{$supermag_menu_hover_bg_color};
        }";
$custom_css .= "
        @media screen and (max-width:992px){
            .supermag-mega-menu-con-wrap,
            .header-wrapper .supermag_mega_menu.menu .mega-sub-menu li.menu-item-inner-mega .supermag-mega-menu-cat-wrap a.mega-active-cat{
                background:{$supermag_menu_main_bg_color};
            }
        }";
$custom_css .= "
        @media screen and (max-width:639px){
            .mega-sub-menu .menu-post-block h2 a:hover {
                color: {$supermag_menu_hover_bg_color};
            }
        }";

/*Menu text color*/
$custom_css .= "
       .header-wrapper .menu li a{
            color: {$supermag_menu_text_color};
        }";
/*Menu borer bottom color*/
$custom_css .= "
       .header-wrapper #site-navigation{
            box-shadow: -1px -5px 0 -1px {$supermag_menu_border_bottom_color} inset;
        }";

/*breadcrumbs bg color*/
$custom_css .= "
       #supermag-breadcrumbs{
            background: {$supermag_breadcrumb_bg_color};
        }";

/*sidebar color*/
$custom_css .= "
       .secondary-sidebar .widget-area.sidebar{
            background: {$supermag_sidebar_bg_color};
        }";
/*footer bg color*/
$custom_css .= "
       .footer-wrapper,
       .wrapper.footer-wrapper{
            background: {$supermag_footer_bg_color};
        }";

/*footer heading color*/
$custom_css .= "
       .footer-wrapper .widget-title,
        .footer-wrapper h1, .footer-wrapper h1 a,
        .footer-wrapper h2, .footer-wrapper h2 a,
        .footer-wrapper h3, .footer-wrapper h3 a,
        .footer-wrapper h4, .footer-wrapper h4 a,
        .footer-wrapper h5, .footer-wrapper h5 a,
        .footer-wrapper h6, .footer-wrapper h6 a{
            color: {$supermag_footer_heading_color};
        }";

/*footer text color*/
$custom_css .= "
       .footer-wrapper,
        .footer-wrapper .featured-desc .above-entry-meta,
        .footer-wrapper .entry-content p,.footer-wrapper .details{
            color: {$supermag_footer_text_color};
        }";

/*footer link color*/
$custom_css .= "
       .footer-wrapper a,
         .footer-wrapper .featured-desc .above-entry-meta i{
             color: {$supermag_footer_link_color};
         }";

/*footer link hover color*/
$custom_css .= "
       .footer-wrapper a:hover,
        .footer-sidebar .featured-desc .above-entry-meta a:hover {
            color: {$supermag_footer_link_hover_color};
        }";

if ('rounded-rectangle' == $supermag_button_design) {
    $custom_css .= "
            .featured-desc .above-entry-meta,
            .featured-desc .below-entry-meta .cat-links a,
            .entry-footer .cat-links a,
            article.post .read-more,
            article.page .read-more,
            .slider-section .cat-links a{
            border-radius: 4px;
            }
            ";
}

if ('rounded-rectangle' == $supermag_button_design) {
    $custom_css .= "
            .featured-desc .above-entry-meta,
            .featured-desc .below-entry-meta .cat-links a,
            .entry-footer .cat-links a,
            article.post .read-more,
            article.page .read-more,
            .slider-section .cat-links a{
            border-radius: 4px;
            }
            ";
}
/*category color options*/
$args = array(
    'orderby' => 'id',
    'hide_empty' => 0
);
$categories = get_categories($args);
$wp_category_list = array();
$i = 1;
foreach ($categories as $category_list) {
    $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;
    $cat_color = 'cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]);
    if (isset($supermag_customizer_all_values[$cat_color])) {
        $cat_color = $supermag_customizer_all_values[$cat_color];
        if (!empty($cat_color)) {
            $custom_css .= "
                    .cat-links .at-cat-item-{$category_list->cat_ID}{
                    background: {$cat_color};
                    }
                    ";
        }
    }
    $i++;
}

/*custom css*/
$supermag_custom_css = wp_strip_all_tags($supermag_customizer_all_values['supermag-custom-css']);
if (! empty($supermag_custom_css)) {
    $custom_css .= $supermag_custom_css;
}$template_directory = get_stylesheet_directory_uri();


wp_add_inline_style('supermag-style', $custom_css);
