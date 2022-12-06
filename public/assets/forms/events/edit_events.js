$(function () {
    const app_url = $('#app_url').val(),
        title = $('#title').val(),
        date = $('#kt_datepicker_6').val(),
        address = $('#address').val(),
        description = $("#description").val(),
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
                                title: {
                                    validators: {
                                        notEmpty: {message: "The title is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The title must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                date: {
                                    validators: {
                                        notEmpty: {message: "The date is required"}
                                    }
                                },
                                address: {
                                    validators: {
                                        notEmpty: {message: "The address is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The address must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                description: {
                                    validators: {
                                        notEmpty: {message: "The description is required"}, stringLength: {
                                            min: 3,
                                            max: 255,
                                            message: 'The description must be more than 3 and less than 255 characters long'
                                        }
                                    }
                                },
                                default_latitude: {
                                    validators: {
                                        notEmpty: {message: "Please refresh page and accept permission to get current location"}
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
                        t.querySelector('[data-kt-permissions-modal-action="close"]').addEventListener("click", (t => {
                            t.preventDefault(), Swal.fire({
                                text: "Are you sure you would like to close?",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Yes, close it!",
                                cancelButtonText: "No, return",
                                customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                            }).then((function (t) {
                                t.value && n.hide()
                            }))
                        })), t.querySelector('[data-kt-permissions-modal-action="cancel"]').addEventListener("click", (t => {
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
                        }));
                        const i = t.querySelector('[data-kt-permissions-modal-action="submit"]');
                        i.addEventListener("click", (function (t) {
                            t.preventDefault(), o && o.validate().then((function (t) {
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
                                        url: base_path + "events/" + $("#event_id").val(),
                                        data: formDatas,
                                        processData: false,  // tell jQuery not to process the data
                                        contentType: false,
                                        success: function (response) {
                                            console.log(response["error"])
                                            if ($.isEmptyObject(response.error)) {
                                                (i.setAttribute("data-kt-indicator", "on"), i.disabled = !0, setTimeout((function () {
                                                    i.removeAttribute("data-kt-indicator"), i.disabled = !1,
                                                        Swal.fire({
                                                            text: "Form has been successfully submitted!",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: "Ok, got it!",
                                                            customClass: {confirmButton: "btn btn-primary"}
                                                        }).then((function (t) {
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
                                        text: "Sorry, looks like there are some errors detected, please try again.",
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

