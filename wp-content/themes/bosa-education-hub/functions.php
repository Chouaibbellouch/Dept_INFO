<?php
/**
 * Theme functions and definitions
 *
 * @package Bosa Education Hub 1.0.0
 */

require get_stylesheet_directory() . '/inc/customizer/customizer.php';
require get_stylesheet_directory() . '/inc/customizer/loader.php';

if ( ! function_exists( 'bosa_education_hub_enqueue_styles' ) ) :
	/**
	 * @since Bosa Education Hub 1.0.0
	 */
	function bosa_education_hub_enqueue_styles() {
        require_once get_theme_file_path ( 'inc/wptt-webfont-loader.php');

		wp_enqueue_style( 'bosa-education-hub-style-parent', get_template_directory_uri() . '/style.css',
			array(
				'bootstrap',
				'slick',
				'slicknav',
				'slick-theme',
				'fontawesome',
				'bosa-blocks',
				'bosa-google-font'
				)
		);

	    wp_enqueue_style(
            'bosa-education-hub-google-fonts',
            wptt_get_webfont_url( "https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" ),
            false
        );

        wp_enqueue_style(
            'bosa-education-hub-google-fonts-two',
            wptt_get_webfont_url( "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" ),
            false
        );

        wp_enqueue_script( 'bosa-education-hub-custom-woo', get_stylesheet_directory_uri() . '/assets/js/custom-woo.js', array( 'jquery' ), '1.0', true );

	}

endif;
add_action( 'wp_enqueue_scripts', 'bosa_education_hub_enqueue_styles', 10 );

/**
* Registers menu location. 
* @since Bosa Education Hub 1.0.0
*/
function bosa_education_hub_menu_register(){
    register_nav_menu(
        'menu-4', esc_html__( 'Category Menu', 'bosa-education-hub' )
    );
}
add_action( 'after_setup_theme', 'bosa_education_hub_menu_register' );

/**
* Add cart link
* @since Bosa Education Hub 1.0.0
*/
if ( !function_exists( 'bosa_education_hub_cart_link' ) ) {
    function bosa_education_hub_cart_link() {
        ?>	
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <span class="header-svg-icon">
                    <svg width="20.6px" height="20.6px" viewBox="-60.369 566.879 20.6 20.6" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path fill="#253D4E" d="M-40.069,569.679h-16.465l-0.035-0.292c-0.072-0.608-0.364-1.169-0.821-1.575
                                c-0.457-0.407-1.048-0.632-1.66-0.632h-1.018v1.667h1.018c0.204,0,0.401,0.075,0.554,0.211c0.153,0.136,0.25,0.323,0.274,0.525
                                l1.321,11.223c0.072,0.608,0.364,1.169,0.821,1.575c0.457,0.407,1.048,0.632,1.66,0.632h11.018v-1.667h-11.018
                                c-0.204,0-0.401-0.075-0.554-0.211c-0.153-0.136-0.25-0.323-0.274-0.526l-0.109-0.93h13.485L-40.069,569.679z M-43.266,578.012
                                h-12.287l-0.784-6.667h14.274L-43.266,578.012z"/>
                            <path fill="#253D4E" d="M-54.236,587.179c0.92,0,1.667-0.746,1.667-1.667c0-0.921-0.746-1.667-1.667-1.667
                                s-1.667,0.746-1.667,1.667C-55.902,586.432-55.156,587.179-54.236,587.179z"/>
                            <path fill="#253D4E" d="M-45.902,587.179c0.921,0,1.667-0.746,1.667-1.667c0-0.921-0.746-1.667-1.667-1.667
                                c-0.92,0-1.667,0.746-1.667,1.667C-47.569,586.432-46.823,587.179-45.902,587.179z"/>
                        </g>
                    </svg>
                </span>
                <span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
                <div class="amount-cart hidden-xs"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div> 
            </a>
        <?php
    }
}

/**
* Add product cart box
* @since Bosa Education Hub 1.0.0
*/
if ( !function_exists( 'bosa_education_hub_header_cart' ) ) {
    function bosa_education_hub_header_cart() {
        ?>
            <div class="header-cart">
                <div class="header-cart-block">
                    <div class="header-cart-inner">
                        <?php bosa_education_hub_cart_link(); ?>
                        <?php if( !bosa_wooCom_is_cart() && !bosa_wooCom_is_checkout() ){  ?>
                            <ul class="site-header-cart menu list-unstyled text-center">
                                <li>
                                  <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
    }
}

/**
* Add header add to cart fragment
* @since Bosa Education Hub 1.0.0
*/
if ( !function_exists( 'bosa_education_hub_header_add_to_cart_fragment' ) ) {
    function bosa_education_hub_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        bosa_education_hub_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();
        return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'bosa_education_hub_header_add_to_cart_fragment' );
}

/**
* Add product wishlist
* @since Bosa Education Hub 1.0.0
*/
if ( !function_exists( 'bosa_education_hub_head_wishlist' ) ) {
    function bosa_education_hub_head_wishlist() {
        if ( function_exists( 'YITH_WCWL' ) ) {
            $wishlist_url = YITH_WCWL()->get_wishlist_url();
            ?>
            <div class="header-wishlist">
                <a href="<?php echo esc_url( $wishlist_url ); ?>">
                    <span class="header-svg-icon">
                        <svg width="20.6px" height="20.6px" viewBox="-28.967 472.28 20.6 20.6" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path fill="#253D4E" d="M-14.085,472.58c-0.938,0.016-1.856,0.296-2.66,0.814c-0.804,0.518-1.467,1.254-1.922,2.134
                                    c-0.454-0.88-1.117-1.616-1.921-2.134c-0.804-0.518-1.722-0.798-2.66-0.814c-1.495,0.07-2.904,0.771-3.919,1.951
                                    c-1.015,1.18-1.552,2.742-1.496,4.346c0,6.052,9.126,13.041,9.514,13.337l0.481,0.365l0.481-0.365
                                    c0.388-0.295,9.515-7.286,9.515-13.337c0.056-1.604-0.481-3.166-1.496-4.346C-11.181,473.351-12.59,472.65-14.085,472.58z
                                     M-18.667,490.381c-2.71-2.171-8.33-7.503-8.33-11.504c-0.057-1.13,0.305-2.239,1.007-3.084c0.702-0.845,1.688-1.358,2.741-1.427
                                    c1.054,0.069,2.039,0.582,2.741,1.427c0.702,0.845,1.064,1.953,1.007,3.084h1.666c-0.057-1.13,0.305-2.239,1.007-3.084
                                    c0.702-0.845,1.688-1.358,2.741-1.427c1.054,0.069,2.039,0.582,2.741,1.427s1.064,1.953,1.007,3.084
                                    C-10.337,482.88-15.957,488.211-18.667,490.381z"/>
                            </g>
                        </svg>
                    </span>
                    <span class="info-tooltip">
                        <?php esc_html_e( 'Wishlist', 'bosa-education-hub' ); ?>
                    </span>
                </a>
            </div>
            <?php
        }
    }
}

/**
* Add product compare icon in header
* @since Bosa Education Hub 1.0.0
*/
if (!function_exists( 'bosa_education_hub_head_compare' ) ) {
    function bosa_education_hub_head_compare() {
        if ( function_exists( 'yith_woocompare_constructor' ) ) {
            global $yith_woocompare;
            ?>
            <div class="header-compare">
                <a class="compare added" rel="nofollow" href="<?php echo esc_url( $yith_woocompare->obj->view_table_url() ); ?>">
                    <span class="header-svg-icon">
                        <svg width="20.6px" height="20.6px" viewBox="-62.923 456.029 20.6 20.6" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path fill="#253D4E" d="M-43.735,469.155l-4.008,1.204l0.399,1.376l1.631-0.516c-1.718,2.52-4.629,3.925-7.643,3.689l0,0
                                    c-0.256-0.018-0.511-0.049-0.764-0.095l0,0l-0.662-0.146l-0.272-0.052l-0.476-0.146l-0.323-0.155l-0.314-0.129l-0.501-0.249
                                    c-2.59-1.344-4.313-3.944-4.561-6.88l-1.393,0.12c0.276,3.381,2.222,6.391,5.172,7.998l0,0c0.255,0.138,0.518,0.267,0.79,0.387
                                    h0.093c0.238,0.103,0.484,0.189,0.73,0.275l0.17,0.06l0.637,0.163l0.272,0.069c0.161,0,0.331,0.052,0.501,0.077l0.416,0.069l0,0
                                    c3.71,0.389,7.321-1.366,9.342-4.541l0.535,1.849l1.342-0.396L-43.735,469.155z"/>
                                <path fill="#253D4E" d="M-61.57,463.066l4.059-1.006l-0.331-1.367l-1.622,0.404c1.837-2.428,4.808-3.685,7.805-3.302l0,0
                                    c0.254,0.033,0.506,0.079,0.756,0.138l0,0l0.654,0.172l0.178,0.06l0.476,0.172l0.34,0.146l0.306,0.146
                                    c0.161,0.086,0.331,0.172,0.493,0.275c2.523,1.472,4.125,4.149,4.246,7.095l1.393-0.052c-0.122-3.369-1.913-6.448-4.764-8.187l0,0
                                    l0,0c-0.247-0.154-0.502-0.295-0.764-0.421l-0.093-0.043c-0.232-0.109-0.47-0.212-0.713-0.31l-0.17-0.06
                                    c-0.204-0.077-0.416-0.146-0.628-0.206l-0.263-0.077l-0.493-0.112c-0.144,0-0.28-0.06-0.425-0.077h-0.042
                                    c-3.691-0.591-7.395,0.972-9.58,4.042l-0.45-1.875l-1.35,0.335L-61.57,463.066z"/>
                            </g>
                        </svg>
                    </span>
                    <span class="info-tooltip">
                        <?php esc_html_e( 'Compare', 'bosa-education-hub' ); ?>
                    </span>
                </a>
            </div>
            <?php
        }
    }
}

/**
* Add my account
* @since Bosa Education Hub 1.0.0
*/
if ( !function_exists( 'bosa_education_hub_my_account' ) ) {
    function bosa_education_hub_my_account() {
        if ( get_theme_mod('woo_account', 1 ) == 1) {
            ?>
            <div class="header-my-account">
                <div class="header-login"> 
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                        <span class="header-svg-icon">
                            <svg width="20" height="20" viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                <path d="M21.4443 24.3665H19.4443V19.3235C19.4435 18.5395 19.1317 17.7879 18.5774 17.2335C18.023 16.6791 17.2713 16.3673 16.4873 16.3665H8.40134C7.61733 16.3673 6.86567 16.6791 6.3113 17.2335C5.75693 17.7879 5.44513 18.5395 5.44434 19.3235V24.3665H3.44434V19.3235C3.44592 18.0093 3.96869 16.7494 4.89796 15.8201C5.82723 14.8909 7.08714 14.3681 8.40134 14.3665H16.4873C17.8015 14.3681 19.0614 14.8909 19.9907 15.8201C20.92 16.7494 21.4427 18.0093 21.4443 19.3235V24.3665Z" fill="#253D4E"/>
                                <path d="M12.4443 12.3665C11.2577 12.3665 10.0976 12.0146 9.11092 11.3553C8.12422 10.696 7.35519 9.75898 6.90106 8.66262C6.44694 7.56626 6.32812 6.35986 6.55963 5.19598C6.79114 4.03209 7.36258 2.96299 8.2017 2.12388C9.04081 1.28476 10.1099 0.713318 11.2738 0.481807C12.4377 0.250296 13.6441 0.369116 14.7404 0.823242C15.8368 1.27737 16.7739 2.0464 17.4332 3.0331C18.0924 4.01979 18.4443 5.17983 18.4443 6.36652C18.4427 7.95733 17.8101 9.48253 16.6852 10.6074C15.5604 11.7323 14.0352 12.3649 12.4443 12.3665ZM12.4443 2.36652C11.6532 2.36652 10.8799 2.60111 10.2221 3.04064C9.56426 3.48017 9.05157 4.10488 8.74882 4.83579C8.44607 5.56669 8.36686 6.37096 8.5212 7.14688C8.67554 7.9228 9.0565 8.63554 9.61591 9.19495C10.1753 9.75436 10.8881 10.1353 11.664 10.2897C12.4399 10.444 13.2442 10.3648 13.9751 10.062C14.706 9.75929 15.3307 9.2466 15.7702 8.5888C16.2097 7.931 16.4443 7.15764 16.4443 6.36652C16.4443 5.30565 16.0229 4.28824 15.2728 3.53809C14.5226 2.78795 13.5052 2.36652 12.4443 2.36652Z" fill="#253D4E"/>
                                </g>
                                <defs>
                                <clipPath id="clip0">
                                    <rect width="24" height="24" fill="white" transform="translate(0.444336 0.366516)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <span class="info-tooltip">
                            <?php esc_html_e( 'My Account', 'bosa-education-hub' ); ?>
                        </span>
                    </a>
                </div>
            </div>
            <?php
        }
    }
}

/**
* Add a header advertisement banner
* @since Bosa Education Hub 1.0.0
*/
function bosa_header_advertisement_banner(){
    $bannerImageID                      = get_theme_mod( 'header_advertisement_banner', '' );
    if ( !empty( $bannerImageID ) ){
        $render_header_ad_image_size        = get_theme_mod( 'render_header_ad_image_size', 'full' );
        $header_advertisement_banner_obj    = wp_get_attachment_image_src( $bannerImageID, $render_header_ad_image_size );
        if ( is_array(  $header_advertisement_banner_obj ) ){
            $header_advertisement_banner = $header_advertisement_banner_obj[0];
        }else{
            $header_advertisement_banner = '';
        }
        $alt = get_post_meta( $bannerImageID, '_wp_attachment_image_alt', true);
        ?>
            <div class="header-advertisement-banner">
                <a href="<?php echo esc_url( get_theme_mod( 'header_advertisement_banner_link', '#' ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" target="_blank">
                    <img src="<?php echo esc_url( $header_advertisement_banner ); ?>">
                </a>
            </div>
    <?php }
}

/**
* Check if all getting started recommended plugins are active.
* @since Bosa Education Hub 1.0.0
*/
if( !function_exists( 'bosa_are_plugin_active' ) ){
    function bosa_are_plugin_active() {
        if ( is_plugin_active( 'advanced-import/advanced-import.php' ) && is_plugin_active( 'keon-toolset/keon-toolset.php' ) && is_plugin_active( 'kirki/kirki.php' ) && is_plugin_active( 'elementor/elementor.php' ) && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) && is_plugin_active( 'yith-woocommerce-compare/init.php' ) && is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) && is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) && is_plugin_active( 'elementskit-lite/elementskit-lite.php' ) && is_plugin_active( 'woocommerce/woocommerce.php' ) && is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) && is_plugin_active( 'bosa-elementor-for-woocommerce/bosa-elementor-for-woocommerce.php' ) ){
            return true;
        }else{
            return false;
        }
    }
}

//Stop WooCommerce redirect on activation
add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

/**
* Get pages by post id.
* 
* @since Bosa Education Hub 1.0.0
* @return array.
*/
function bosa_education_hub_get_pages(){
    $page_array = get_pages();
    $pages_list = array();
    foreach ( $page_array as $key => $value ){
        $page_id = absint( $value->ID );
        $pages_list[ $page_id ] = $value->post_title;
    }
    return $pages_list;
}

/**
* Add a blog advertisement banner
* @since Bosa Education Hub 1.0.0
*/
if( !function_exists( 'bosa_education_hub_blog_advertisement_banner' ) ){
    function bosa_education_hub_blog_advertisement_banner(){
        $blogAdvertID                   = get_theme_mod( 'blog_advertisement_banner', '' );
        $render_blog_ad_image_size      = get_theme_mod( 'render_blog_ad_image_size', 'full' );
        $blog_advertisement_banner_obj  = wp_get_attachment_image_src( $blogAdvertID,  $render_blog_ad_image_size );
        if ( is_array(  $blog_advertisement_banner_obj ) ){
            $blog_advertisement_banner = $blog_advertisement_banner_obj[0];
            $advert_target = get_theme_mod( 'blog_advertisement_banner_target', true );
            $alt = get_post_meta( $blogAdvertID, '_wp_attachment_image_alt', true); ?>
            <div class="section-advert text-center">
                <a href="<?php echo esc_url( get_theme_mod( 'blog_advertisement_banner_link', '#' ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" target="<?php echo esc_attr( $advert_target ); ?>">
                    <img src="<?php echo esc_url( $blog_advertisement_banner ); ?>">
                </a>
            </div>
        <?php }
    }
}

if ( ! function_exists( 'bosa_education_hub_grid_thumbnail_date' ) ) :
    /**
     * Prints HTML with meta information for the tags and comments.
     */
    function bosa_education_hub_grid_thumbnail_date() {

        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date( 'M j, Y' ) ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date( 'M j, Y' ) )
        );
        $year = get_the_date( 'Y' );
        $month = get_the_date( 'm' );
        $link = ( is_single() ) ? get_month_link( $year, $month ) : get_permalink();

        $posted_on = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>';

        if ( !is_single() && !get_theme_mod( 'hide_date', false ) ){
            if ( !get_theme_mod( 'disable_date_thumbnail', false ) ){
                echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
            }
        }

        $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

        if ( !is_single() && !get_theme_mod( 'hide_author', false ) ){
            if ( !get_theme_mod( 'disable_author_thumbnail', true ) ){
                echo '<span class="byline"> ' . $byline . '</span>';
            }
        }

        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            if( !is_single() && !get_theme_mod( 'hide_comment', false ) ){ 
                if ( !get_theme_mod( 'disable_comment_thumbnail', true ) ){
                    echo '<span class="comments-link">';
                    comments_popup_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: post title */
                                __( 'Comment<span class="screen-reader-text"> on %s</span>', 'bosa-education-hub' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        )
                    );
                    echo '</span>';
                }
            }
        } 
    }
endif;

if( !function_exists( 'bosa_get_intermediate_image_sizes' ) ){
    /**
    * Array of image sizes.
    * 
    * @since Bosa Education Hub 1.0.0
    * @return array
    */
    function bosa_get_intermediate_image_sizes(){

        $data   = array(
            'full'          => esc_html__( 'Full Size', 'bosa-education-hub' ),
            'large'         => esc_html__( 'Large Size', 'bosa-education-hub' ),
            'medium'        => esc_html__( 'Medium Size', 'bosa-education-hub' ),
            'medium_large'  => esc_html__( 'Medium Large Size', 'bosa-education-hub' ),
            'thumbnail'     => esc_html__( 'Thumbnail Size', 'bosa-education-hub' ),
            '1536x1536'     => esc_html__( '1536x1536 Size', 'bosa-education-hub' ),
            '2048x2048'     => esc_html__( '2048x2048 Size', 'bosa-education-hub' ),
            'bosa-1920-550' => esc_html__( '1920x550 Size', 'bosa-education-hub' ),
            'bosa-1370-550' => esc_html__( '1370x550 Size', 'bosa-education-hub' ),
            'bosa-590-310'  => esc_html__( '590x310 Size', 'bosa-education-hub' ),
            'bosa-420-380'  => esc_html__( '420x380 Size', 'bosa-education-hub' ),
            'bosa-420-300'  => esc_html__( '420x300 Size', 'bosa-education-hub' ),
            'bosa-420-200'  => esc_html__( '420x200 Size', 'bosa-education-hub' ),
            'bosa-290-150'  => esc_html__( '290x150 Size', 'bosa-education-hub' ),
            'bosa-80-60'    => esc_html__( '80x60 Size', 'bosa-education-hub' ),
        );
        
        return $data;

    }
}

if( !function_exists( 'bosa_education_hub_archive_post_layout_filter' ) ){
    /**
    * Filter of archive post layout choices.
    * 
    * @since Bosa Education Hub 1.0.0
    * @return array
    */
    add_filter( 'bosa_archive_post_layout_filter', 'bosa_education_hub_archive_post_layout_filter' );
    function bosa_education_hub_archive_post_layout_filter( $post_layout ){
        $added_post_layout = array(
            'grid-thumbnail' => get_stylesheet_directory_uri() . '/assets/images/thumbnail-layout.png',
        );
        return array_merge( $post_layout, $added_post_layout );
    }
}

if( !function_exists( 'bosa_education_hub_header_layout_filter' ) ){
    /**
    * Filter of header layout choices.
    * 
    * @since Bosa Education Hub 1.0.0
    * @return array
    */
    add_filter( 'bosa_header_layout_filter', 'bosa_education_hub_header_layout_filter' );
    function bosa_education_hub_header_layout_filter( $header_layout ){
        $added_header = array(
            'header_fifteen'   => get_stylesheet_directory_uri() . '/assets/images/header-layout-15.png',
        );
        return array_merge( $header_layout, $added_header );
    }
}

if( !function_exists( 'bosa_education_hub_footer_layout_filter' ) ){
    /**
    * Filter of footer layout choices.
    * 
    * @since Bosa Education Hub 1.0.0
    * @return array
    */
    add_filter( 'bosa_footer_layout_filter', 'bosa_education_hub_footer_layout_filter' );
    function bosa_education_hub_footer_layout_filter( $footer_layout ){
        $added_footer = array(
            'footer_eight'  => get_stylesheet_directory_uri() . '/assets/images/footer-layout-8.png',
        );
        return array_merge( $footer_layout, $added_footer );
    }
}


add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );