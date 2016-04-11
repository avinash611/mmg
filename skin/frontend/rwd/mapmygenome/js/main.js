jQuery(document).ready(function () {

    var owl = jQuery("#owl-demo");
    var owl2 = jQuery("#owl-demo2");
    var owl3 = jQuery("#owl-demo3");


    owl.owlCarousel({
        navigation: false,
        slideSpeed: 400,
        paginationSpeed: 500,
        singleItem: true,
        rewindNav: false,
        afterAction: afterAction,
        afterInit: customPager,
        afterUpdate: customPager,
        transitionStyle: "fadeUp",
        autoPlay: false

    });

    jQuery(".next1").click(function () {
        owl.trigger("owl.next");
    });

    jQuery(".prev1").click(function () {
        owl.trigger("owl.prev");
    });

    function afterAction() {
        var owlLength = this.owl.owlItems.length;
        var owlCurrent = this.owl.currentItem;
        jQuery(".prev1,.next1").removeClass("disabled");
        if (owlLength == owlCurrent + 1) {
            jQuery(".next1").addClass("disabled");
        }
        if (0 == owlCurrent) {
            jQuery(".prev1").addClass("disabled");
        }
    }

    function customPager() {
        jQuery.each(this.owl.userItems, function (i) {
            var titleData = jQuery(this).attr("data-text");
            var paginationLinks = jQuery('#owl-demo .owl-controls .owl-pagination .owl-page');
            jQuery(paginationLinks[i]).append(titleData);
        });

        jQuery(".owl-next,.owl-prev").html("<span></span>");
        jQuery(".owl-next,.owl-prev").addClass("owl-nav");
    }

    owl2.owlCarousel({
        navigation: true,
        slideSpeed: 500,
        paginationSpeed: 600,
        singleItem: true,
        autoPlay: true,
        rewindNav: false,
        afterInit: owlDemo2CustomPager,
        afterUpdate: owlDemo2CustomPager,
        transitionStyle: "fade"

    });

    function owlDemo2CustomPager() {
        jQuery.each(this.owl.userItems, function (i) {
            var titleData1 = jQuery(this).find('img').attr('title');
            var paginationLinks1 = jQuery('#owl-demo2 .owl-controls .owl-pagination .owl-page span');
            jQuery(paginationLinks1[i]).append(titleData1);
        });
        jQuery(".owl-next,.owl-prev").html("<span></span>");
        jQuery(".owl-next,.owl-prev").addClass("owl-nav");
    }


    owl3.owlCarousel({
        navigation: true,
        slideSpeed: 500,
        paginationSpeed: 600,
        singleItem: true,
        autoPlay: true,
        rewindNav: true,
        afterInit: owlDemo3customPager,
        afterUpdate: owlDemo3customPager,
        transitionStyle: "fade"

    });

    function owlDemo3customPager() {
        jQuery.each(this.owl.userItems, function (i) {
            var titleData = jQuery(this).attr("data-text");
            var paginationLinks = jQuery('#owl-demo3 .owl-controls .owl-pagination .owl-page');
            jQuery(paginationLinks[i]).append(titleData);
        });

        jQuery(".owl-next,.owl-prev").html("<span></span>");
        jQuery(".owl-next,.owl-prev").addClass("owl-nav");
    }

    jQuery("#owl-demo-intro").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: true,
        rewindNav: true,
        stopOnHover: false,
        transitionStyle: "goDown"
    });


    // var a = jQuery('.intro_grad'),
    //         b = a.find(".intro_grad").first(),
    //         c = a.attr("data-color-start"),
    //         d = a.attr("data-color-end"),
    //         e = 1600;
    // a.on({
    //     mousemove: function (f) {

    //         x = f.pageX - a.offset().left, y = f.pageY - a.offset().top, xy = x + " " + y, bgWebKit = "-webkit-gradient(radial, " + xy + ", 0, " + xy + ", " + e + ", from(" + d + "), to(" + c + ")), " + c, bgMoz = "-moz-radial-gradient(" + x + "px " + y + "px 45deg, circle, " + d + " 0%, " + c + " " + e + "px)",
    //                 a.css({
    //                     background: bgWebKit
    //                 }).css({
    //             background: bgMoz
    //         })

    //     },
    //     mouseleave: function () {
    //     }
    // });
});
