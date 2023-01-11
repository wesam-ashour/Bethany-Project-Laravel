$(function () {
    const language = $('#language').val(),
        add_user_form = $("#kt_modal_edit_user_form"),
        submit_button = document.getElementById('kt_modal_update_user_submit'),
        discard_button = document.getElementById('kt_modal_update_user_submit'),
        id = $('#admin_id').val(),
        name = $('#name').val(),
        mobile = $('#mobile').val(),
        email = $("#email").val(),
        user_name = $("#user_name").val(),
        address = $("#address").val(),
        password = $("#password").val(),
        uploaded_image = $("#uploaded_image"),
        roles = $("#roles").val();

    $(document).ready(function () {
        /*Table Actions*/
        update_user();
    });

    function role_radio() {
        radio_roles.click(function () {
            role_id = $(this).data("id");
            role_name = $(this).data("name");
        });
    }

    function update_user() {
        submit_button.addEventListener('click', function () {
            $(".errors").html("");
            let user_image = prepare_image_base64(uploaded_image.css('background-image'));
            if (user_image == "none") {
                user_image = "";
            }
            // var formDatas = new FormData(document.getElementById("kt_modal_edit_user_only"));
            // formDatas.append('fileupload', $('input[type=file]')[0].files[0]);
            // type: "post",
            //     url: base_path + "admins/" + $("#admin_id").val(),
            //     data: formDatas,
            //     processData: false,  // tell jQuery not to process the data
            //     contentType: false,
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "PUT",
                url: base_path + language + "/admins/" + $("#admin_id").val(),
                data: {
                    id: $('#admin_id').val(),
                    name: $('#name').val(),
                    mobile: $('#mobile').val(),
                    email: $("#email").val(),
                    user_name: $("#user_name").val(),
                    address: $("#address").val(),
                    password: $("#password").val(),
                    status: $("#status").val(),
                    roles: $("#roles").val(),
                    image: user_image,
                },
                success: function (response) {
                    if ($.isEmptyObject(response.error)) {
                        success_submit();
                        $(".errors").html("");
                    } else {
                        console.log(response)
                        failed_submit(response.error);
                    }
                }
            })
        })
    }


    function success_submit() {
        //Success Submit
        $(".errors").html("");
        add_user_form.attr("data-kt-redirect", base_path + "admins");
        (submit_button.setAttribute("data-kt-indicator", "on"), submit_button.disabled = !0, setTimeout((function () {
            submit_button.removeAttribute("data-kt-indicator"), Swal.fire({
                text: language === "en" ? "Form has been successfully submitted!" : "تم تقديم النموذج بنجاح!",
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                customClass: {confirmButton: "btn btn-primary"}
            }).then((function (e) {
                e.isConfirmed && redirect();
            }))
            submit_button.disabled = !1
        }), 1000));//2e3 == 1000

    }

    function failed_submit(errors) {
        //Failed Submit
        $(".errors").html("");
        (submit_button.setAttribute("data-kt-indicator", "on"), submit_button.disabled = !0, setTimeout((function () {
            submit_button.removeAttribute("data-kt-indicator"), Swal.fire({
                text: language === "en" ? "Sorry, looks like there are some errors detected, please try again." : "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى.",
                icon: "error",
                buttonsStyling: !1,
                confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                customClass: {confirmButton: "btn btn-primary"}
            })
            submit_button.disabled = !1
            print_error(errors);
        }), 1000));
    }

    function prepare_image_base64(image) {
        image = image.replace('url("data:image/jpeg;base64,', '');
        image = image.replace('url("data:image/jpeg;base64,', '');
        image = image.replace('url("data:image/png;base64,', '');
        image = image.replace('url("data:image/jpg;base64,', '');
        image = image.replace('")', '');
        if (image == "none") {
            return "";
        } else
            return image;
    }

    function image_update() {
        image_file_input.on('change', function (ev) {
            image_updated = 1;
        });
    }

    function print_error(errors) {
        console.log(errors)
        $.each(errors, function (index, val) {
            $("#" + index + "_error").html(val);
            $("#" + index).focus();
        });
    }
});

