$(function () {
    const
        question = $('#question').val(),
        answer = $('#answer').val();


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
                                question: {
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
                        const i = t.querySelector('[data-kt-users-modal-action="submit"]');
                        i.addEventListener("click", (t => {
                            t.preventDefault(), o && o.validate().then((function (t) {
                                $(".errors").html("");

                                var formData = new FormData(document.getElementById("kt_modal_add_user_form"));

                                console.log("validated!"), "Valid" == t ?
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "POST",
                                        "url": base_path + language + "/faq",
                                        data: formData,
                                        processData: false,  // tell jQuery not to process the data
                                        contentType: false,
                                        success: function (response) {
                                            if ($.isEmptyObject(response.error)) {
                                                (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0, setTimeout((function () {
                                                    i.removeAttribute("data-kt-indicator"), i.disabled = !1, Swal.fire({
                                                        text: language === "en" ? "Form has been successfully submitted!" : "???? ?????????? ?????????????? ??????????!",
                                                        icon: "success",
                                                        buttonsStyling: !1,
                                                        confirmButtonText: language === "en" ? "Ok, got it!" : "?????????? ?? ????????!",
                                                        customClass: {confirmButton: "btn btn-primary"}
                                                    }).then((function (t) {
                                                        t.isConfirmed && n.hide()
                                                    }))
                                                }), 2e3));
                                                e.reset();
                                                $("input").val("");
                                                $(".errors").html("");
                                                $('#kt_ecommerce_forms_table').DataTable().ajax.reload();
                                            } else {
                                                Swal.fire({
                                                    text: language === "en" ? "Sorry, looks like there are some errors detected, please try again." : "?????????? ?? ???????? ?????? ???? ???????????? ?????? ?????????????? ?? ???????? ???????????????? ?????? ????????.",
                                                    icon: "error",
                                                    buttonsStyling: !1,
                                                    confirmButtonText: language === "en" ? "Ok, got it!" : "?????????? ?? ????????!",
                                                    customClass: {confirmButton: "btn btn-primary"}
                                                })
                                                $(".errors").html("");
                                                print_error(response.error);
                                            }
                                        }
                                    })
                                    : Swal.fire({
                                        text: language === "en" ? "Sorry, looks like there are some errors detected, please try again." : "?????????? ?? ???????? ?????? ???? ???????????? ?????? ?????????????? ?? ???????? ???????????????? ?????? ????????.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: language === "en" ? "Ok, got it!" : "?????????? ?? ????????!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    })
                            }))
                        })), t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: language === "en" ? "Are you sure you would like to cancel?" : "???? ?????? ?????????? ?????? ???????? ????????????????",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: language === "en" ? "Yes, cancel it!" : "?????? ?? ???? ????????????????!",
                                cancelButtonText: language === "en" ? "No, return" : "???? ????????",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(),$( ".errors" ).empty(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: language === "en" ? "Your form has not been cancelled!." : "???? ?????? ?????????? ?????????????? ?????????? ???? !.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: language === "en" ? "Ok, got it!" : "?????????? ?? ????????!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                })
                            }))
                        })), t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: language === "en" ? "Are you sure you would like to cancel?" : "???? ?????? ?????????? ?????? ???????? ????????????????",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: language === "en" ? "Yes, cancel it!" : "?????? ?? ???? ????????????????!",
                                cancelButtonText: language === "en" ? "No, return" : "???? ????????",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(),$( ".errors" ).empty(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: language === "en" ? "Your form has not been cancelled!." : "???? ?????? ?????????? ?????????????? ?????????? ???? !.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: language === "en" ? "Ok, got it!" : "?????????? ?? ????????!",
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

