$(function () {
    const
        app_url = $('#app_url').val(),
        name = $('#name').val(),
        mobile = $('#mobile').val(),
        email = $("#email").val(),
        user_name = $("#user_name").val(),
        address = $("#address").val(),
        password = $("#password").val(),
        roles = $("#roles").val();

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
                                name: {
                                    validators: {
                                        notEmpty: {message: "The name is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The title must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                mobile: {
                                    validators: {
                                        notEmpty: {message: "The mobile is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The title must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                user_name: {
                                    validators: {
                                        notEmpty: {message: "The username is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The title must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                address: {
                                    validators: {
                                        notEmpty: {message: "The address is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The title must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                password: {
                                    validators: {
                                        notEmpty: {message: "The password is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The title must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                roles: {
                                    validators: {
                                        notEmpty: {message: "The roles is required"}
                                    }
                                },
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
                                        "url": base_path + "admins",
                                        data: formData,
                                        processData: false,  // tell jQuery not to process the data
                                        contentType: false,
                                        success: function (response) {
                                            if ($.isEmptyObject(response.error)) {
                                                (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0, setTimeout((function () {
                                                    i.removeAttribute("data-kt-indicator"), i.disabled = !1, Swal.fire({
                                                        text: "Form has been successfully submitted!",
                                                        icon: "success",
                                                        buttonsStyling: !1,
                                                        confirmButtonText: "Ok, got it!",
                                                        customClass: {confirmButton: "btn btn-primary"}
                                                    }).then((function (t) {
                                                        t.isConfirmed && n.hide()
                                                    }))
                                                }), 2e3));
                                                $("input").val("");
                                                $(".errors").html("");
                                                $('#kt_ecommerce_forms_table').DataTable().ajax.reload();
                                            } else {
                                                Swal.fire({
                                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                                    icon: "error",
                                                    buttonsStyling: !1,
                                                    confirmButtonText: "Ok, got it!",
                                                    customClass: {confirmButton: "btn btn-primary"}
                                                })
                                                $(".errors").html("");
                                                print_error(response.error);
                                            }
                                        }
                                    })
                                    : Swal.fire({
                                        text: "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    })
                            }))
                        })), t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: "Are you sure you would like to cancel?",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Yes, cancel it!",
                                cancelButtonText: "No, return",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: "Your form has not been cancelled!.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                })
                            }))
                        })), t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: "Are you sure you would like to cancel?",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Yes, cancel it!",
                                cancelButtonText: "No, return",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                                    text: "Your form has not been cancelled!.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
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

