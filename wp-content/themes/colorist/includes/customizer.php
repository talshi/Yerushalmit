<?php
/**
 * colorist Theme Customizer
 *
 * @package colorist
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function colorist_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'colorist_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function colorist_customize_preview_js() {
	wp_enqueue_script( 'colorist_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'colorist_customize_preview_js' );


if( get_theme_mod('enable_primary_color',false) ) {

	add_action( 'wp_head','wbls_customizer_primary_custom_css' );

		function wbls_customizer_primary_custom_css() {
			$primary_color = get_theme_mod( 'primary_color','#eb416b'); ?> 

	<style type="text/css">

		a,th a,button,.required,
		.site-header .branding .site-branding .site-title a,.site-title span,.page-template-blog-fullwidth .site-main .entry-body h1 a:hover,
		.page-template-blog-large .site-main .entry-body h1 a:hover,.blog .site-main .entry-body h1 a:hover,#recentcomments a,
		.comment-author cite.fn a:hover,.comment-author b,.comment-author a,.comment-metadata a:hover,.comment-metadata.reply a,
		.home .free-home #primary .post-wrapper .latest-post .latest-post-content h1 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h2 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h3 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h4 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h5 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h6 a:hover,
		.entry-content blockquote:before,.site-footer .dropcap,.widget_testimonial-widget .testimony .t-inner::before,.site-footer .widget_testimonial-widget p.client,.notice a:hover,.breadcrumb-wrap #breadcrumb a:hover i,.circle-icon-box .circle-icon-wrapper .fa-stack i,
		.circle-icon-box:hover a.link-title,.circle-icon-box:hover a.link-title h4,.circle-icon-box:hover h4,.icon-horizontal a.link-title i, .icon-horizontal .icon-title i, .icon-horizontal .fa-stack i, .icon-vertical a.link-title i, .icon-vertical .icon-title i, .icon-vertical .fa-stack i,.icon-horizontal:hover a.link-title, .icon-horizontal:hover .icon-title, .icon-horizontal:hover .fa-stack, .icon-vertical:hover a.link-title, .icon-vertical:hover .icon-title, .icon-vertical:hover .fa-stack,
		.pullright::before,.pullleft::before,.pullnone::before,.recent-post .rp-content h4:hover,.recent-post .rp-content a:hover h4,.recent-post .rp-content .entry-date,ul.filter-options li a:hover,.widget_stat-widget .stat-container .icon-wrapper i,.toggle-normal .toggle-title:hover,.widget_list-widget ul li .fa,.widget_list-widget ol li .fa,.widget_rss a,.widget-area ul a:hover,.recentcomments a,.site-footer .footer-widgets a:hover, .site-info a,
		.home .site-content #primary .post-wrapper .latest-post .latest-post-content h1 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h2 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h3 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h4 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h5 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h6 a:hover,
		#primary .entry-title a:hover,.widget-area .left-sidebar ul a:hover,#recentcomments a
		 {color: <?php echo $primary_color; ?>; 
		
		}

		.main-navigation a:hover,.main-navigation .current_page_item a, .main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a,input[type="button"],input[type="reset"],input[type="submit"],.main-navigation ul ul li,.sub-menu .current_page_item > a,.sub-menu .current-menu-item > a,.sub-menu .current_page_ancestor > a,.site-content .navigation .nav-links a:hover,.site-content .more-link:hover, 
		.page-links a:hover,ol.webulous_page_navi li a:hover,ol.webulous_page_navi li.bpn-current,
		.home .free-home #primary .post-wrapper .latest-post .latest-post-content p a:hover,#primary .sticky,.site-footer .circle-icon-box a.more-button:hover,
		a.more-button,.site-footer .flex-direction-nav a.flex-next:hover,.site-footer .flex-direction-nav a.flex-prev:hover,.site-footer .footer-bottom ul.menu li.current_page_item a,.site-footer .footer-bottom ul.menu li a:hover,
		.ui-accordion h3,.ui-accordion h3 span .fa,.ui-accordion .ui-accordion-header-active,.notice,.btn,
		.widget_button-widget a.btn.btn-default,.callout-widget,.wide-cta,.circle-icon-box a.more-button:hover,.circle-icon-box:hover .circle-icon-wrapper .fa-stack i,.circle-icon-box:hover a.more-button,.dropcap-circle,
		.dropcap-box,.widget_flexslider-widget .flexcarousel .flex-direction-nav a:hover,.icon-horizontal:hover .more-button a, .icon-vertical:hover .more-button a,.widget_image-box-widget a.more-button,.sub-menu .current_page_item > a, .sub-menu .current-menu-item > a, .sub-menu .current_page_ancestor > a,.portfolioeffects .overlay_icon a:hover,.widget_recent-work-widget .portfolioeffects .overlay_icon a:hover, .widget_recent-work-widget .work .overlay_icon a:hover,
		.widget.widget_skill-widget .skill-container .skill .skill-percentage,.widget_social-networks-widget ul li a:hover, .share-box ul li a:hover,.widget_stat-widget .stat-container .icon-wrapper h5::after,.tabs-container ul.tabs li.ui-tabs-active a,.tabs-container ul.tabs li a:hover,.tabs-container.center ul.tabs li a,.toggle-normal .toggle-title::before,.withtip::before,
		.service-features .service:hover .fa-stack,#secondary .left-sidebar .callout-widget,.widget_calendar #today,.widget_tag_cloud a,.top-nav ul li:hover a,.order-total .amount,
		.cart-subtotal .amount,.home .flexslider .flex-control-paging li .flex-active,.home .site-content #primary .post-wrapper .latest-post .latest-post-content p a:hover,.main-navigation ul ul a:hover
			{ background: <?php echo $primary_color; ?>; 
		}

		.main-navigation a:hover,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,ul.filter-options li a,.main-navigation .current_page_item a, .main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a  {
			border-bottom-color: <?php  echo $primary_color; ?>;
		}

		.entry-content blockquote,.sep:after,.pullright, .pullleft, .pullnone,.withtip.top:after {
			border-top-color: <?php  echo $primary_color; ?>;
		}

		.ui-accordion .ui-accordion-content::before,.tabs-container ul.tabs li.ui-tabs-active a::after,.tabs-container ul.tabs li a:hover::after,.withtip.left:after {
			border-left-color: <?php  echo $primary_color; ?>;
		}

		.withtip.right:after {
			border-right-color: <?php  echo $primary_color; ?>;
		}
		.comment-respond input[type="email"]:focus,.comment-respond input[type="text"]:focus,.comment-respond input[type="url"]:focus,.comment-respond textarea:focus,.bypostauthor article .comment-content,
		.widget_image-box-widget .image-box img,.widget.widget_skill-widget .skill-container .skill .skill-percentage::after,.toggle-normal .toggle-title,.cnt-address .fa,.widget_calendar caption,
		ol.webulous_page_navi li a:hover
		{border-color: <?php echo $primary_color?>;    
		}
			</style>
<?php
	}
}

if( get_theme_mod('enable_dd_bg_color',false) ) {

	add_action( 'wp_head','wbls_customizer_hover_custom_css' );

		function wbls_customizer_hover_custom_css() {
			$dd_bg_color = get_theme_mod( 'dd_bg_color','#676767'); ?>  

				<style type="text/css">

				.main-navigation ul ul a
							{
								background-color: <?php echo $dd_bg_color; ?>;
							}
				.main-navigation ul ul a
							{
								background-image: none;
							}
				</style>
<?php }
}


if( get_theme_mod('enable_secondary_color',false) ) {

	add_action( 'wp_head','wbls_customizer_secondary_custom_css' );

		function wbls_customizer_secondary_custom_css() {
			$secondary_color = get_theme_mod( 'secondary_color','#1e1e1e'); ?>

	<style type="text/css">

			/* secondary color */

		button,input,select,textarea,table tr th:hover a,.site-footer a.more-button:hover,
		.site-footer .widget_social-networks-widget ul li a:hover i,.left-sidebar .circle-icon-box:hover .icon-wrapper p.fa-stack i:before,.comment-list > li article .comment-meta .comment-author cite.fn a,.comment-list > li article .comment-meta .comment-author b:hover,.comment-list > li article .comment-meta .comment-author a:hover,
		.comment-list > li article .comment-meta .comment-metadata .reply a:hover,  .comment-respond input[type="email"]:focus,.comment-respond input[type="text"]:focus,
		.comment-respond input[type="url"]:focus,.comment-respond textarea:focus,#primary .sticky a:hover, #primary .sticky span:hover, #primary .sticky time:hover,.page-template-blog-fullwidth .site-main .entry-body h1 a,.page-template-blog-large .site-main .entry-body h1 a, .blog .site-main .entry-body h1 a,.recentcomments a:hover,.widget_rss a:hover,.widget_tag_cloud a:hover,.site-footer .footer-widgets .recentcomments a,.site-footer .footer-widgets .widget_archive select, .site-footer .footer-widgets .widget_categories select, .site-footer .footer-widgets .textwidget select,
		.site-footer .footer-widgets .widget_tag_cloud a:hover,.site-footer .footer-widgets .widget_rss ul a,.site-info a:hover
		 {
			color: <?php echo $secondary_color; ?>; 
			}
		
		button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,ol.webulous_page_navi li a,
		.flexslider .flex-caption a:hover,.btn:hover,.widget_button-widget a.btn.btn-default:hover,#secondary .left-sidebar .callout-widget a:hover,.comment-respond input[type="email"],.comment-respond input[type="text"],
		.comment-respond input[type="url"],.comment-respond textarea,.widget_text .textwidget p.btn-more a,.top-features a.more-button:hover,#secondary select, .footer-widgets select 
		{
			background-color: <?php echo $secondary_color; ?>; 
				}
		abbr, acronym {
			border-bottom-color: <?php echo $secondary_color; ?>; 
		}
		.page-numbers:last-child {
			border-right-color: <?php echo $secondary_color; ?>; 
		}
		button:focus,input[type="button"]:focus,input[type="reset"]:focus,input[type="submit"]:focus,button:active,
		input[type="button"]:active,input[type="reset"]:active,input[type="submit"]:active,
		.page-numbers,.widget_testimonial-widget .testimony,.widget_image-box-widget a.more-button:hover
		 {
			border-color: <?php echo $secondary_color; ?>; 
				}

			</style>
<?php
		}
}








