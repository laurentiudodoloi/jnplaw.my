var logoImage = null;
var sizeMatching = {
    gt_1200: 1200,
    gt_992: 992,
    gt_768: 768,
    gt_576: 576,
    lt_576: 576
};

window.onresize = function (event) {
    console.log('On-resize.');
    if (logoLayouts) {
        checkLayouts(logoLayouts);
    }
};

// window.onload = function (evt) {
//     // logoImage = document.querySelector('#logo-image');
//     //
//     // checkLayouts(logoLayouts);
// }

logoImage = document.querySelector('#logo-image');

checkLayouts(logoLayouts);

function checkLayouts(layouts) {
    var matched = false;

    layouts.forEach(function (layout) {
        check = 'min-width';

        if (layout.fixed_width.includes('lt')) {
            check = 'max-width';
        } else {
            check = 'min-width';
        }

        const mediaQuery = '(' + check + ': ' + sizeMatching[layout.fixed_width] + 'px)';
        const mq = window.matchMedia(mediaQuery);

        if (mq.matches) {
            matched = true

            if (logoImage) {
                logoImage.style.width = layout.width + layout.unit
                logoImage.style.height = layout.height + layout.unit;
            }
        }
    });

    if (!matched) {
        if (logoImage) {
            logoImage.style.width = '200px';
            logoImage.style.height = '30px';
        }
    }
}
