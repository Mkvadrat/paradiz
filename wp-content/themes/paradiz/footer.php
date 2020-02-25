<?php
/*
Theme Name: Paradiz
Theme URI: http://paradiz.loc/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://paradiz.loc/
Version: 1.0
*/
?>
        <?php if( is_front_page() ) { ?>
            <!-- start footer -->
            <?php $footer_image = getImageLink('background_images_footer_main_page'); ?>

            <footer class="container-fluid panorama-block footer-main-page" id="tenBlock" style="background-image: url( '<?php echo $footer_image ? $footer_image : esc_url( get_template_directory_uri() ) . '/images/bg-footer.png'; ?>' );">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-block">
                                <?php echo getMeta('contacts_information_footer_main_page'); ?>		
                                <div class="map-block">
                                    <?php $sevastopol = getMeta('map_coordinates_footer_main_page'); ?>
                                    
                                    <div id="sevastopol" style="width:100%; height:230px"></div>

                                    <script type="text/javascript">
                                        var sevastopolMap, sevastopolPlacemark, sevastopolcoords;
                                        ymaps.ready(init);
                                        function init () {
                                            //Определяем начальные параметры карты
                                            sevastopolMap = new ymaps.Map('sevastopol', {
                                                    center: [<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>], 
                                                    zoom: 17
                                                });	
                                            //Определяем элемент управления поиск по карте	

                                            var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});	
                                            //Добавляем элементы управления на карту
                                             sevastopolMap.controls              
                                                //.add('zoomControl')                
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
            </footer>

            <!-- end footer -->
        <?php }else{ ?>
            <!-- start footer-other-page -->
            <footer class="footer-other-page">
                <!-- start footer-menu-line -->
                <div class="container-fluid footer-menu-line">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-block">
                                    <img src="<?php echo getImageLink('footer_logotype_main_page'); ?>" alt="<?php echo getAltImage('footer_logotype_main_page'); ?>">
                                    <?php //echo getMeta('name_site_main_page'); ?>
                                </a>

                                <?php

                                    if (has_nav_menu('footer_menu')){
                                        wp_nav_menu( array(
                                            'theme_location'  => 'footer_menu',
                                            'menu'            => '',
                                            'container'       => false,
                                            'container_class' => '',
                                            'container_id'    => '',
                                            'menu_class'      => '',
                                            'menu_id'         => '',
                                            'echo'            => true,
                                            'fallback_cb'     => 'wp_page_menu',
                                            'before'          => '',
                                            'after'           => '',
                                            'link_before'     => '',
                                            'link_after'      => '',
                                            'items_wrap'      => '<nav class="menu"><ul>%3$s</ul></nav>',
                                            'depth'           => 3,
                                            'walker'          => new header_menu(),
                                        ) );
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end footer-menu-line -->

                <!-- start footer-contacts-line -->
                <div class="container-fluid footer-contacts-line">
                    <div class="container">
                        <div class="row">			
                        <div class="col-12">
                            <noindex><ul class="socials socials-mobile">
                            <li><a href="/contacts/#anchor"><img src="/wp-content/themes/paradiz/images/soc-1.png" alt=""></a></li>
                            <li><a href="mailto:hotel-hersones@mail.ru"><img src="/wp-content/themes/paradiz/images/soc-2.png" alt=""></a></li>
                            <li><a href="https://www.facebook.com/profile.php?id=100022987428500"><img src="/wp-content/themes/paradiz/images/soc-3.png" alt=""></a></li>
                            <li><a href="https://vk.com/public164168173"><img src="/wp-content/themes/paradiz/images/soc-4.png" alt=""></a></li>
                            <li><a href="https://www.instagram.com/restoranparadiz"><img src="/wp-content/themes/paradiz/images/soc-10.png" alt=""></a></li>
                            <li><a href="https://www.tripadvisor.ru/Hotel_Review-g295387-d2491608-Reviews-Apartments_Hersones-Sevastopol.html"><img src="/wp-content/themes/paradiz/images/soc-7.png" alt=""></a></li>
                            <li><a href="https://www.booking.com/hotel/xc/hersones.ru.html"><img src="/wp-content/themes/paradiz/images/soc-8.png" alt=""></a></li>
                            <li><a href="http://tophotels.ru/main/hotel/al38091/rating/"><img src="/wp-content/themes/paradiz/images/soc-9.png" alt=""></a></li>
                            </ul></noindex>
                        </div>
                            <div class="col-md-3">
                                <?php echo getMeta('contact_informations_footer_block_a_main_page'); ?>
                            </div>
                            
                            <div class="col-md-3">
                               <?php echo getMeta('contact_informations_footer_block_b_main_page'); ?>
                            </div>

                            <div class="col-md-3">
                                <?php echo getMeta('contact_informations_footer_block_c_main_page'); ?>
                            </div>

                            <div class="col-md-3">
                                <div class="call-us">
                                    <?php echo getMeta('contact_informations_footer_block_d_main_page'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end footer-contacts-line -->

                <!-- end footer-development-line -->
                <div class="container-fluid footer-development-line">
                    <div class="container">
                    <div class="row">
                            <div class="col-md-6">
                                <?php echo getMeta('wrapper_footer_block_a_main_page'); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo getMeta('wrapper_footer_block_b_main_page'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end footer-development-line -->
            </footer>
            <!-- end footer-other-page -->
        <?php } ?>
    </div>
    <!-- end wrapper for mobile menu -->
    
<script type="text/javascript">
$(document).ready(function() {
    $("a.ancLinks").click(function () {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        $('html,body').animate( { scrollTop: destination }, 1100 );
        return false;
    });
});
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52921174, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52921174" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

<?php wp_footer(); ?>

</body>
</html>