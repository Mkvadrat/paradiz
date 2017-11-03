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

        <!-- start footer -->
        <?php $footer_image = getImageLink('background_images_footer_main_page'); ?>
        <footer class="container-fluid panorama-block footer-main-page" id="ninBlock" style="background-image: url( '<?php echo $footer_image ? $footer_image : esc_url( get_template_directory_uri() ) . '/images/bg-footer.png'; ?>' );">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                           
                            <?php echo getMeta('contacts_information_footer_main_page'); ?>
                           
                            <div class="map-block">

                                <?php $sevastopol = getMeta('map_coordinates_footer_main_page'); ?> 
                                
                                <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
                                <div id="sevastopol" style="width:100; height:230px"></div>
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

<?php wp_footer(); ?>

</body>
</html>