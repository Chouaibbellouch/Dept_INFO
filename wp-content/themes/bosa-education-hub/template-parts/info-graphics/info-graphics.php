<?php
$fact_one_title 	= get_theme_mod( 'fact_one_title', '' );
$fact_one_content   = get_theme_mod( 'fact_one_content', '' );

$fact_two_title 	= get_theme_mod( 'fact_two_title', '' );
$fact_two_content   = get_theme_mod( 'fact_two_content', '' );

$fact_three_title   = get_theme_mod( 'fact_three_title', '' );
$fact_three_content = get_theme_mod( 'fact_three_content', '' );

$fact_four_title    = get_theme_mod( 'fact_four_title', '' );
$fact_four_content  = get_theme_mod( 'fact_four_content', '' );


$fact_array = array();
$has_fact = false;
if( !empty( $fact_one_title) || !empty($fact_one_content ) ){
	$has_fact = true;
	$fact_array['fact_one'] = array(
		'title' => $fact_one_title,
		'content' => $fact_one_content,
	);
}
if( !empty($fact_two_title) || !empty($fact_two_content ) ){
	$has_fact = true;
	$fact_array['fact_two'] = array(
		'title' => $fact_two_title,
		'content' => $fact_two_content,
	);
}
if( !empty( $fact_three_title) || !empty($fact_three_content) ){
	$has_fact = true;
	$fact_array['fact_three'] = array(
		'title' => $fact_three_title,
		'content' => $fact_three_content,
	);
}
if( !empty( $fact_four_title) || !empty($fact_four_content) ){
	$has_fact = true;
	$fact_array['fact_four'] = array(
		'title' => $fact_four_title,
		'content' => $fact_four_content,
	);
}

if( !get_theme_mod( 'disable_info_graphics_section', true ) && $has_fact ){ ?>
	<section class="section-info-area">
		<div class="content-wrap">
			<div class="row">
				<?php foreach( $fact_array as $each_fact ){ ?>
					<div class="col-sm-6 col-lg-3">
						<article class="info-content-wrap text-center">							
							<div class="entry-content">
								<header class="entry-header">
									<h3 class="entry-title">
										<?php echo esc_html($each_fact['title']) ; ?>
									</h3>
									<?php echo esc_html($each_fact['content']) ; ?>
								</header>
							</div>
						</article>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>  