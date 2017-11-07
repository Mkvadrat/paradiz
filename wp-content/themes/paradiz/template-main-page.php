<?php
/*
Template name: Main page
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/

get_header(); 
?>

    <!-- start main-index -->
    
    <div class="main-index">
    
        <!-- start panorama-block -->
        <?php $block_a = getImageLink('image_panorama_block_a_main_page'); ?>
        <div class="container-fluid panorama-block" style="background-image: url( '<?php echo $block_a ? $block_a : esc_url( get_template_directory_uri() ) . '/images/bg-first-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block content-block-first-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_a_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#secBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start panorama-block -->
        <?php $block_b = getImageLink('image_panorama_block_b_main_page'); ?>
        <div class="container-fluid panorama-block" id="secBlock" style="background-image: url( '<?php echo $block_b ? $block_b : esc_url( get_template_directory_uri() ) . '/images/bg-second-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_b_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#thrBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start panorama-block -->
        <?php $block_c = getImageLink('image_panorama_block_c_main_page'); ?>
        <div class="container-fluid panorama-block" id="thrBlock" style="background-image: url( '<?php echo $block_c ? $block_c : esc_url( get_template_directory_uri() ) . '/images/bg-third-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_c_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#frthBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start panorama-block -->
        <?php $block_d = getImageLink('image_panorama_block_d_main_page'); ?>
        <div class="container-fluid panorama-block" id="frthBlock" style="background-image: url( '<?php echo $block_d ? $block_d : esc_url( get_template_directory_uri() ) . '/images/bg-fourth-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="content-block content-block-first-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_d_main_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-block">
                            <div class="portrait-block">
                                <?php $chief_cook_image = getImageLink('chief_cook_image_main_page'); ?>
                                <img src="<?php echo $chief_cook_image ? $chief_cook_image : esc_url( get_template_directory_uri() ) . '/images/portrait.jpg'; ?>" alt="<?php echo getAltImage('chief_cook_image_main_page'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <a class="ancLinks toBottom" href="#fifBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start panorama-block -->
        <?php $block_e = getImageLink('image_panorama_block_e_main_page'); ?>
        <div class="container-fluid panorama-block" id="fifBlock" style="background-image: url( '<?php echo $block_e ? $block_e : esc_url( get_template_directory_uri() ) . '/images/bg-fifth-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_e_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#sixBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start panorama-block -->
        <?php $block_f = getImageLink('image_panorama_block_f_main_page'); ?>
        <div class="container-fluid panorama-block" id="sixBlock" style="background-image: url( '<?php echo $block_f ? $block_f : esc_url( get_template_directory_uri() ) . '/images/bg-sixth-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block content-block-first-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_f_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#sevBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start main-slider-block -->
        
        <div class="main-slider-block" id="sevBlock">
            <div class="owl-carousel owl-theme main-slider">
                <?php
    				global $nggdb;
    				$slider_id = getNextGallery(get_the_ID(), 'slider_dish_main_page');
    				$slider_image = $nggdb->get_gallery($slider_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
    				if($slider_image){
    					foreach($slider_image as $image) {
    			?>
                        <div>
                            <img src="<?php echo nextgen_esc_url($image->imageURL); ?>" alt="<?php echo esc_attr($image->alttext); ?>">
                            <div class="description-block">
                                <?php echo htmlspecialchars_decode(esc_attr($image->description)); ?>
                            </div>
                        </div>
    				<?php
    					}
    				}
    			?>
            </div>
            <a class="ancLinks toBottom" href="#eightBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        </div>
        
        <!-- end main-slider-block -->
        
        <!-- start panorama-block -->
        <?php $block_g = getImageLink('image_panorama_block_g_main_page'); ?>
        <div class="container-fluid panorama-block" id="eightBlock" style="background-image: url( '<?php echo $block_g ? $block_g : esc_url( get_template_directory_uri() ) . '/images/bg-eight-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_g_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#ninBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end panorama-block -->
        
        <!-- start panorama-block -->
        <?php $block_h = getImageLink('image_panorama_block_h_main_page'); ?>
        <div class="container-fluid panorama-block" id="ninBlock" style="background-image: url( '<?php echo $block_h ? $block_h : esc_url( get_template_directory_uri() ) . '/images/bg-ninth-block.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                            <?php echo get_post_meta( get_the_ID(), 'content_panorama_block_h_main_page', $single = true ); ?>
                            
                            <a class="ancLinks toBottom" href="#thrBlock"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- end panorama-block -->

<?php get_footer(); ?>