<?php
$featuredcategoryone = get_theme_mod('featured_category_one','');
$featuredcategoryoneID = get_theme_mod('featured_categories_image_one','');

$featuredcategorytwo = get_theme_mod('featured_category_two','');
$featuredcategorytwoID = get_theme_mod('featured_categories_image_two','');

$featuredcategorythree = get_theme_mod('featured_category_three','');
$featuredcategorythreeID = get_theme_mod('featured_categories_image_three','');

$featuredcategoryfour = get_theme_mod('featured_category_four','');
$featuredcategoryfourID = get_theme_mod('featured_categories_image_four','');

$featuredcategoryfive = get_theme_mod('featured_category_five','');
$featuredcategoryfiveID = get_theme_mod('featured_categories_image_five','');


$featuredcategory_array = array();
$has_featuredcategory = false;
if( !empty( $featuredcategoryoneID ) || !empty($featuredcategoryone) ){
	$featured_category_one  = wp_get_attachment_image_src( $featuredcategoryoneID,'bosa-420-300' );
 	if ( is_array(  $featured_category_one ) ){
 		$has_featuredcategory = true;
   	 	$featured_categories_one = $featured_category_one[0];
   	 	$featuredcategory_array['image_one']['ID'] = $featured_categories_one;
  	}
  	if ( !empty($featuredcategoryone) ){
 		$has_featuredcategory = true;
   	 	$featuredcategory_array['image_one']['category'] =  $featuredcategoryone;	
  	}
}
if( !empty( $featuredcategorytwoID ) || !empty($featuredcategorytwo) ){
	$featured_category_two = wp_get_attachment_image_src( $featuredcategorytwoID,'bosa-420-300' );
	if ( is_array(  $featured_category_two ) ){
		$has_featuredcategory = true;	
        $featured_categories_two = $featured_category_two[0];
        $featuredcategory_array['image_two']['ID'] = $featured_categories_two;	
  	}
  	if ( !empty($featuredcategorytwo) ){
 		$has_featuredcategory = true;
   	 	$featuredcategory_array['image_two']['category'] =  $featuredcategorytwo;	
  	}
}
if( !empty( $featuredcategorythreeID ) || !empty($featuredcategorythree) ){
	$featured_category_three = wp_get_attachment_image_src( $featuredcategorythreeID,'bosa-420-300' );
	if ( is_array(  $featured_category_three ) ){
		$has_featuredcategory = true;	
        $featured_categories_three = $featured_category_three[0];
        $featuredcategory_array['image_three']['ID'] = $featured_categories_three;		
  	}
  	if ( !empty($featuredcategorythree) ){
 		$has_featuredcategory = true;
   	 	$featuredcategory_array['image_three']['category'] =  $featuredcategorythree;	
  	}
}

if( !empty( $featuredcategoryfourID ) || !empty($featuredcategoryfour) ){	
	$featured_category_four = wp_get_attachment_image_src( $featuredcategoryfourID,'bosa-420-300' );
	if ( is_array(  $featured_category_four ) ){
		$has_featuredcategory = true;
      	$featured_categories_four = $featured_category_four[0];
      	$featuredcategory_array['image_four']['ID'] = $featured_categories_four;		
  	}
  	if ( !empty($featuredcategoryfour) ){
 		$has_featuredcategory = true;
   	 	$featuredcategory_array['image_four']['category'] =  $featuredcategoryfour;	
  	}
}

if( !empty( $featuredcategoryfiveID ) || !empty($featuredcategoryfive) ){	
	$featured_category_five = wp_get_attachment_image_src( $featuredcategoryfiveID,'bosa-420-300' );
	if ( is_array(  $featured_category_five ) ){
		$has_featuredcategory = true;
      	$featured_categories_five = $featured_category_five[0];
      	$featuredcategory_array['image_five']['ID'] = $featured_categories_five;	
  	}
  	if ( !empty($featuredcategoryfive) ){
 		$has_featuredcategory = true;
   	 	$featuredcategory_array['image_five']['category'] =  $featuredcategoryfive;	
  	}
}

if( !get_theme_mod( 'disable_featured_categories_section', true ) && $has_featuredcategory ){ ?>
	<section class="section-category-area">
		<div class="content-wrap">
			<?php foreach( $featuredcategory_array as $each_featuredcategory ){ ?>
				<article class="category-content-wrap">
					<?php if ( isset( $each_featuredcategory['ID'] ) && !empty( $each_featuredcategory['ID'] ) ){ ?>
						<figure class= "featured-image">
							<img src="<?php echo esc_url( $each_featuredcategory['ID'] ); ?>">
						</figure>
					<?php } ?>
					<?php if ( isset( $each_featuredcategory['category'] ) && !empty( $each_featuredcategory['category'] ) ){ ?>
						<h5 class="entry-title">
							<a href="<?php echo esc_url( get_category_link( $each_featuredcategory ['category'] ) ); ?>">
									<?php echo esc_html(get_cat_name( $each_featuredcategory ['category'] ) ); ?>
								<i class="fas fa-arrow-right"></i>
							</a>	
						</h5>
					<?php } ?>
				</article>
			<?php } ?>
		</div>
	</section>
<?php } ?>
