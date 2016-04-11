jQuery(window).load(function () {

    jQuery(".intro img").addClass("animated normal zoomIn");
    jQuery(".mmg_app_logo span").addClass("animated normal rotateIn");
    jQuery(".intro h1").addClass("animated normal fadeInUp");
    // jQuery('.intro_arrow1').delay(1000).css({width:'25px'}, 200).css({
    // 	WebkitTransform: 'rotate(' + 45 + 'deg)'
    // }, 400); 
    //    jQuery('.intro_arrow2').delay(1000).css({width:'25px'}, 200).css({
    //    	WebkitTransform: 'rotate(' + -45 + 'deg)'
    //    }, 400); 



    setInterval(function () {
        jQuery('.intro_arrow1').css({width: '25px'}, 200).css({
            WebkitTransform: 'rotate(' + 45 + 'deg)'
        }, 400);
        jQuery('.intro_arrow2').css({width: '25px'}, 200).css({
            WebkitTransform: 'rotate(' + -45 + 'deg)'
        }, 400).delay(800).promise().done(function () {
            resetarrow();
        });
        //     jQuery('.intro_arrow1').css({width:'0'}, 800).css({
        // 	WebkitTransform: 'rotate(' + 0 + 'deg)'
        // }, 1000); 
        //    jQuery('.intro_arrow2').css({width:'0'}, 800).css({
        //    	WebkitTransform: 'rotate(' + 0 + 'deg)'
        //    }, 1000); 

    }, 2000);
    function resetarrow() {
        // console.log("ERROR");
        jQuery('.intro_arrow1').css({width: '0'}, 200).css({
            WebkitTransform: 'rotate(' + 0 + 'deg)'
        }, 400);
        jQuery('.intro_arrow2').css({width: '0'}, 200).css({
            WebkitTransform: 'rotate(' + 0 + 'deg)'
        }, 400);
    }




    ftResize();
    var screen_widthInit = jQuery(window).width();
    if (screen_widthInit >= 400) {

        jQuery(window).resize(function () {
            ftResize();
        });
    }

    jQuery(function () {
        if (jQuery(window).width() <= 960) {
            jQuery(".intro img").each(function () {
                jQuery(this).attr("src", jQuery(this).attr("src").replace("social/", "social/960/"));
            });
        }
    });

    jQuery(".inputfirst input").first().focus();
    function ftResize() {
        // All height calc
        var $window = jQuery(window);
        var screen_width = $window.width();
        var tomheight = $window.height();
        var windowheight = $window.height();
        // jQuery("#owl-demo-intro").css("height",tomheight-100);

        var navPos = jQuery(".nav").position();
        var navHeight = jQuery(".nav").height();
        var kmaRightHeight = jQuery(".kma_right").height();
        var kmaLeftHeight = jQuery(".kma_left_1").height();
        var mobileFilterHeight = jQuery(".mobile_filter").height();
        var kmaSignupHeight = kmaRightHeight - kmaLeftHeight;

        var contInsideTitle = jQuery(".cont_inside .page-title").innerHeight();

        var AcColLeftHeight = jQuery(".customer-account .col-left").height();
        var AcColMainHeight = jQuery(".customer-account .col2-left-layout .col-main").height();

        if (screen_width >= 700) {
            if (AcColLeftHeight >= AcColMainHeight) {
                jQuery(".customer-account .col2-left-layout .col-main").css("height", AcColLeftHeight);
            }
            if (AcColMainHeight >= AcColLeftHeight) {
                jQuery(".customer-account .col-left").css("height", AcColMainHeight);
            }
        }

        if ((jQuery(".genome_head").length) > 0) {

        }

        if ((jQuery(".genome_head").length) > 0) {
            var genomeHeadPos = jQuery(".genome_test_wrapper").position().top;
        }

        var genomeTestWrapperHeight = jQuery(".genome_test_wrapper").height();
        if ((jQuery(".genome_test_other").length) > 0) {
            var genomeTestOther = jQuery(".genome_test_other").position().top;
        }

        if ((jQuery(".customer_review").length) > 0) {
            var customerReviewPos = jQuery(".customer_review").position().top;
        }

        if ((jQuery(".more_products").length) > 0) {
            var moreProductsPos = jQuery(".more_products").position().top;
        }

        if ((jQuery(".blog").length) > 0) {
            var blogPos = jQuery(".blog").position().top;
        }

        if ((jQuery(".media").length) > 0) {
            var mediaPos = jQuery(".media").position().top;
        }

        if ((jQuery(".prod_list_right").length) > 0) {
            var prodListTop = jQuery(".prod_list_right").position().top;
        }

        if ((jQuery(".more_products").length) > 0) {
            var moreProductsTop = jQuery(".more_products").position().top;
        }

        if (screen_width <= 480) {
            jQuery(".each_mini_cart").css("width", 300);

            //var cartNos = parseInt(jQuery('#cart_qty').html());
            var cartNos = jQuery('.each_mini_cart').length;
            //alert(cartNos);
            jQuery(".all_each_mini_cart_in").css("width", (cartNos * 300) + 40);
        }
        if (screen_width <= 1200) {
            jQuery(".home .nav").addClass("nav_color nav_act_start nav_act");
        }
        var footerHeight = jQuery(".footer").height();
        if ((jQuery(".prod_category").length) > 0) {
			 if (jQuery(".prod_lists").length) {
            var prodCategory = jQuery(".prod_lists").position().top;
            var prodCategoryHeight = jQuery(".prod_category").height();
            var prodCategoryWidth = jQuery(".prod_category").width();
            var helpDeskHeight = jQuery(".help_desk").height();
			 }
        }
        // var introHeight = jQuery(".intro").height();

        jQuery(".prod_list_right,.catalogsearch-result-index .page-title").css("width", screen_width - prodCategoryWidth);
        jQuery(".footer_left,.footer_right").css("height", footerHeight);
        jQuery(".site-width").css("width", screen_width);
        jQuery(".site-height").css("height", tomheight);
        jQuery(".intro").css("height", tomheight - navHeight);
        jQuery(".kma_signup").css("height", kmaSignupHeight);
        var introContrl = (tomheight - navHeight - 200) / 2;
        jQuery("#owl-demo-intro .owl-controls").css("marginTop", -(introContrl - 90));
        jQuery(".age_dial").each(function (index) {
            jQuery(this).on("click", function () {
                jQuery(this).addClass("active");
                jQuery(this).siblings().removeClass("active");
                if (screen_width <= 480) {
                    jQuery('body,html').animate({scrollTop: moreProductsTop});
                }
            });
        });
        // jQuery(".blog_lists ul li a").hover(function(){
        //        jQuery(this).find("span:nth-child(1) img").addClass("zoomIn");
        // },function(){
        // 	jQuery(this).find("span:nth-child(1) img").removeClass("zoomIn");
        // });



        jQuery(".male_click").on("click", function () {
            jQuery(this).addClass("active");
            jQuery(".female_click").removeClass("active");
            jQuery(".male").addClass("fadeInDown20");
            jQuery(".female").addClass("fadeInUp20");
            jQuery(".female").removeClass("fadeInDown20");
            jQuery(".male").removeClass("fadeInUp20");
            jQuery(".female").addClass("active");
            jQuery(".male").removeClass("active");
        });
        jQuery(".female_click").on("click", function () {
            jQuery(this).addClass("active");
            jQuery(".male_click").removeClass("active");
            jQuery(".female").addClass("fadeInDown20");
            jQuery(".male").addClass("fadeInUp20");
            jQuery(".male").removeClass("fadeInDown20");
            jQuery(".female").removeClass("fadeInUp20");
            jQuery(".male").addClass("active");
            jQuery(".female").removeClass("active");
        });
        jQuery(".search_btn").on("click", function () {

            jQuery(".inputfirst").first().focus();
            if (!jQuery(this).hasClass("active")) {

                jQuery(this).addClass("active");
                jQuery(".search_opn").css("height", 100);
                jQuery(".search_opn").addClass("active");
                jQuery(".ovrly").addClass("active");
            }
            else {
                jQuery(this).removeClass("active");
                jQuery(".search_opn").css("height", 0);
                jQuery(".search_opn").removeClass("active");
                jQuery(".ovrly").removeClass("active");
            }

        });
        jQuery(".ovrly,.inside_ovrly").on("click", function () {
            jQuery(".search_btn").removeClass("active");
            jQuery(".search_opn").css("height", 0);
            jQuery(".search_opn").removeClass("active");
            jQuery(".ovrly").removeClass("active");
            jQuery(".mini_cart").removeClass("active");
            jQuery(this).removeClass("active");
            jQuery(".mini_cart_close").removeClass("active");
            jQuery("body").removeClass("noscroll");
            jQuery(".prod_detail_pop").removeClass("active");
            jQuery(".ovrly").removeClass("activee");
            jQuery(".prod_filter_in ul > li > .div").removeClass("active");
            jQuery(".inside_ovrly").removeClass("active");
            jQuery(".prod_list_left").removeClass("active");
            jQuery(".mobile_filter > span:nth-child(1)").removeClass("active");
            jQuery(".mobile_menu").removeClass("active");
            jQuery(".ovrly").removeClass("active");
            jQuery(".nav_wrap,.nav_other_wrap").removeClass("active");
            jQuery("body").removeClass("noscroll");
            jQuery(".mobile_menu").css("left", 0);
        });
        jQuery(".prod_search_in input").on("focus", function () {

            jQuery(".prod_search .prod_search_in div").addClass("active");
        });
        jQuery(".prod_search_in input").on("focusout", function () {

            jQuery(".prod_search .prod_search_in div").removeClass("active");
        });

        // jQuery(".cart-item-quantity").on("focus", function () {

        //     jQuery(".quantity-button").addClass("active");
        // });


        var temp_scroll_pos = 0;


        jQuery(".prod_links a:nth-child(1),.cart_btn").on("click", function () {
            // e.stopPropagation();
            if (!jQuery(".mini_cart").hasClass("active")) {


                jQuery(this).find("span").addClass("active");
                temp_scroll_pos = jQuery(document).scrollTop();
                // alert("OPEN: "+temp_scroll_pos);

                // jQuery(".cart-item-quantity").first().focus();


                setTimeout(function () {
                    if (jQuery(".nav").hasClass("is-hidden")) {
                        jQuery(".nav").removeClass("is-hidden");
                    }
                    jQuery(".mini_cart").addClass("active");
                    jQuery(this).addClass("active");
                    jQuery(".ovrly").addClass("active");
                    jQuery(".mini_cart_close").addClass("active");
                    jQuery(".prod_links a:nth-child(1) span").removeClass("active");
                    jQuery("body").addClass("noscroll noscrollcart");
                    // jQuery(".nav").css("zIndex",1005);

                }, 800);
            }
        });

        jQuery(".mini_cart_close").on("click", function () {
            // e.stopPropagation();
            if (jQuery(".mini_cart").hasClass("active")) {

                temp_scroll_pos = jQuery(document).scrollTop();

                jQuery("html,body").scrollTop(temp_scroll_pos);
                // alert("CLOSE: "+temp_scroll_pos);
                if (jQuery(".nav").hasClass("is-hidden")) {
                    jQuery(".nav").addClass("is-hidden");
                }
                // jQuery(".nav").addClass("is-hidden");
                jQuery(".mini_cart").removeClass("active");
                jQuery(this).removeClass("active");
                jQuery(".ovrly").removeClass("active");
                jQuery(".mini_cart_close").removeClass("active");
                jQuery(".prod_links a:nth-child(1) span").removeClass("active");
                jQuery("body").removeClass("noscroll noscrollcart");
                jQuery(".cart_btn").find("span").removeClass("active");
            }
        });

        // jQuery(".cart_btn").on("click", function () {
        //     if (!jQuery(".mini_cart").hasClass("active")) {
        //         jQuery(".mini_cart").addClass("active");
        //         jQuery(this).addClass("active");
        //         jQuery(".ovrly").addClass("active");
        //         jQuery(".mini_cart_close").addClass("active");
        //         jQuery("body").addClass("noscroll");
        //     }
        //     else {
        //         jQuery(".mini_cart").removeClass("active");
        //         jQuery(this).removeClass("active");
        //         jQuery(".ovrly").removeClass("active");
        //         jQuery(".mini_cart_close").removeClass("active");
        //         jQuery("body").removeClass("noscroll");
        //     }
        // });


        jQuery(".mobile_menu").on("click", function () {
            if (!jQuery(".mobile_menu").hasClass("active")) {
                jQuery(".nav_wrap,.nav_other_wrap").addClass("active");
                jQuery(".nav_wrap").css("width", screen_width - 55);
                jQuery(this).addClass("active");
                jQuery(".ovrly").addClass("active");
                jQuery("body").addClass("noscroll");
                jQuery(".mobile_menu").css("left", screen_width - 55);
            }
            else {
                jQuery(this).removeClass("active");
                jQuery(".ovrly").removeClass("active");
                jQuery(".nav_wrap,.nav_other_wrap").removeClass("active");
                jQuery("body").removeClass("noscroll");
                jQuery(".mobile_menu").css("left", 0);
            }
        });
        //comment for temp 
        jQuery(document).on("click", ".wrap", function (e) {
            e.preventDefault();
            temp_scroll_pos = jQuery(document).scrollTop();
            // alert("OPEN: "+temp_scroll_pos);
            jQuery(".prod_detail_pop").addClass("active");
            jQuery(this).addClass("active");
            jQuery(".pro_close_wrapper").addClass("active");
            jQuery(".ovrly").addClass("activee");

            jQuery("body").addClass("noscrollpop");
            if (screen_width <= 1024) {
                jQuery("html,body").scrollTop(0);
            }

            var href = jQuery(this).data('href');
            jQuery('#product_close').attr('data-href', parenturl);
            // Getting Content
            getContent(href, true, jQuery(this));

        });

        /*new code added by dev team*/
        jQuery(document).on("click", ".pro_close_wrapper", function (e) {
            e.preventDefault();

            jQuery(".prod_detail_pop").removeClass("active");
            jQuery(this).removeClass("active");
            jQuery(".pro_close_wrapper").removeClass("active");
            jQuery(".ovrly").removeClass("activee");
            jQuery("body").removeClass("noscrollpop");
            // alert("CLOSE: "+temp_scroll_pos);
            if (screen_width <= 1024) {
                jQuery("html,body").scrollTop(temp_scroll_pos);
            }
            // jQuery(".mini_cart_close").removeClass("active");
            // jQuery(".prod_links a:nth-child(1) span").removeClass("active");

            var href = jQuery('#product_close').data('href');
            history.pushState(null, null, href);
            jQuery('#prod_content').empty();

        });





        jQuery(document).on("click", ".share,.share_opn b", function () {

            if (!jQuery(this).hasClass("active")) {

                jQuery(this).addClass("active");
            }
            else {
                jQuery(this).removeClass("active");
            }

        });
        jQuery(".prod_filter_in ul > li span").on("click", function () {

            if (!jQuery(this).hasClass("active")) {

                jQuery(this).parent().find(".div").addClass("active");
                jQuery(".inside_ovrly").addClass("active");
                jQuery(this).parent().addClass("active");
                jQuery("body").addClass("noscroll");
                jQuery('body,html').animate({scrollTop: prodCategory - 200});
                if (screen_width > 960) {
                    jQuery(this).find(".div input").first().focus();
                }
                jQuery(this).parent().siblings().find(".div").removeClass("active");
                jQuery(this).parent().siblings().removeClass("active");
            }
            else {
                jQuery(this).parent().find(".div").removeClass("active");
                jQuery(".inside_ovrly").removeClass("active");
                jQuery("body").addClass("noscroll");
                jQuery(this).parent().removeClass("active");
            }

        });
        jQuery(".prod_filter_in ul > li:last-child").on("click", function () {
            jQuery(this).find(".div").removeClass("active");
            jQuery(".inside_ovrly").removeClass("active");
            jQuery("body").removeClass("noscroll");
        });
        jQuery(".mobile_filter > span:nth-child(2),.product_filter_close").on("click", function () {

            if (!jQuery(".mobile_filter > span:nth-child(2)").hasClass("active")) {

                jQuery(".prod_filter").addClass("active");
                jQuery(".mobile_filter > span:nth-child(2)").addClass("active");
                jQuery(".prod_list_left").removeClass("active");
                jQuery(".mobile_filter > span:nth-child(1)").removeClass("active");
            }
            else {
                jQuery(".prod_filter").removeClass("active");
                jQuery(".mobile_filter > span:nth-child(2)").removeClass("active");
                jQuery(".inside_ovrly").removeClass("active");
                jQuery("body").removeClass("noscroll");
            }

        });
        jQuery(".mobile_filter > span:nth-child(1)").on("click", function () {

            if (!jQuery(".mobile_filter > span:nth-child(1)").hasClass("active")) {
                jQuery(".inside_ovrly").addClass("active");
                jQuery(".prod_list_left").addClass("active");
                jQuery(".mobile_filter > span:nth-child(1)").addClass("active");
                jQuery('body,html').animate({scrollTop: prodCategory - mobileFilterHeight + 250});
            }
            else {
                jQuery(".prod_list_left").removeClass("active");
                jQuery(".mobile_filter > span:nth-child(1)").removeClass("active");
                jQuery(".inside_ovrly").removeClass("active");
            }

        });
        jQuery(".nav_wrap > ul > li").on("click", function () {
            jQuery(this).removeClass("active");
            jQuery(this).siblings().removeClass("active");
        });
        // jQuery(".nav_wrap").hover(function () {
        //     jQuery(this).addClass("active");
        //     jQuery(".nav_in").addClass("active");
        // }, function () {
        //     jQuery(this).removeClass("active");
        //     jQuery(".nav_in").removeClass("active");
        // });
        var screen_width_inner = jQuery(window).innerWidth();
        var col1Layout = jQuery(".cont_inside").width();
        var col1Padd = screen_width_inner - col1Layout + 40;
        // alert(col1Padd);

        jQuery(".boards ul li").on("click", function (event) {
            if (!jQuery(".grids ul li a").hasClass("active")) {
                jQuery(this).addClass("active");
                // jQuery(".grids").css("width","25%");
                jQuery(".board_content,.grids").addClass("active");
                if (screen_width <= 1030) {
                    jQuery(".ovrly").addClass("active");
                }
                event.preventDefault();
                var target = "#" + this.getAttribute('data-target');
                if (!jQuery(".nav").hasClass("is-hidden") && (screen_width > 1030)) {
                    jQuery('html, body').animate({
                        scrollTop: jQuery(target).offset().top - 10
                    }, 500);
                }
                else {
                    jQuery('html, body').animate({
                        scrollTop: jQuery(target).offset().top - 10
                    }, 500);

                }

                var gridsWidth = jQuery(".grids").width();
                jQuery(".board_content").css("width", screen_width - gridsWidth - col1Padd);
            }
        });
        jQuery(".board_content_in").on("click", function (event) {
            jQuery(".boards ul li").removeClass("active");
            jQuery(".board_content,.grids").removeClass("active");
            jQuery(".ovrly").removeClass("active");
        });


        jQuery(".faqs ul li").on("click", function () {
            if (!jQuery(this).find("a").hasClass("active")) {
                jQuery(this).find("a").addClass("active");
                jQuery(this).siblings().find("a").removeClass("active");
            }
            else {
                jQuery(this).find("a").removeClass("active");
            }
        });

        var cmnTabLeft = jQuery(".cmn_tab .left").height();
        jQuery(".cmn_tab .right").css("height", cmnTabLeft);
        // jQuery(".tab_tr").on("click", function(event){
        // 	if (!jQuery(this).hasClass("active")){
        // 		jQuery(this).addClass("active");
        // 		jQuery(this).siblings().removeClass("active");
        // 	}
        // 	else{
        // 		jQuery(this).removeClass("active");
        // 	}
        // });

        jQuery(".nav_wrap").hover(function () {
            jQuery(".ovrly").addClass("active");
        }, function () {
            jQuery(".ovrly").removeClass("active");
        });
        var lastscroll = 0

        jQuery(window).scroll(function () {


            var scroll_top = jQuery(this).scrollTop();
            if (scroll_top > jQuery('.nav').height() && scroll_top > lastscroll) {

                jQuery('.nav').addClass("is-hidden");
                if (screen_width <= 1030) {
                    jQuery(".board_content").css("marginTop", -70);
                }
            }
            else {
                jQuery('.nav').removeClass("is-hidden");
                jQuery('.nav').css('top', 0 + 'px');
                jQuery(".board_content").css("marginTop", 0);
            }

            lastscroll = scroll_top;
            //console.log(lastscroll);
            if (scroll_top >= 50) {
                // jQuery(".board_content").css("top", 150+contInsideTitle);
            }
            if (scroll_top >= 100) {

                if (jQuery(".main").hasClass("home")) {
                    jQuery(".nav").css("top", -navHeight);
                }

                if (jQuery(".search_btn").hasClass("active")) {
                    jQuery(".search_btn").removeClass("active");
                    jQuery(".search_opn").css("height", 0);
                    jQuery(".search_opn").removeClass("active");
                    jQuery(".ovrly").removeClass("active");
                }

                jQuery(".board_content.active").css("top", 10);
            }

            if (scroll_top >= tomheight - 200) {
                if (jQuery(".main").hasClass("home")) {
                    jQuery(".nav").addClass("nav_color");
                    jQuery(".nav").addClass("nav_act_start");
                    jQuery(".nav").addClass("nav_act");
                }
            }

            if (scroll_top >= tomheight) {
                jQuery(".intro img").css("width", "100%");
                jQuery(".intro img").removeClass("zoomIn");
                jQuery(".intro img").addClass("zoomOut");
                jQuery(".mmg_app_logo span").removeClass("animated normal rotateIn");
                if (jQuery(".main").hasClass("home")) {

                    jQuery(".nav").css("position", "fixed");
                    jQuery(".nav").css("top", "0");
                }
                // jQuery(".nav").css("top",-100);
            }

            if (scroll_top >= tomheight - navHeight) {
                // jQuery(".kma_left").addClass("animated delay2s slideInLeft");
                jQuery(".kma_left .kma_left_1 h3").addClass("animated delay6s slideInLeft20");
                // jQuery(".kma_right_1").addClass("animated delay2s slideInRight");
                jQuery(".kma_right_1 h3").addClass("animated delay6s slideInRight20");
                jQuery(".kma_left .kma_left_1 h3,.kma_right_1 h3").css("opacity", 1);
                // jQuery(".kma_left,.kma_signup,.kma_right_1,.kma_right_2").addClass("animated");
            }

            if (scroll_top >= tomheight + 50) {

                // jQuery(".kma_signup").addClass("animated delay2s slideInLeft");
                jQuery(".kma_signup h3").addClass("animated delay6s slideInLeft20");
                // jQuery(".kma_right_2").addClass("animated delay2s slideInRight");
                jQuery(".kma_right_2 h3").addClass("animated delay6s slideInRight20");
                jQuery(".kma_signup h3,.kma_right_2 h3").css("opacity", 1);
            }

            if (scroll_top >= genomeHeadPos - tomheight - navHeight) {
                // jQuery(".genome_head").addClass("genome_head_act");
                // jQuery(".genome_head").css("top",100);
                // jQuery(".genome_head").css("position","fixed");
                // jQuery(".genome_test_wrapper .genome_test_done").css("marginTop",80);
            }


            if (scroll_top >= genomeHeadPos - tomheight) {
                // console.log(genomeHeadPos.top - tomheight);
                jQuery(".genome_test_wrapper .test_done_table:nth-child(1)").addClass("animated delay2s slideInRight20");
                jQuery(".genome_test_wrapper .test_done_table:nth-child(1)").css("opacity", 1);
                jQuery(".genome_test_wrapper .test_done_table:nth-child(2)").addClass("animated delay2s slideInLeft20");
                jQuery(".genome_test_wrapper .test_done_table:nth-child(2)").css("opacity", 1);
                jQuery(".genome_test_wrapper .owl-pagination").addClass("animated delay2s slideInRight20");
                jQuery(".genome_test_wrapper .owl-pagination").css("opacity", 1);
            }

            if (scroll_top >= genomeTestOther - tomheight) {
                // jQuery(".genome_test_other .left50:nth-child(1)").addClass("animated delay2s slideInLeft20");
                jQuery(".genome_test_other .left50:nth-child(1) h3").addClass("animated delay6s slideInLeft20");
                jQuery(".genome_test_other .left50:nth-child(1),.genome_test_other .left50:nth-child(1) h3").css("opacity", 1);
                // jQuery(".genome_test_other .left50:nth-child(2)").addClass("animated delay2s slideInRight20");
                jQuery(".genome_test_other .left50:nth-child(2) h3").addClass("animated delay6s slideInRight20");
                jQuery(".genome_test_other .left50:nth-child(2),.genome_test_other .left50:nth-child(2) h3").css("opacity", 1);
            }

            // if(scroll_top >= customerReviewPos - tomheight + navHeight ){
            // 	 jQuery(".genome_head").css("top",-100);

            // }

            //  if(scroll_top >= customerReviewPos - 200 ){
            // 	jQuery(".genome_head").delay(600).css("position","relative");
            // }


            if (scroll_top >= customerReviewPos) {
                // jQuery(".genome_head").removeClass("genome_head_act");
                // jQuery(".genome_head").css("top",0);
                // jQuery(".genome_test_wrapper .genome_test_done").css("marginTop",0);
            }



            if (scroll_top >= customerReviewPos - tomheight) {
                jQuery(".customer_review .test_done_table:nth-child(1),.customer_review .test_done_table:nth-child(2)").css("opacity", 1);
                jQuery(".customer_review .test_done_table:nth-child(1)").addClass("animated delay4s slideInLeft20");
                jQuery(".customer_review .test_done_table:nth-child(2)").addClass("animated delay4s slideInRight20");
            }

            if (scroll_top >= moreProductsPos - tomheight) {
                jQuery(".products_agewise .age_dial:nth-child(1)").addClass("animated delay2s slideInLeft20");
                jQuery(".products_agewise .age_dial:nth-child(2)").addClass("animated delay4s slideInLeft20");
                jQuery(".products_agewise .age_dial:nth-child(3)").addClass("animated delay6s slideInLeft20");
                jQuery(".products_agewise .age_dial:nth-child(5)").addClass("animated delay2s slideInRight20");
                jQuery(".products_agewise .age_dial:nth-child(6)").addClass("animated delay4s slideInRight20");
                jQuery(".products_agewise .age_dial:nth-child(7)").addClass("animated delay6s slideInRight20");
            }

            if (scroll_top >= blogPos - tomheight) {
                jQuery(".blog .blog_lists ul li:nth-child(1)").addClass("animated delay2s slideInRight20");
                jQuery(".blog .blog_lists ul li:nth-child(3)").addClass("animated delay2s slideInLeft20");
            }

            if (scroll_top >= mediaPos - tomheight) {
                jQuery(".media .test_done_table:nth-child(1)").addClass("animated delay2s slideInLeft20");
                jQuery(".media .test_done_table:nth-child(2)").addClass("animated delay2s slideInRight20");
            }
            if (scroll_top >= prodListTop + 18) {
                jQuery(".mobile_filter").addClass("active");
                if (jQuery(".nav").hasClass("is-hidden")) {
                    jQuery(".mobile_filter").css("top", 0);
                }
                else {
                    jQuery(".mobile_filter").css("top", 70);
                }
                if (screen_width <= 700) {
                    jQuery(".prod_list_right").css("marginTop", 52);
                }
            }

            if (screen_width > 960) {
                if (scroll_top >= prodCategory - 50) {
                    jQuery(".prod_list_left").css("position", "fixed");
                    jQuery(".prod_list_left").css("top", 80);
                }

                if (jQuery(window).scrollTop() + jQuery(window).height() > (jQuery(document).height() - (footerHeight * 3))) {
                    jQuery(".prod_list_left").css("position", "fixed");
                    jQuery(".prod_list_left").css("top", -(helpDeskHeight / 2));
                }
                if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 100) {

                    jQuery(".prod_list_left").css("top", -(helpDeskHeight - 100));
                }
            }

            if (scroll_top < prodListTop) {
                jQuery(".mobile_filter").css("top", -52);
            }
            if (scroll_top < prodListTop) {
                jQuery(".mobile_filter").removeClass("active");
                jQuery(".prod_list_right").css("marginTop", 0);
                jQuery(".mobile_filter").css("top", 0);
            }


            if (scroll_top < prodCategory) {

                jQuery(".prod_list_left").css("top", 0);
                jQuery(".prod_list_left").css("position", "relative");
            }

            // if(scroll_top < genomeHeadPos){
            // 	 jQuery(".genome_head").css("top",0);

            // }

            if (scroll_top < genomeHeadPos - 130) {
                // jQuery(".genome_head").removeClass("genome_head_act");
                // jQuery(".genome_head").css("top",0);
                // jQuery(".genome_head").css("position","relative");
                jQuery(".genome_test_wrapper .genome_test_done").css("marginTop", 0);
            }



            if (scroll_top < tomheight - 200) {

                if (jQuery(".main").hasClass("home") && screen_width > 1200) {
                    jQuery(".nav").removeClass("nav_color");
                    jQuery(".nav").removeClass("nav_act_start");
                    jQuery(".nav").removeClass("nav_act");
                }
            }


            if (scroll_top < 100) {
                jQuery(".intro img").css("width", "100%");
                jQuery(".intro img").addClass("zoomIn");
                jQuery(".intro img").removeClass("zoomOut");
                jQuery(".mmg_app_logo span").addClass("animated normal rotateIn");
                if (jQuery(".main").hasClass("home")) {
                    jQuery(".nav").css("top", "0");
                }
                // jQuery(".board_content.active").css("top", 150+contInsideTitle);
            }

            if (!jQuery(".nav").hasClass("is-hidden") && (screen_width > 1030)) {
                jQuery(".board_content").css("top", 110);
            }

            if (scroll_top < 50) {
                jQuery(".board_content").css("top", 200 + contInsideTitle);
            }



        });
    }

    jQuery(document).on("click", ".each_mini_cart_in a.remove", function () {
        deletecart(jQuery(this).attr('href'), jQuery(this));
        return false;
    });
    jQuery(document).on("click", ".addWishListItem", function () {
        ajaxWishcart(jQuery(this).attr('href'), jQuery(this));
        return false;
    });
    jQuery(document).on("click", ".addtoCartAjax", function () {
        ajaxcart(jQuery(this).attr('href'), jQuery(this));
        return false;
    });
    jQuery(document).on("keyup", ".cart-item-quantity", function (e) {
        var currentVal = parseInt(jQuery(this).val());
        if (!currentVal || currentVal == "" || currentVal == "NaN") {
            currentVal = 0;
            jQuery(".cart-item-quantity").val(currentVal);
        }
        var existingVal = parseInt(jQuery(this).attr('data-qty'));
        if (currentVal == existingVal) {
            ;
        } else {
            jQuery("." + jQuery(this).attr('id')).addClass("isQtyChanged");
        }

    });
    jQuery(document).on("keypress", ".cart-item-quantity", function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });


    jQuery(document).on("click", ".genomeItemUpdate", function () {
        if (jQuery(this).hasClass("isQtyChanged")) {
            var item_id = jQuery(this).attr('data-item-id');
            var qty = jQuery("#qinput-" + item_id).val();
            var url = jQuery(this).attr('data-link');
            ajaxUpdatecart(url, item_id, qty);
            jQuery(this).removeClass("isQtyChanged");
            return false;
        }
    });

    function ajaxUpdatecart(url, item_id, qty) {
        url += 'isAjax/1';
        url = url.replace("checkout/cart", "ajax/index");
        try {
            jQuery.ajax({
                url: url,
                data: {'item_id': item_id, 'qty': qty},
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'SUCCESS') {
                        jQuery('#minicartsection').html(data.sidebar);
                        jQuery('.cart_btn').trigger('click');
                        jQuery('#cart_qty').html(data.qty);
                        jQuery("#qinput-" + item_id).attr('data-qty', data.qty);

                    }
                    setAjaxData(data, false);
                    calculateMinicartWidth();
                }
            });
        } catch (e) {
        }
    }

    function ajaxWishcart(url, that) {
        url = url.replace("wishlist/index/add", "ajax/index/addwishlist");
        //console.log(url);
        //jQuery('.button-ajax-cart-id-'+id).parent().parent().find('.product-intification-box').css('opacity',1); 
        try {
            jQuery.ajax({
                url: url,
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'SUCCESS') {
                        if (facebook_custom_audience) {
                            if (data.productDetails) {
                                fbq('track', 'AddToWishlist', {
                                    content_name: data.productDetails['name'],
                                    content_category: data.productDetails['category'],
                                    content_ids: [data.productDetails['sku']],
                                    content_type: 'product',
                                    value: data.productDetails['price'],
                                    currency: 'USD'
                                });
                            }
                        }

                        //console.log("success");
                        if (jQuery(that).find('.trans_pt4s p').length) {
                            jQuery(that).find('p').html('In wishlist');
                        } else {
                            jQuery(that).html('In wishlist');
                        }

                    }

                }
            });
        } catch (e) {
        }
    }


    function deletecart(url, that) {
        url = url.replace("checkout/cart", "ajax/index");
        var isGood = confirm('Are you sure you would like to remove this item from your cart?');
        if (isGood) {
            try {
                jQuery.ajax({
                    url: url,
                    dataType: 'json',
                    success: function (data) {
                        setAjaxData(data, false);
						removeToCart(that.data('id'), that.data('name'), that.data('category'), that.data('price'), that.data('qty'),'');
                        //removeFromMiniCartGA(productTitle, productSKU, productCategory, productVariant, productPrice, productQty);
                    }
                });
            } catch (e) {
            }
        } else {
            return false;
        }
    }




    function ajaxcart(url, that) {
        url += 'isAjax/1';
        url = url.replace("checkout/cart", "ajax/index");
        //console.log(url);
        //jQuery('.button-ajax-cart-id-'+id).parent().parent().find('.product-intification-box').css('opacity',1); 
        try {
            jQuery.ajax({
                url: url,
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'SUCCESS') {
                        //console.log("success");



                        jQuery('#minicartsection').html(data.sidebar);
                        jQuery('.cart_btn').trigger('click');
                        jQuery('#cart_qty').html(data.qty);
                        calculateMinicartWidth();
                        jQuery(that).html('In cart');
                         if (facebook_custom_audience) {
                            if (data.productDetails) {
                                fbTriggerAddtocart(data);
								addToCart(data);
                            }
                        }
                        /*jQuery('.button-ajax-cart-id-'+id).parent().parent().find('.product-intification-box').html('<div class="cart-notification"><i class="fa fa-check"></i></div><div class="notification-message">'+ data.message +'</div>');
                         
                         jQuery('.product-intification-box').fadeIn('slow').delay(2000).fadeOut('slow', function() {
                         jQuery('.product-intification-box').css('opacity',0);
                         }); */

                    }
                    //jQuery(".button-ajax-cart-id-" + id).html('Added');
                    setAjaxData(data, false);
                }
            });
        } catch (e) {
        }
    }

    function setAjaxData(data, iframe) {
//console.log(data);
        if (data.status == 'ERROR') {
            alert(data.message);
        } else {
            jQuery('#minicartsection').html(data.sidebar);
            jQuery('#cart_qty').html(data.qty);
            calculateMinicartWidth();
            jQuery('#minicart-error-message').html('<p>' + data.message + '</p>');
            //jQuery.colorbox.close();			 					      	        
        }
    }

}
);
jQuery('document').ready(function () {
//var parenturl = '<?php echo $currentUrl?>';

    /*jQuery(document).on('click', '.wrap', function (e) {
     e.preventDefault();
     var href = jQuery(this).data('href');
     jQuery('#product_close').attr('data-href', parenturl);
     // Getting Content
     jQuery(this).addClass('active');
     getContent(href, true);
     // jQuery('.historyAPI').removeClass('active');
     
     });*/

    /* showing the global success messages */
    var MessageClose = new function () {
        this.init = function () {
            var info_message = jQuery('.messages');


            if (info_message.length) {

                if (info_message.html() == '') {
                    info_message.css('opacity', 0);
                }
                else {
                    info_message.after('<span class="mclose">X</span>');
                    info_message.css('opacity', 1);
                }
                jQuery('.mclose').on('click', function () {
                    info_message.slideUp();
                    jQuery(this).css('opacity', 0);
                });
                setTimeout(function () {
                    info_message.slideUp();
                    jQuery('.mclose').css('opacity', 0);
                }, 5000)
            }
        }

    };
    MessageClose.init();
	  jQuery('.country-btn').on('click',function(){
        var country_dropdown = jQuery('.country-dropdown');
        var ovrlay = jQuery('.ovrly');
        if(country_dropdown.hasClass('active')){
            country_dropdown.removeClass('active');
            ovrlay.removeClass('active');
        }
        else{
            country_dropdown.addClass('active')
            ovrlay.addClass('active');
        }

    });
    jQuery('.ovrly').on('click',function(){
        jQuery('.country-dropdown').removeClass('active')
    });
});



// Adding popstate event listener to handle browser back button  
window.addEventListener("popstate", function (e) {
    // console.log(history.pushState);
    if (e.state !== null) {
        //added by MJ
        if (e.state.isMine) {
            /////////
            // alert('!');
            // Get State value using e.state
            var url = location.pathname;
            //console.log('http://'+ baseurl + url.split("?")[0] + '  --  ' + parenturl + ' --  ');
            url = url.replace(/\/$/, "");
            //console.log(parenturl);
            var countslash = url.split("/");
            //console.log(countslash);
            if (countslash.length == 2) {
                window.location.href = 'http://' + baseurl + url;
            }
            else if ('http://' + baseurl + url.split("?")[0] != parenturl) {
                getContent(location.pathname, false, '');
                jQuery(".pro_close_wrapper").addClass("active");
                if (!jQuery(".prod_detail_pop").hasClass("active")) {
                    jQuery(".prod_detail_pop").addClass("active");
                }
            } else {
                jQuery(".prod_detail_pop").removeClass("active");
                //added by MJ
                jQuery(".pro_close_wrapper").removeClass("active");
                /////////////
                jQuery('#prod_content').empty();
            }
        }
    } else {
        //added by MJ
        jQuery(".prod_detail_pop").removeClass("active");
        jQuery(".pro_close_wrapper").removeClass("active");
        jQuery('#prod_content').empty();
        /////////////
    }
}, (window.history && history.pushState && history.state !== undefined) ? true : false);


function getContent(url, addEntry, that) {
    //console.log('bala'+url);
    jQuery.get(url + "?pcl=true")
            .done(function (data) {

                // Updating Content on Page
                jQuery('#prod_content').html(data);
                if (addEntry == true) {
                    // Add History Entry using pushState
                    //added by MJ
                    history.pushState({isMine: true}, null, url);
                    ///////////
                }

            });
			
				if(that) {
		var click_event = that.closest('li');
		//console.log(click_event.index());
		ga('ec:addProduct', {
    'id': click_event.data("id"),
    'name': click_event.data("name"),
    'category': click_event.data("category"),
    'position': click_event.index()+1
  });
		 ga('ec:setAction', 'click', {list: click_event.data("list")});
		 ga('send', 'event', 'Products', 'click', 'Results');
		
	}
}

function calculateMinicartWidth() {
    var screen_width = jQuery(window).width();
    if (screen_width <= 480) {
        jQuery(".each_mini_cart").css("width", 300);
        //var cartNos = parseInt(jQuery('#cart_qty').html());
        var cartNos = jQuery('.each_mini_cart').length;
        jQuery(".all_each_mini_cart_in").css("width", (cartNos * 300) + 40);
    }
}
function fbTriggerAddtocart(data) {
    fbq('track', 'AddToCart', {
        content_name: data.productDetails['name'],
        content_category: data.productDetails['category'],
        content_ids: [data.productDetails['sku']],
        content_type: 'product',
        value: data.productDetails['price'],
        currency: 'USD'
    });
}


function addToCart(product) {
  ga('ec:addProduct', {
    'id': product.productDetails['sku'],
    'name': product.productDetails['name'],
    'category': product.productDetails['category'],
    'price': product.productDetails['price'],
    'quantity': 1
  });
  ga('ec:setAction', 'add');
  ga('send', 'event', 'Cart Actions', 'click', 'add to cart');     // Send data using an event.
}

jQuery(document).on("click", ".move-to-cart", function (e) {
		e.preventDefault();
        addtoCartFromWishlist(jQuery(this).data('id'), jQuery(this).data('name'), jQuery(this).data('category'), jQuery(this).data('price'), jQuery(this).data('qty'), jQuery(this).data('href'));
        return false;
    });

function addtoCartFromWishlist(sku, name, category, price, quantity, href) {	
	  ga('ec:addProduct', {
    'id': sku,
    'name': name,
    'category': category,
    'price': price,
    'quantity': quantity
  });
  ga('ec:setAction', 'add');
   if (ga.hasOwnProperty('loaded') && ga.loaded === true) {
	  ga('send', 'event', 'Cart Actions', 'click', 'add to cart', {
      hitCallback: function() {
		document.location = href;
      }
	  }); 
	  } else {
		document.location = href;
	  }
}


jQuery(document).on("click", ".carttotriger_Ga", function (e) {
		e.preventDefault();
        removeToCart(jQuery(this).data('id'), jQuery(this).data('name'), jQuery(this).data('category'), jQuery(this).data('price'), jQuery(this).data('qty'), jQuery(this).attr('href'));
        return false;
    });

// Called when a product is removed from shopping cart.
function removeToCart(sku, name, category, price, quantity, href) {
  ga('ec:addProduct', {
     'id': sku,
    'name': name,
    'category': category,
    'price': price,
    'quantity': quantity
  });
  ga('ec:setAction', 'remove');
  if(href) {
	  if (ga.hasOwnProperty('loaded') && ga.loaded === true) {
	  ga('send', 'event', 'UX', 'click', 'remove from cart', {
      hitCallback: function() {
		document.location = href;
      }
	  }); } else {
		 document.location = href;
	  }
  } else {
  ga('send', 'event', 'UX', 'click', 'remove from cart');     // Send data using an event.
  }
}