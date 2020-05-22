// $.noConflict();
$(document).ready(function () {
    'use strict';

    function new_content_line(content = '') {
        return `<div class="row mt-2 content-line-div">

                                <div class="col-9"><textarea name="content[]" class="form-control">${content}</textarea></div>
                                <div class="col-1"><i class="material-icons delete-content-icon">delete_forever</i></div>
                            </div>`
    }

    function update_create_present_content(slide_header = '', color = '#ffffff', background = '#000000', contents = [], img = null, sub_id = 0) {
        var content_line = '';
        var isImg = '0';
        var image = '';
        var d_none = 'd-none';
        if (contents !== null) {
            if (contents.length > 0) {
                $.each(contents, function (i, item) {
                    content_line += new_content_line(item)
                })
            }
        }
        // console.log(img)
        if (img) {
            d_none = '';
            image = `<img class="update-create-image-content" src="${window.location.origin + '/uploads/img/' + img}" alt="content-img">`;
            isImg = '1';
        }

        return `<form class="update-create-present-content">
                        <input type="hidden" name="present_id" value="${$('#present_id').val()}">
                        <input type="hidden" name="main_slide_id" value="${$('#main_slide_id_id').val()}">
                        <input type="hidden" name="sub_id" value="${sub_id}">
                        <div class="form-group">
                            <label for="exampleSlideHeader"><strong>Slide Header</strong></label>
                            <input type="text" class="form-control" name="text_header" value="${slide_header}" id="exampleSlideHeader">
                        </div>
                        <div class="row mt-2 mb-4">
                            <div class="col-6">Color <input type="color" class="form-control" name="color"
                                                            value="${color}"></div>
                            <div class="col-6">Background<input type="color" class="form-control" name="background"
                                                                value="${background}"></div>
                        </div>
                        <div class="form-group add-new-content-line">
                            <label for="example_content_1">Content <i class="material-icons add-content-icon">library_add</i></label>
                            ${content_line}
                        </div>
                        <hr>
                        <label for="upload-img-content"> <i class="material-icons add-new-photo">add_a_photo</i></label>
                        <input type="file" hidden id="upload-img-content" accept=".jpg, .jpeg, .png">
                        <div class="append-new-photo">
                            <div class="delete-image-content ${d_none}">
                                <i class="material-icons delete-img-content">delete_forever</i>
                            </div>
                            ${image}
                            <input type="hidden" class="boolean-content-img" name="content-image-bool" value="${isImg}">
                        </div>
                    </form>`;
    }

    $(".sortable").sortable({
        connectWith: ".main-div-content-sub",
        placeholder: "ui-state-highlight"
    });

    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });
    checkbox.click(function () {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
    var mainSlideForm = new FormData();
    $(document).on('click', '.delete-present', function () {
        let presents_id = [];
        let isCheck = true;
        switch ($(this).attr('data-count')) {
            case 'one':
                presents_id.push($(this).parents('tr').find('.id-present').text());
                break;
            case 'all':
                let checkedPresent = $('.table-presents input[name="options[]"]:checked');
                if (checkedPresent.length !== 0) {
                    checkedPresent.map(function (i, item) {
                        presents_id.push($(item).parents('tr').find('.id-present').text());
                    })
                } else {
                    isCheck = false;
                }
                break;
        }
        if (isCheck) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    fetch(window.location.origin + '/', {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                        },
                        method: 'delete',
                        body: JSON.stringify({presents: presents_id}),
                    }).then(response => {
                        return response.json();
                    }).then((res) => {
                        if (res.success) {
                            presents_id.map(function (i) {
                                $(`#present_${i}`).remove();
                            });
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your work has been deleted',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }
                    });
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Չկա ընտրված պրեզենտացիա',
            })
        }
    });
    $(document).on('click', '.edit-present-name', function () {
        let present_id = $(this).parents('tr').find('.id-present').text();
        let present_name = $(this).parents('tr').find('.present-name');
        $.confirm({
            title: '',
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Update presentation name</label>' +
                '<input type="text" value="' + present_name.text() + '" placeholder="Your name" class="name form-control" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Save',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.name').val();
                        if (!name) {
                            $.alert('provide a required name');
                            return false;
                        }
                        fetch(window.location.origin + '/create-present/' + present_id, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                            },
                            method: 'put',
                            body: JSON.stringify({name: name}),
                        }).then(response => {
                            return response.json();
                        }).then((res) => {
                            if (res.success) {
                                present_name.text(name);
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your work has been save',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                return true;
                            }
                        });
                    }
                },
                cancel: function () {
                    //close
                },
            },
        });
    });
    $(document).on('change', '.color-main-slide', function () {
        let color = $(this).val();
        $(this).css('background-color', color);
    });
    $(document).on('change', '#main_logo', function () {
        mainSlideForm.append('logo', this.files[0]);
        $('label[for=main_logo] img').attr('src', URL.createObjectURL(this.files[0]))
    });
    $(document).on('change', '#main_present_logo', function () {
        mainSlideForm.append('present_logo', this.files[0]);
        $('label[for=main_present_logo] img').attr('src', URL.createObjectURL(this.files[0]))
    });
    $(document).on('click', '.save-main-slide', function () {
        let form = $('#main-slider-form').serializeArray();
        let isValid = true;
        $.each(form, function (i, item) {
            mainSlideForm.append(item.name, item.value);
            if (item.value.length === 0) {
                $(`input[name=${item.name}], select[name=${item.name}]`).addClass('border-error');
                isValid = false;
            } else {
                $(`input[name=${item.name}], select[name=${item.name}]`).removeClass('border-error');
            }
        });
        if (isValid) {
            let id = window.location.pathname.split('/')[window.location.pathname.split('/').length - 1];
            mainSlideForm.append('present_id', id);
            $.ajax({
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                },
                url: window.location.origin + '/setting/update',
                type: 'post',
                dataType: 'json',
                data: mainSlideForm,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success) {
                        mainSlideForm = new FormData();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been updated',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        } else {
            Swal.fire(
                'Լրացնել բոլոր դաշտերը',
                '',
                'error'
            )
        }
    });
    $(document).on('click', '.delete-present-sub', function () {
        let sub_data = $(this).parents('.main-div-content-sub');
        $.confirm({
            title: '',
            content: 'you are sure to delete?',
            buttons: {
                heyThere: {
                    btnClass: 'btn-red',
                    text: 'Deleted',
                    action: function () {
                        fetch(window.location.origin + `/setting/delete/${sub_data.attr('data-id')}`, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                            },
                            method: 'post',
                        }).then(response => {
                            return response.json();
                        }).then((res) => {
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Your work has been deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                sub_data.remove();
                            }
                        });
                        return true;
                    }
                },
                cancel: {
                    text: 'Cancel',
                }
            }
        });
    });
    $(document).on('click', '.delete-content-icon', function () {
        $(this).parents('.content-line-div').remove()
    });
    $(document).on('click', '.add-content-icon', function () {
        $(this).parents('.add-new-content-line').append(new_content_line());
    });
    $(document).on('click', '.delete-img-content', function () {
        $(this).parent().addClass('d-none');
        $(this).parents('.append-new-photo').find('img').remove();
        $('.boolean-content-img').val('0');
        mainSlideForm.delete('content-img');
    });
    $(document).on('change', '#upload-img-content', function () {
        mainSlideForm.append('content-img', this.files[0]);
        $('.append-new-photo img').remove();
        $('.append-new-photo').append(`<img class="update-create-image-content" src="${URL.createObjectURL(this.files[0])}" alt="content-img">`);
        $('.delete-image-content').removeClass('d-none');
        $('.boolean-content-img').val('1');
    });
    $(document).on('click', '.add-new-sub-content', function () {
        $.confirm({
            title: 'Create New',
            useBootstrap: false,
            boxWidth: '90%',
            content: update_create_present_content(),
            buttons: {
                deleteUser: {
                    text: 'Save',
                    btnClass: 'btn-green',
                    action: function () {
                        var form = this.$content.find('.update-create-present-content').serializeArray();
                        let valid = true;
                        let _this = this.$content;
                        mainSlideForm.append('content', null);
                        $.each(form, function (i, item) {
                            if (item.name === 'content[]' && item.value.length === 0) {
                                return true;
                            } else {
                                mainSlideForm.append(item.name, item.value);
                            }
                            if (item.name === 'text_header' && item.value.length === 0) {
                                valid = false;
                                _this.find('input[name=text_header]').addClass('border-error');
                            }
                        });

                        if (valid) {
                            $.ajax({
                                headers: {
                                    "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                                },
                                url: window.location.origin + '/setting/update-create',
                                type: 'post',
                                dataType: 'json',
                                data: mainSlideForm,
                                contentType: false,
                                processData: false,
                                success: function (res) {
                                    if (res.success) {
                                        mainSlideForm = new FormData();
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Your work has been saved',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        setTimeout(function () {
                                            window.location.reload();
                                        }, 1400);
                                    }
                                }
                            });
                            return true;
                        } else {
                            return false;
                        }
                    }
                },
                cancel: function () {
                    return true;
                }
            }
        });
    });
    $(document).on('click', '.update-head-line', function () {
        let sub_id = $(this).parents('.main-div-content-sub').attr('data-id');
        let dataHtml = $(this).parents('.main-div-content-sub');
        fetch(window.location.origin + `/setting/get/${sub_id}`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
            },
            method: 'post',
        }).then(response => {
            return response.json();
        }).then((res) => {
            if (res.success && res.data.success) {
                $.confirm({
                    title: 'Update',
                    useBootstrap: false,
                    boxWidth: '90%',
                    content: update_create_present_content(res.data.text_header, res.data.color, res.data.background, res.data.content, res.data.img, sub_id),
                    buttons: {
                        deleteUser: {
                            text: 'Save',
                            btnClass: 'btn-green',
                            action: function () {
                                var form = this.$content.find('.update-create-present-content').serializeArray();
                                let valid = true;
                                let _this = this.$content;
                                mainSlideForm.append('content', null);
                                $.each(form, function (i, item) {
                                    if (item.name === 'content[]' && item.value.length === 0) {
                                        return true;
                                    } else {
                                        mainSlideForm.append(item.name, item.value);
                                    }
                                    if (item.name === 'text_header' && item.value.length === 0) {
                                        valid = false;
                                        _this.find('input[name=text_header]').addClass('border-error');
                                    }
                                });

                                if (valid) {
                                    $.ajax({
                                        headers: {
                                            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                                        },
                                        url: window.location.origin + '/setting/update-create',
                                        type: 'post',
                                        dataType: 'json',
                                        data: mainSlideForm,
                                        contentType: false,
                                        processData: false,
                                        success: function (res) {
                                            if (res.success) {
                                                dataHtml.find('.text_header').text(res.data.text_header);
                                                mainSlideForm = new FormData();
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Your work has been saved',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            }
                                        }
                                    });
                                    return true
                                }
                                return false;
                            }
                        },
                        cancel: function () {
                            return true;
                        }
                    }
                });
            }
        });
    });
    $(document).on('click', '.add-sub-many', function () {
        let sub_id = $(this).parents('.main-div-content-sub').attr('data-id');
        let dataHtml = $(this).parents('.main-div-content-sub');

        $.confirm({
            title: 'Create slide ' + dataHtml.find('.text_header').text(),
            useBootstrap: false,
            boxWidth: '90%',
            content: update_create_present_content('', '#ffffff', '#000000', [], null, sub_id),
            buttons: {
                deleteUser: {
                    text: 'Save',
                    btnClass: 'btn-green',
                    action: function () {
                        var form = this.$content.find('.update-create-present-content').serializeArray();
                        let valid = true;
                        let _this = this.$content;
                        mainSlideForm.append('content', null);
                        $.each(form, function (i, item) {
                            if (item.name === 'content[]' && item.value.length === 0) {
                                return true;
                            } else {
                                mainSlideForm.append(item.name, item.value);
                            }
                            if (item.name === 'text_header' && item.value.length === 0) {
                                valid = false;
                                _this.find('input[name=text_header]').addClass('border-error');
                            }
                        });

                        if (valid) {
                            mainSlideForm.append('sub_many', '1');
                            $.ajax({
                                headers: {
                                    "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                                },
                                url: window.location.origin + '/setting/update-create',
                                type: 'post',
                                dataType: 'json',
                                data: mainSlideForm,
                                contentType: false,
                                processData: false,
                                success: function (res) {
                                    if (res.success) {
                                        mainSlideForm = new FormData();
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Your work has been saved',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        dataHtml.find('.append-many-slider-count i').remove();
                                        let count = res.data.count;
                                        if (count > 0) {
                                            if (count > 9) {
                                                dataHtml.find('.append-many-slider-count').append(`<i class="material-icons ml-4 active-sub-many-get-data">filter_9_plus</i>`);
                                            } else {
                                                dataHtml.find('.append-many-slider-count').append(`<i class="material-icons ml-4 active-sub-many-get-data">filter_${count}</i>`);
                                            }
                                        } else {
                                            dataHtml.find('.append-many-slider-count').append(`<i class="material-icons ml-4">filter</i>`);
                                        }
                                    }
                                },
                                error: function () {
                                    mainSlideForm = new FormData();
                                }
                            });
                            return true
                        }
                        return false;
                    }
                },
                cancel: function () {
                    return true;
                }
            }
        });

    });

    $(document).on('click', '.active-sub-many-get-data', function () {
        let sub_id = $(this).parents('.main-div-content-sub').attr('data-id');
        let dataHtml = $(this).parents('.main-div-content-sub');
        let present_id = $('#present_id').val();
        let main_slide_id = $('#main_slide_id_id').val();
        fetch(window.location.origin + `/setting/get-sub/${sub_id}`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
            },
            body: JSON.stringify({present_id: present_id, main_slide_id: main_slide_id}),
            method: 'post',
        }).then(response => {
            return response.json();
        }).then((res) => {
            if (res.success) {
                let data = res.data;
                let contentHtml = '';
                $.each(data, function (i, item) {
                    contentHtml += `<div class="card mt-2 main-div-content-sub" data-id="${item.id}" data-parent-id="${sub_id}">
                                        <div class="card-body">
                                            <h5 class="card-title text_header">${item.text_header}</h5>
                                            <a class="update-head-line-sub"><i class="material-icons">mode_edit</i></a>
                                            <a class="ml-4 icon-delete delete-subheading-many"><i class="material-icons">delete_forever</i></a>
                                        </div>
                                    </div> `;
                });
                $.confirm({
                    title: '',
                    useBootstrap: false,
                    smoothContent: true,
                    boxWidth: '95%',
                    content: `<div class="container">
                                    <h2 class="mb-3">${dataHtml.find('.text_header').text()}</h2>
                                 <div class="sortable-no">${contentHtml}</div>
                               </div>`,
                    buttons: {
                        cancel: function () {
                            dataHtml.find('.append-many-slider-count i').remove();
                            let data = this.$content.find('.sortable-no .main-div-content-sub');
                            let filter_count = data.length;
                            if (filter_count > 0) {
                                if (filter_count > 9) {
                                    dataHtml.find('.append-many-slider-count').append(`<i class="material-icons ml-4 active-sub-many-get-data">filter_9_plus</i>`);
                                } else {
                                    dataHtml.find('.append-many-slider-count').append(`<i class="material-icons ml-4 active-sub-many-get-data">filter_${filter_count}</i>`);
                                }
                            } else {
                                dataHtml.find('.append-many-slider-count').append(`<i class="material-icons ml-4">filter</i>`);
                            }
                            return true;
                        }
                    }
                });
            }
        });


    });

    $(document).on('click', '.update-head-line-sub', function () {
        let content = $(this).parents('.main-div-content-sub');
        let sub_many_id = content.attr('data-id');
        let sub_id = content.attr('data-parent-id');
        let present_id = $('#present_id').val();
        let main_slide_id = $('#main_slide_id_id').val();
        fetch(window.location.origin + `/setting/get-sub/${sub_id}`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
            },
            body: JSON.stringify({present_id: present_id, main_slide_id: main_slide_id, find: sub_many_id}),
            method: 'post',
        }).then(response => {
            return response.json();
        }).then((res) => {
            if (res.success) {
                $.confirm({
                    title: 'Update',
                    useBootstrap: false,
                    boxWidth: '80%',
                    content: update_create_present_content(res.data.text_header, res.data.color, res.data.background, JSON.parse(res.data.content.content), res.data.content.img),
                    buttons: {
                        deleteUser: {
                            text: 'Save',
                            btnClass: 'btn-green',
                            action: function () {
                                var form = this.$content.find('.update-create-present-content').serializeArray();
                                let valid = true;
                                let _this = this.$content;
                                mainSlideForm.append('content', null);
                                $.each(form, function (i, item) {
                                    if (item.name === 'content[]' && item.value.length === 0) {
                                        return true;
                                    } else {
                                        mainSlideForm.append(item.name, item.value);
                                    }
                                    if (item.name === 'text_header' && item.value.length === 0) {
                                        valid = false;
                                        _this.find('input[name=text_header]').addClass('border-error');
                                    }
                                });

                                if (valid) {
                                    $.ajax({
                                        headers: {
                                            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                                        },
                                        url: window.location.origin + '/setting/sub-many-update/' + sub_many_id,
                                        type: 'post',
                                        dataType: 'json',
                                        data: mainSlideForm,
                                        contentType: false,
                                        processData: false,
                                        success: function (res) {
                                            if (res.success) {
                                                content.find('.text_header').text(res.data.text_header);
                                                mainSlideForm = new FormData();
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Your work has been saved',
                                                    showConfirmButton: false,
                                                    timer: 1000
                                                });
                                            }
                                        },
                                        error: function () {
                                            mainSlideForm = new FormData();
                                        }
                                    });
                                    return true
                                }
                                return false;
                            }
                        },
                        cancel: function () {
                            mainSlideForm = new FormData();
                            return true;
                        }
                    }
                });


            }
        });


    });
    $(document).on('click', '.delete-subheading-many', function () {
        let sub_data = $(this).parents('.main-div-content-sub');
        $.confirm({
            title: '',
            content: 'you are sure to delete?',
            buttons: {
                heyThere: {
                    btnClass: 'btn-red',
                    text: 'Deleted',
                    action: function () {
                        fetch(window.location.origin + `/setting/get-sub/${sub_data.attr('data-id')}`, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
                            },
                            body: JSON.stringify({
                                present_id: $('#present_id').val(),
                                main_slide_id: $('#main_slide_id_id').val()
                            }),
                            method: 'delete',
                        }).then(response => {
                            return response.json();
                        }).then((res) => {
                            if (res.success) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer);
                                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                                    }
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Signed in successfully'
                                });
                                sub_data.remove();
                            }
                        });
                        return true;
                    }
                },
                cancelBtn: {
                    text: 'Cancel',
                    action: function () {
                        return true;
                    }
                }
            }
        });


    })
});
