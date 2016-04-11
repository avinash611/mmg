Checkout.prototype.gotoSection = function (section, reloadProgressBlock) {

// Adds class so that the page can be styled to only show the "Checkout Method" step
    if ((this.currentStep == 'login' || this.currentStep == 'billing') && section == 'billing') {
        $j('body').addClass('opc-has-progressed-from-login');
    }

    if (reloadProgressBlock) {
        this.reloadProgressBlock(this.currentStep);
    }
    this.currentStep = section;
    var sectionElement = $('opc-' + section);
    sectionElement.addClassName('allow');
    this.accordion.openSection('opc-' + section);
    //console.log(this.currentStep);
    switch (this.currentStep)
    {
        case 'payment':
            ga('ec:setAction', 'checkout', {
                'step': 4
            });
            ga('send', 'pageview', 'checkout/onepage/shipping-method');
            break;
        case 'review':
            ga('ec:setAction', 'checkout', {
                'step': 5,
                'option': jQuery('input[name="payment[method]"]:checked').val()
            });
            ga('send', 'pageview', 'checkout/onepage/payment-method');
            ga('send', 'event', 'Checkout Process', 'Payment Stage', {
                hitCallback: function () {
                    // Advance to review page.
                }
            });
            break;
        default:
            break;
    }



// Scroll viewport to top of checkout steps for smaller viewports
    if (Modernizr.mq('(max-width: ' + bp.xsmall + 'px)')) {
        $j('html,body').animate({scrollTop: $j('#checkoutSteps').offset().top}, 800);
    }

    if (!reloadProgressBlock) {
        this.resetPreviousSteps();
    }
}
