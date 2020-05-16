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

        $('.app-main-content').removeClass('d-none');
        $('.loading-append-js').removeClass('loader').addClass('d-none');
    }).catch(error => {
        console.error(error);
        setTimeout(function () {
            window.location.href = window.location.origin;
        }, 1500)
    });
});
