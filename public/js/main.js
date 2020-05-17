$(document).ready(function () {
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
    var mainSlideForm = new FormData();
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
                        mainSlideForm.forEach(function (val, key) {
                            mainSlideForm.delete(key)
                        });
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
    })
});
