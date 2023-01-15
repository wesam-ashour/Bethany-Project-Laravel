$(function () {
    const
        app_url = $('#app_url').val(),
        title = $('#title').val(),
        location = $('#location').val(),
        description = $("#description").val(),
        lat = $("#lat").val(),
        long = $("#long").val(),
        uniqid = $("#uniqid").val();

    $(document).ready(function () {

        create_user();

    });


    function create_user() {
        "use strict";
        var KTUsersAddUser = function () {
            const t = document.getElementById("kt_modal_add_user"), e = t.querySelector("#kt_modal_add_user_form"),
                n = new bootstrap.Modal(t);
            return {
                init: function () {
                    (() => {
                        var o = FormValidation.formValidation(e, {
                            fields: {
                                title: {
                                    validators: {}
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
                        const i = t.querySelector('[data-kt-users-modal-action="submit"]');
                        i.addEventListener("click", (t => {
                            $(':input[type="submit"]').prop('disabled', true);
                            t.preventDefault(), o && o.validate().then((function (t) {
                                $(".errors").html("");

                                var featured_image = $('#fileupload')[0].files[0];
                                var formData = new FormData(document.getElementById("kt_modal_add_user_form"));
                                formData.append("image", featured_image);

                                console.log("validated!"), "Valid" == t ?
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "POST",
                                        "url": base_path + language + "/" + "tourists",
                                        data: formData,
                                        processData: false,  // tell jQuery not to process the data
                                        contentType: false,
                                        success: function (response) {
                                            if ($.isEmptyObject(response.error)) {
                                                $(':input[type="submit"]').prop('disabled', false);
                                                (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0, setTimeout((function () {
                                                    i.removeAttribute("data-kt-indicator"), i.disabled = !1, Swal.fire({
                                                        text: language === "en" ? "Form has been successfully submitted!" : "تم تقديم النموذج بنجاح!",
                                                        icon: "success",
                                                        buttonsStyling: !1,
                                                        confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                                        customClass: {confirmButton: "btn btn-primary"}
                                                    }).then((function (t) {
                                                        e.reset();
                                                        $("#file-chosen").html(language === "en" ? "No file chosen" : " لم يتم اختيار ملف");
                                                        $('#image_id').remove();
                                                        $(".containerss").append("<div id='image_div'></div>");
                                                        t.isConfirmed && n.hide()
                                                    }))
                                                }), 2e3));
                                                $("input").val("");
                                                $(".errors").html("");
                                                $('#kt_ecommerce_forms_table').DataTable().ajax.reload();
                                            } else {
                                                Swal.fire({
                                                    text: language === "en" ? "Sorry, looks like there are some errors detected, please try again." : "معذرة ، يبدو أنه تم اكتشاف بعض الأخطاء ، يرجى المحاولة مرة أخرى.",
                                                    icon: "error",
                                                    buttonsStyling: !1,
                                                    confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                                    customClass: {confirmButton: "btn btn-primary"}
                                                })
                                                $(':input[type="submit"]').prop('disabled', false);
                                                $(".errors").html("");
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
                        })), t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: language === "en" ? "Are you sure you would like to cancel?" : "هل أنت متأكد أنك تريد الإلغاء؟",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: language === "en" ? "Yes, cancel it!" : "نعم ، قم بإلغائها!",
                                cancelButtonText: language === "en" ? "No, return" : "لا رجوع",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(), $(".errors").empty(), $('#image_id').remove(), $(".containerss").append("<div id='image_div'></div>"), $("#file-chosen").html(language === "en" ? "No file chosen" : " لم يتم اختيار ملف"), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: language === "en" ? "Your form has not been cancelled!." : "لم يتم إلغاء النموذج الخاص بك !.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                })
                            }))
                        })), t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: language === "en" ? "Are you sure you would like to cancel?" : "هل أنت متأكد أنك تريد الإلغاء؟",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: language === "en" ? "Yes, cancel it!" : "نعم ، قم بإلغائها!",
                                cancelButtonText: language === "en" ? "No, return" : "لا رجوع",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(), $(".errors").empty(), $('#image_id').remove(), $(".containerss").append("<div id='image_div'></div>") , $("#file-chosen").html(language === "en" ? "No file chosen" : " لم يتم اختيار ملف"), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: language === "en" ? "Your form has not been cancelled!." : "لم يتم إلغاء النموذج الخاص بك !.",
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
            KTUsersAddUser.init()
        }));
    }


    function print_error(errors) {
        $.each(errors, function (index, val) {
            $("#" + index + "_error").html(val);
            $("#" + index).focus();
        });
    }
});

