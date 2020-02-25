<?php
/*
Template name: Contacts page
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/
get_header();
?>
<!-- start main-contacts -->
<div class="main-contacts">
    <!-- start header-banner-block -->
    <?php
        $image_background = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
    ?>
    <div class="header-banner-block header-shares" data-speed="2" data-type="background" style="background-image: url( '<?php echo $image_background[0] ? $image_background[0] : esc_url( get_template_directory_uri() ) . '/images/bg-first-block.png'; ?>' );">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-header-block">
                        <p class="title"><?php echo get_title(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header-banner-block -->
    <div class="container content-page" id="anchor">
        <div class="row">
            <div class="col-md-12">
                <?php echo get_post_meta( get_the_ID(), 'title_text_block_a_contacts_page', $single = true ); ?>
            </div>
            
            <?php
                $forms_a = get_field('contact_form_contacts_page');
                if($forms_a){
            ?>
            <div class="col-md-4">
                <aside class="sidebar">
                    <div class="form-block">
                        <?php
                            echo do_shortcode('[contact-form-7 id=" ' . $forms_a . ' "]'); 
                        ?>
                    </div>
                </aside>
            </div>
            <?php } ?>
            
            <div class="col-md-4">
            <?php echo get_post_meta( get_the_ID(), 'title_text_block_b_contacts_page', $single = true ); ?>
            </div>
                <div class="col-md-4">
                <?php echo get_post_meta( get_the_ID(), 'contact_information_contacts_page', $single = true ); ?>
                <div class="map-block">
                    <?php $sevastopol = getMeta('map_coordinates_contacts_page'); ?>
                    <div id="contacts-page" style="width:100%; height:330px"></div>
                    <script type="text/javascript">
                        var sevastopolMap, sevastopolPlacemark, sevastopolcoords;
                        ymaps.ready(init);
                        function init () {
                            //Определяем начальные параметры карты
                            sevastopolMap = new ymaps.Map('contacts-page', {
                            center: [<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>],
                            zoom: 15
                            });
                            //Определяем элемент управления поиск по карте
                            var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});
                            //Добавляем элементы управления на карту
                            sevastopolMap.controls
                            .add('zoomControl')
                            .add('typeSelector')
                            sevastopolcoords = [<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>];
                            //Определяем метку и добавляем ее на карту
                            sevastopolPlacemark = new ymaps.Placemark([<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>],{}, {preset: "twirl#redIcon", draggable: true});
                            sevastopolMap.geoObjects.add(sevastopolPlacemark);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>