$(function () {
    const app_url = $('#app_url').val(),
        title = $('#title').val(),
        location = $('#location').val(),
        description = $("#description").val(),
        lat = $("#lat").val(),
        long = $("#long").val(),
        uniqid = $("#uniqid").val(),
        language = $("#language").val();

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
                                title: {
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
                                $("#file-chosens").html(language === "en" ? "No file chosen" : " لم يتم اختيار ملف");
                                $('#image_id_u').remove();
                                $( ".containers" ).append( "<div id='image_div_u'></div>" );
                                $( ".errors" ).empty(),
                                t.value && n.hide();
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
                                t.value ? (e.reset(),$( ".errors" ).empty(),$('#image_id_u').remove(),$( ".containers" ).append( "<div id='image_div_u'></div>" ),$("#file-chosens").html(language === "en" ? "No file chosen" : " لم يتم اختيار ملف"), n.hide()) : "cancel" === t.dismiss && Swal.fire({
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
                                $( ".errors" ).empty();
                                var formDatas = new FormData(document.getElementById("kt_modal_edit_user_form"));
                                formDatas.append('_method', 'put');
                                console.log("validated!"), "Valid" == t ?
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "POST",
                                        url: base_path + language  + "/" + "users/" + $("#user_id").val(),
                                        data: formDatas,
                                        processData: false,  // tell jQuery not to process the data
                                        contentType: false,
                                        success: function (response) {
                                            console.log(response["error"])
                                            if ($.isEmptyObject(response.error)) {
                                                (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0, setTimeout((function () {
                                                    $('#image_id_u').remove();
                                                    $( ".containers" ).append( "<div id='image_div_u'></div>" );
                                                    i.removeAttribute("data-kt-indicator"), i.disabled = !1,
                                                        Swal.fire({
                                                            text: language === "en" ? "Form has been successfully submitted!" : "تم تقديم النموذج بنجاح!",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                                                            customClass: {confirmButton: "btn btn-primary"}
                                                        }).then((function (t) {
                                                            $('#events_edit').val(null).trigger('change'),
                                                            $( ".errors" ).empty(),
                                                            t.isConfirmed && n.hide();
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
            $("#" + index + "_error").html(val);
            $("#" + index).focus();
        });
    }

});

