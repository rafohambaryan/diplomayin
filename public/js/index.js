$(document).ready(function () {
    let token = window.location.pathname.split('/')[window.location.pathname.split('/').length - 1];
    fetch(window.location.origin + '/colors/' + token, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
        },
        method: 'POST'
    }).then(response => {
        if (response.status !== 200) {
            return window.location.reload();
        }
        return response.json();
    }).then((res) => {
        $('#fullpage').fullpage({
            sectionsColor: [],
            sectionSelector: '.vertical-scrolling',
            slideSelector: '.horizontal-scrolling',
            navigation: true,
            slidesNavigation: true,
            controlArrows: false,
        });
        $(`#${res.main.section_id}`)
            .css('background', res.main.background)
            .find('*')
            .css('color', res.main.color);
        res.options.map(function (item) {
            $(`#${item.section_id}`)
                .css('background', item.background)
                .find('*')
                .css('color', item.color)
                .find('.costume-size span')
                .css('border-bottom', '2px solid ' + item.color);
        });
        new SmartPhoto(`.img_resizing`, {
            resizeStyle: 'fit',
            nav: true,
            arrows: true,
        });
        $('.app-main-content').removeClass('d-none');
        $('.loading-append-js').removeClass('loader').addClass('d-none');
    }).catch(error => {
        console.error(error);
        setTimeout(function () {
            // window.location.href = window.location.origin;
        }, 1500)
    });
});


function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}

// var red, green, blue;
// let array = [];
// for (red = 0; red <= 255; red++) {
//     for (green = 0; green <= 255; green++) {
//         for (blue = 0; blue <= 255; blue++) {
//             array.push(rgbToHex(red, green, blue))
//         }
//     }
// }
