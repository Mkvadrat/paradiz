$(document).ready(function() {



	// FancyBox

	$(".fancybox").fancybox();



	// owl-carousel

	$('.main-slider').owlCarousel({

        loop:true,

        margin:0,

        nav:true,

        items:1,

        mouseDrag:true,

        touchDrag:true,

        dots:false,

        autoplay:true,

        autoplayTimeout:5000

    })


    // dotdotdot
    $('.content-page .events-list li a.breakfast-links').dotdotdot({
        height : 20,
        ellipsis : "\u2026",
        truncate : "word",
        watch: "word",
    });

    // MMENU

    $(function() {
        $('nav#menu').mmenu({
            extensions  : [ 'fx-listitems-slide', 'fx-panels-zoom', 'fx-listitems-slide', 'multiline', 'shadow-page', 'shadow-panels', 'listview-large', 'pagedim-black' ]
        });
    });

    $(function() {
        $('.mm-navbar .mm-title').text('Меню');
    });



	//Плавный скролл до блока .div по клику на .scroll

	$("a.scroll").click(function() {

		$.scrollTo($(".div"), 800, {

			offset: -90

		});

	});



    // Кнопка на верх

    $(function() {

        $(window).scroll(function() {

            if($(this).scrollTop() != 0) {

                $('#toTop').fadeIn();

            } else {

                $('#toTop').fadeOut();

            }

        });

        $('#toTop').click(function() {

            $('body,html').animate({scrollTop:0},800);

        });

    });



    // PARALAX



    $(document).ready(function(){

        $window = $(window);

        $('div[data-type="background"]').each(function(){

         var $bgobj = $(this);

         $(window).scroll(function() {

            var yPos = ($window.scrollTop() / $bgobj.data('speed')); 

            var coords = '45% '+ yPos + 'px';

            $bgobj.css({ backgroundPosition: coords });

        }); 

     });    

    });



    // SELECT-DROPDOWN



    $('select').each(function(){

        var $this = $(this), numberOfOptions = $(this).children('option').length;



        $this.addClass('select-hidden'); 

        $this.wrap('<div class="select"></div>');

        $this.after('<div class="select-styled"></div>');



        var $styledSelect = $this.next('div.select-styled');

        $styledSelect.text($this.children('option').eq(0).text());



        var $list = $('<ul />', {

            'class': 'select-options'

        }).insertAfter($styledSelect);



        for (var i = 0; i < numberOfOptions; i++) {

            $('<li />', {

                text: $this.children('option').eq(i).text(),

                rel: $this.children('option').eq(i).val()

            }).appendTo($list);

        }



        var $listItems = $list.children('li');







        $styledSelect.click(function(e) {

         if($('.select-options').is(':visible')) {

            e.stopPropagation();

            $styledSelect.text($(this).text()).removeClass('active');

            $this.val($(this).attr('rel'));



            $list.hide();

        //console.log($this.val());   



            } else {

                e.stopPropagation();

                $('div.select-styled.active').each(function(){

                    $(this).removeClass('active').next('ul.select-options').hide();

                });

                $(this).toggleClass('active').next('ul.select-options').toggle();

             }//end if

         });



        $listItems.click(function(e) {

            e.stopPropagation();

            $styledSelect.text($(this).text()).removeClass('active');

            $this.val($(this).attr('rel'));

            $list.hide();

        //console.log($this.val());

    });



        $(document).click(function() {

            $styledSelect.removeClass('active');

            $list.hide();

        });



    });
    ($(window).height() < 500) ? 0 : $('.content-block').height($(window).height());
    $(window).on('resize', function(){
        $('.content-block').height($(window).height());
    });

});