'use strict';

(function ($) {
    

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
        /*------------------
            Set page
        --------------------*/
        if (window.location.href.match('index.php') != null) {
            $('#index_page').addClass('active');
        }
        else if (window.location.href.match('search.php') != null) {
            $('#search_page').addClass('active');
        }
        else if (window.location.href.match('contact.php') != null) {
            $('#contact_page').addClass('active');
        }
        else if (window.location.href.match('mycomics.php') != null) {
            $('#mycomics_page').addClass('active');
        }
        else {
            $('#index_page').addClass('active');
        }

    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
        Search
    --------------------*/
    $('#filter_by li').on('click', function() {
        $("#filter_by li").each(function() {
          $(this).css({
            "background": "none",
            "-webkit-box-shadow" : "none",
            "box-shadow": "none"
          });
        })
        $(this).css({
          "background": "#e5e5e5",
          "-webkit-box-shadow" : "inset 0px 0px 5px #c1c1c1",
          "box-shadow": "inset 0px 0px 5px #c1c1c1"
        });
    });

    $('.site-btn').on('click', function() {
        var query = "search.php";
        var qValue = $("input[id='q']").val();
        
        if (qValue.length != 0) {
            query = query + "?q=" + qValue;
        }
        var filterByValue = $("input[name='filterby']:checked").val();
        if (filterByValue != null) {
            query = query + "&by=" + filterByValue;
        }
        var filterLimitValue = $("input[name='filterlimit']:checked").val();
        if (filterLimitValue != null) {
            query = query + "&limit=" + filterLimitValue;
        }
        var filterOrderValue = $("input[name='filterorder']:checked").val();
        if (filterOrderValue != null) {
            query = query + "&order=" + filterOrderValue;
        }
        location.href = query;
    });

    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    /*------------------
        Login / Sign Up
    --------------------*/
    $(".email-login").hide();

    $("#signup-box-link").click(function(){
        $(".email-login").fadeOut(100);
        $(".email-signup").delay(100).fadeIn(100);
        $("#login-box-link").removeClass("active");
        $("#signup-box-link").addClass("active");
    });

    $("#login-box-link").click(function(){
        $(".email-login").delay(100).fadeIn(100);;
        $(".email-signup").fadeOut(100);
        $("#login-box-link").addClass("active");
        $("#signup-box-link").removeClass("active");
    });
    

    //humburger Menu
    $(".humburger_open").on('click', function () {
        $(".humburger_menu_wrapper").addClass("show_humburger_menu_wrapper");
        $(".humburger_menu_overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humburger_menu_overlay").on('click', function () {
        $(".humburger_menu_wrapper").removeClass("show_humburger_menu_wrapper");
        $(".humburger_menu_overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    $('.hero_categories_all').on('click', function(){
        $('.hero_categories ul').slideToggle(400);
    });

    /*-----------------------------
        MyComics Slider
    -------------------------------*/
    $(".mycomics_slider").owlCarousel({
        loop: false,
        rewind: true,
        margin: 0,
        items: 5,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        responsive: {

            0: {
                items: 1,
                nav: false
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 5,
            }
        }
    });

    /*-----------------------
		Price Range Slider
	------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('' + ui.values[0]);
            maxamount.val('' + ui.values[1]);
        }
    });
    minamount.val('' + rangeSlider.slider("values", 0));
    maxamount.val('' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
		Single comic
	--------------------*/
    $('.comic_details_pic_slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.comic_details_pic_item--large').attr('src');
        if (imgurl != bigImg) {
            $('.comic_details_pic_item--large').attr({
                src: imgurl
            });
        }
    });

    $('#heart-icon').on('click', function() {
        if ( $('#heart-icon').is('.heart-icon-active') ){
            $('#heart-icon').text(' Add to favorite');
            $("#heart-icon").toggleClass('heart-icon-active heart-icon');
            $("#heart-icon").prepend('<span class="icon_heart_alt"></span>');
            $.ajax({
                type:"POST",
                url:"manage_library.php",
                async: false,
                data : {
                    "table" : "user_fav_comics",
                }
            });
        }
        else {
            $('#heart-icon').text(' Remove to favorite');
            $("#heart-icon").toggleClass('heart-icon heart-icon-active');
            $("#heart-icon").prepend('<span class="icon_heart_alt"></span>');
            $.ajax({
                type:"POST",
                url:"manage_library.php",
                async: false,
                data : {
                    "table" : "user_fav_comics",
                    "add" : 1
                }
            });
        }
        
    });

    $('#book-icon').on('click', function() {
        if ( $('#book-icon').is('.heart-icon-active') ){
            $('#book-icon').text(' Add to read');           
            $("#book-icon").toggleClass('heart-icon-active heart-icon');
            $("#book-icon").prepend('<span class="icon_book_alt"></span>');
            
            $.ajax({
                type:"POST",
                url:"manage_library.php",
                async: false,
                data : {
                    "table" : "user_read_comics",
                }
            });

        }
        else {
            $('#book-icon').text(' Remove to read');
            $("#book-icon").toggleClass('heart-icon heart-icon-active');
            $("#book-icon").prepend('<span class="icon_book_alt"></span>');
            $.ajax({
                type:"POST",
                url:"manage_library.php",
                async: false,
                data : {
                    "table" : "user_read_comics",
                    "add" : 1
                }
            });
        }
        
    });

    $('#archive-icon').on('click', function() {
        if ( $('#archive-icon').is('.heart-icon-active') ){
            $('#archive-icon').text(' Add to bought');
            $("#archive-icon").toggleClass('heart-icon-active heart-icon');
            $("#archive-icon").prepend('<span class="icon_archive_alt"></span>');
            $.ajax({
                type:"POST",
                url:"manage_library.php",
                async: false,
                data : {
                    "table" : "user_bought_comics",
                }
            });
        }
        else {
            $('#archive-icon').text(' Remove to bought');
            $("#archive-icon").toggleClass('heart-icon heart-icon-active');
            $("#archive-icon").prepend('<span class="icon_archive_alt"></span>');
            $.ajax({
                type:"POST",
                url:"manage_library.php",
                async: false,
                data : {
                    "table" : "user_bought_comics",
                    "add" : 1
                }
            });
        }
        
    });


    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

})(jQuery);