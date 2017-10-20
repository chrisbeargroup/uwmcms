/**
 * @file
 * Custom global JavaScript for UW CHEW.
 */


/**
 * Open dropdown menus on hover.
 */
Drupal.behaviors.uwmedTestBehavior = {
    attach: function (context, settings) {
        // Using once() to apply the myCustomBehaviour effect when you want to do just run one function.
        $('input.myCustomBehavior', context).once('myCustomBehavior').addClass('processed');

        // Using once() with more complexity.
        $('input.myCustom', context).once('mySecondBehavior').each(function () {
            if ($(this).visible()) {
                $(this).css('background', 'green');
            }
            else {
                $(this).css('background', 'yellow').show();
            }
        });
    }
};
