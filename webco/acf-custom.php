<?php
/**
 * Template Name: ACF Page
 *
 * The template for displaying pages with the ACF for custom pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package webco
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<section class='title_bar'>
<h1 class='fl-heading'><?php echo get_the_title(); ?></h1>
		</section>
		<?php
		$email = '';
		$link = '';
		while ( have_posts() ) : the_post(); ?>
		<div class='main_content container'>
			<?php $main_photo = get_field('main_photo');
echo "<img src='{$main_photo['url']}'>";
//echo '<pre>'; var_dump($main_photo); echo '</pre>';
			?>
		<section>
			<?php $main_content = get_field('main_content');
				echo '<p>'.$main_content.'</p>';	
				
				$show_cta = get_field('show_cta');
			if( $show_cta && ($show_cta == 'Yes') ): ?>
			<div class='cta_group'>
			<?php	
				if( have_rows('cta_button_group') ):  the_row();
				$cta_group = get_field('cta_button_group');
				foreach($cta_group as $name => $value){
			        $data = get_sub_field_object($name);
					if($data['value'] == 'Hide'){ continue; }
					if($data['type'] == 'button_group'){
						if(!empty($data['wrapper']['class'])){
							$link = "/".$data['wrapper']['class']; //the link address
						}
						elseif($name == 'get_quote'){$link = 'mailto:'.$email; }
						else{ $link = ''; }
echo "<a class='{$data['value']}' href='{$link}'>{$data['label']}</a>";
					}
					elseif( $data['type'] == 'email'){
						$email = esc_attr($data['value']);
					}
				} //foreach cta_group 
				endif; ?>
			</div> <!-- cta_group -->
			<?php endif; //to show cta? ?>
		</section>
		<?php echo do_shortcode("[sidebar]"); ?>
		</div> <!-- main_content -->
		<?php
			$show_products = get_field('show_products');
			if( $show_products && ($show_products == 'Yes') && have_rows('our_products') ):  the_row();
			
			echo "<div class='products_chosen picked'>
				<div class='container'>
				<h1>Our Products</h1>
				<p>Find additional information related to this Webco product line. If these resources do not deliver the details that you need, please <a href='/contact-us'>contact us</a>. Even if the tube product that you require is not listed here, we often can supply you with a solution. Webco develops custom tubing with many of its customers for a wide range of requirements in a variety of industries, delivered when they need it most.</p>";
				$products_chosen = get_sub_field('products_chosen');
				foreach($products_chosen as $name => $value){
			        echo $value;
				}
				echo "</div></div>";
			endif; //our_products
			
			$show_industries = get_field('show_industries');
		if( $show_industries && ($show_industries == 'Yes') && have_rows('industries_served') ):  the_row();
			
				echo "<div class='industries_chosen picked'>
				<div class='container'>
				<h1>Industries & Applications</h1>";
			
				$industries_chosen = get_sub_field('industries_chosen');
				foreach($industries_chosen as $name => $value){
			        echo $value;
				}
				echo "</div></div>";
			endif; //industries_served
			
			$creating_value = get_field('show_creating_value');
			if( $creating_value && ($creating_value == 'Yes') && have_rows('webco_creating_value') ):  the_row();
			
				echo "<div class='webco_values picked'>
				<section class='container'>
				<h1>Webco: Creating Value</h1>
				<p>Delivering superior tube products requires innovative equipment and know-how. Webco gets the details right, developing tubular products with precision dimensional and straightness tolerances in a range of surface finish options.</p>";
			
				$webco_values_chosen = get_sub_field('webco_values_chosen');
				foreach($webco_values_chosen as $name => $value){
			        echo $value;
				}		
				echo "<span><a class='Gold' href='/contact-us'>Contact Webco</a></span>
				</section></div>";
			endif; //webco_creating_value
			
			
			$resources = get_field('show_resources');
			if($resources && $resources == 'Yes'){
				echo "<div class='resources picked'>
				<div class='container'>
				<h1>Resources</h1>
				<p>Find additional information about Webco products and services ranging from technical expertise to logistics, specifications, and other important information below. If you still can't find the information that you need, please <a href='/contact-us'>contact us</a>, and we will help you find a solution to the job at hand.</p>";
				
	echo "<a class='Blue' href='/BWG-Gauge-Chart'>BWG Gauge Chart</a>";
	echo "<a class='Blue' href='/Our-Quality-Program'>Quality Program</a>";
	echo "<a class='Blue' href='/contact-us'>24/7 Contacts</a>";
				echo "</div></div>";
	
			}
			
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
		
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
