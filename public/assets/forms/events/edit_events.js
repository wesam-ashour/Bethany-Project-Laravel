$(function () {
    const language = $( "#language" ).val(),
        title_en = $('#title_en').val(),
        title_ar = $('#title_ar').val(),
        address_en = $('#address_en').val(),
        address_ar = $('#address_ar').val(),
        description_en = $("#description_en").val(),
        description_ar = $("#description_ar").val(),
        date = $('#kt_datepicker_6').val(),
        time = $('#time').val(),
        fileupload = $('#fileupload'),
        default_latitude = $("#default_latitude").val(),
        default_longitude = $("#default_longitude").val();

    $(document).ready(function () {
        update_event();
    });


    function update_event() {
        "use strict";
        var KTUsersUpdatePermission = function () {
            const t = document.getElementById("kt_modal_edit_event"),
                e = t.querySelector("#kt_modal_update_event_form"), n = new bootstrap.Modal(t);
            return {
                init: function () {
                    (() => {
                        var o = FormValidation.formValidation(e, {
                            fields: {
                                title_en_edit: {
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
                                $( ".errors" ).empty();
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
                                t.value ? (e.reset(),$( ".errors" ).empty(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: language === "en" ? "Your form has not been cancelled!." : "لم يتم إلغاء النموذج الخاص بك !.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                })
                            }))
                        }));
                        const i = t.querySelector('[data-kt-permissions-modal-action="submit"]');
                        i.addEventListener("click", (function (t) {
                            t.preventDefault(), o && o.validate().then((function (t) {
                                $( ".errors" ).empty()
                                var featured_images =$('#fileuploads')[0].files[0];
                                var formDatas = new FormData(document.getElementById("kt_modal_update_event_form"));
                                formDatas.append("image", featured_images);
                                formDatas.append('_method', 'put');
                                console.log("validated!"), "Valid" == t ?
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "post",
                                        url: base_path + language + "/events/" + $("#event_id").val(),
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
                                                            $( ".errors" ).empty()
                                                            t.isConfirmed && n.hide()
                                                        }))
                                                }), 2e3));
                                                $('#kt_ecommerce_forms_table').DataTable().ajax.reload();
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

