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
        uploaded_image = $(" #uploaded_image"),
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
                url: base_path + language+  "/admins/" + $("#admin_id").val(),
                data: {
                    id : $('#admin_id').val(),
                    name : $('#name').val(),
                    mobile : $('#mobile').val(),
                    email : $("#email").val(),
                    user_name : $("#user_name").val(),
                    address : $("#address").val(),
                    password : $("#password").val(),
                    status : $("#status").val(),
                    roles : $("#roles").val(),
                    image :user_image,
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

    /*function discard_update() {
        discard_button.addEventListener("click", function () {
            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
            }).then((function (t) {
                t.value ? (e.reset(), n.hide()) : "cancel" === (window.location.href = app_url + "/admin/users") && Swal.fire({
                    text: "Your form has not been cancelled!.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {confirmButton: "btn btn-primary"}
                })
            }))
        })
    }*/

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
                window.location.href = base_path + language+  "/admins/";
                e.isConfirmed
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



$(function () {
    const app_url = $('#app_url').val(),
        name = $('#name').val(),
        mobile = $('#mobile').val(),
        email = $("#email").val(),
        user_name = $("#user_name").val(),
        address = $("#address").val(),
        password = $("#password").val();
    roles = $("#roles").val();

    $(document).ready(function () {
        update_event();
    });


    function update_event() {
        "use strict";
        var KTUsersUpdatePermission = function () {
            const t = document.getElementById("kt_modal_edit_user"),
                e = t.querySelector("#kt_modal_edit_user_form"), n = new bootstrap.Modal(t);
            return {
                init: function () {
                    (() => {
                        var o = FormValidation.formValidation(e, {
                            fields: {
                                name: {
                                    validators: {
                                    }
                                }
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger,
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: ".fv-row",
                                    eleInvalidClass: "",
                                    eleValidClass: ""
                                })
                            }
                        });
                        t.querySelector('[data-kt-permissions-modal-action="close"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: language === "en" ? "Are you sure you would like to close?" : "هل أنت متأكد أنك تريد الإغلاق؟",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: language === "en" ? "Yes, close it!" : "نعم ، أغلقه!",
                                cancelButtonText: language === "en" ? "No, return" : "لا رجوع",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value && n.hide()
                            }))
                        })), t.querySelector('[data-kt-permissions-modal-action="cancel"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: language === "en" ? "Are you sure you would like to cancel?" : "هل أنت متأكد أنك تريد الإلغاء؟",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: language === "en" ? "Yes, cancel it!" : "نعم ، قم بإلغائها!",
                                cancelButtonText: language === "en" ? "No, return" : "لا رجوع",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: language === "en" ? "Your form has not been cancelled!." : "لم يتم إلغاء النموذج الخاص بك !.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                })
                            }))
                        }));
                        const i = t.querySelector('[kt_modal_update_user_submit="submit"]');
                        i.addEventListener("click", (function (t) {
                            t.preventDefault(), o && o.validate().then((function (t) {
                                var formDatas = new FormData(document.getElementById("kt_modal_edit_user_form"));
                                formDatas.append('_method', 'put');
                                console.log("validated!"), "Valid" == t ?
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "post",
                                        url: base_path + "admins/" + $("#admin_id").val(),
                                        data: formDatas,
                                        processData: false,  // tell jQuery not to process the data
                                        contentType: false,
                                        success: function (response) {
                                            console.log(response["error"])
                                            if ($.isEmptyObject(response.error)) {
                                                (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0, setTimeout((function () {
                                                    i.removeAttribute("data-kt-indicator"), i.disabled = !1,
                                                        Swal.fire({
                                                            text: language === "en" ? "Form has been successfully submitted!" : "تم تقديم النموذج بنجاح!",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                                            customClass: {confirmButton: "btn btn-primary"}
                                                        }).then((function (t) {
                                                            t.isConfirmed && n.hide()
                                                        }))
                                                }), 2e3));
                                                // $('#kt_modal_edit_user_form').reload();
                                            } else {
                                                // Swal.fire({
                                                //     text: "Sorry, looks like there are some errors detected, please try again.",
                                                //     icon: "error",
                                                //     buttonsStyling: !1,
                                                //     confirmButtonText: "Ok, got it!",
                                                //     customClass: {confirmButton: "btn btn-primary"}
                                                // })
                                                print_error(response.error);
                                            }
                                        }
                                    })
                                    : Swal.fire({
                                        text: language === "en" ? "Sorry, looks like there are some errors detected, please try again." : "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    })
                            }))
                        }))
                    })()
                }
            }
        }();
        KTUtil.onDOMContentLoaded((function () {
            KTUsersUpdatePermission.init()
        }));
    }

    function print_error(errors) {
        $.each(errors, function (index, val) {
            $("#" + index + "_update_error").html(val);
            $("#" + index).focus();
        });
    }

});

