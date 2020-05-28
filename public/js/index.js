$(document).ready(function () {
    function hexToRGBA(hex, opacity) {
        return 'rgba(' + (hex = hex.replace('#', '')).match(new RegExp('(.{' + hex.length/3 + '})', 'g')).map(function(l) { return parseInt(hex.length%2 ? l+l : l, 16) }).concat(opacity||1).join(',') + ')';
    }
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
            keyboardScrolling: true,
            animateAnchor: true,
            recordHistory: true,
            sectionSelector: '.vertical-scrolling',
            slideSelector: '.horizontal-scrolling',
            navigation: true,
            slidesNavigation: true,
            controlArrows: false,
        });
        $('#fp-nav ul li a span, .fp-slidesNav ul li a span').css({
            background:'rgba(0,0,0,0.6)'
        })
        $(`#${res.main.section_id}`)
            .css({
                'background': res.main.background,
                'background-image': `linear-gradient(to bottom right, ${res.main.background},  ${hexToRGBA('#d5fffc',0.2)},  ${hexToRGBA('#d5fffc',0.5)}, ${hexToRGBA('#ffffff',0.7)} ,${hexToRGBA('#ffffff',0.99)})`
            })
            .find('*')
            .css('color', res.main.color);
        res.options.map(function (item) {
            var sections = $(`#${item.section_id}`);
            if (sections.attr('class') === 'presentacion-contents') {
                sections = sections.parents('section')
            }
            sections
                .css({
                    'background': item.background,
                    'background-image': `linear-gradient(to bottom right, ${item.background},  ${hexToRGBA('#d5fffc',0.2)},  ${hexToRGBA('#d5fffc',0.5)}, ${hexToRGBA('#ffffff',0.7)} ,${hexToRGBA('#ffffff',0.99)})`
                })
                .find('*')
                .css('color', item.color)
                .find('.costume-size span')
                .css('border-bottom', '2px solid ' + item.color);

        });
        $('.app-main-content').removeClass('d-none');
        $('.loading-append-js').removeClass('loader').addClass('d-none');
    }).catch(error => {
        console.error(error);
        setTimeout(function () {
            window.location.href = window.location.origin;
        }, 1500)
    });
    new SmartPhoto(`.img_resizing`, {
        resizeStyle: 'fit',
        nav: true,
        arrows: true,
    });
});
