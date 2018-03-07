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
                <div class="col-md-4">
                    <aside class="sidebar">
                        <div class="form-block">
                            <p class="title-sidebar">Форма обратной связи</p>
                            <div>
                                <label for="name">Ваше имя*</label>
                                <input id="name" type="text">
                                
                                <label for="surname">Фамилия</label>
                                <input id="surname" type="text">
                                
                                <label for="phone">Телефон</label>
                                <input id="phone" class="mask-phone" type="text">
                                
                                <label for="email">E-mail</label>
                                <input id="email" type="email">
                                
                                <?php
                                    $number_guests = get_post_meta( get_the_ID(), 'massive_number_guests_contacts_page', $single = true );
                                    $number_guests_explode_data = explode('|', $number_guests);
                                ?>
                                
                                <label for="guests">Количество гостей</label>
                                <select id="guests">
                                    <?php if($number_guests_explode_data) {?>
                                        <?php foreach($number_guests_explode_data as $data) {?>
                                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
 
                                <?php
                                    $hall_data = get_post_meta( get_the_ID(), 'massive_area_hall_selection_contacts_page', $single = true );
                                    $hall_explode_data = explode('|', $hall_data);
                                ?>
                                
                                <label for="hall">Выберите зал</label>                                
                                <select id="hall">
                                    <?php if($hall_explode_data) {?>
                                        <?php foreach($hall_explode_data as $name) {?>
                                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                
                                <label for="date">Дата и время визита</label>
                                <div class="date-time">
                                    <input class="datepicker" id="date" type="text" placeholder="09.11.2017">
                                    
                                    <div class="hours">
                                        <input class="timepicker" id="time" type="text" placeholder="08:00">
                                    </div>
                                </div>
                                
                                <label for="comment">Коментарий</label>
                                <textarea id="comment"></textarea>
                                
                                <?php echo get_post_meta( get_the_ID(), 'link_personal_data_contacts_page', $single = true ); ?>
                                
                                <input type="submit" onclick="SendForm(); return true;" value="Зарезервировать">
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-md-4">
                    <?php echo get_post_meta( get_the_ID(), 'title_text_block_b_contacts_page', $single = true ); ?>
                </div>
                
                <div class="col-md-4">
                    <?php echo get_post_meta( get_the_ID(), 'contact_information_contacts_page', $single = true ); ?>
                    
                    <div class="map-block">
                        <?php $sevastopol = getMeta('map_coordinates_contacts_page'); ?> 
                        
                        <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
                        <div id="contacts-page" style="width:100; height:330px"></div>
                        <script type="text/javascript">
                            var sevastopolMap, sevastopolPlacemark, sevastopolcoords;
                            ymaps.ready(init);
                            function init () {
                                //Определяем начальные параметры карты
                                sevastopolMap = new ymaps.Map('contacts-page', {
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

<script type="text/javascript">
//локализация календаря
$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь', 'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн', 'Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false
};

$.datepicker.setDefaults($.datepicker.regional['ru']);

$('.datepicker').datepicker({
    dateFormat: 'dd.mm.yy',
    minDate:0,
});

$(".mask-phone").mask("+7(999) 999-9999");
    
$('.timepicker').timepicker({ 'timeFormat': 'H:i' });

//форма обратной связи
function SendForm() {
	var data = {
		'action': 'SendForm',
		'name' : $('#name').val(),
        'surname' : $('#surname').val(),
        'phone' : $('#phone').val(),
        'email' : $('#email').val(),
        'guests' : $('#guests').val(),
        'hall' : $('#hall').val(),
        'date' : $('#date').val(),
        'time' : $('#time').val(),
		'message' : $('#comment').val()
	};
	$.ajax({
		url:'http://' + location.host + '/wp-admin/admin-ajax.php',
		data:data,
		type:'POST',
		success:function(data){
			swal({
				title: data.message,
				text: "",
				timer: 1000,
				showConfirmButton: false
			});
		}
	});
};
</script>

<?php get_footer(); ?>