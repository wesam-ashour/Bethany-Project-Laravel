$(function () {
    const table = $('#kt_ecommerce_forms_table'),
        app_url = $('#app_url').val(),
        filter_class = $(".filter_data");
    let id = 0, core_name = "";
    $(document).ready(function () {
        "use strict";
        get_forms();
        /*Table Actions*/
        table_function();
    });

    function table_function() {
        form_status();
    }


    function date_picker() {
        $(".from_date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"), 10)
            }, function (start, end, label) {
                /*var years = moment().diff(start, "years");
                alert("You are " + years + " years old!");*/
            }
        );
    }

    function form_status() {
        $(document).on('click', '#message_status', function () {
            let id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: app_url + "/admin/form_one/status/" + id,
                success: function (response) {
                    if (response['success']) {
                        Swal.fire({
                            text: "You have change order status!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        });
                        id = "";
                        table.DataTable().ajax.reload();
                    } else if (response['error']) {
                        Swal.fire({
                            text: "The order status was not change.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        });
                        id = "";
                    }
                }
            });
        });
    }

    function get_forms() {
        var KTAppEcommerceCategories = function () {
            var t, e, n = () => {
                t.querySelectorAll('[data-kt-ecommerce-forms-filter="delete_row"]').forEach((t => {
                    t.addEventListener("click", (function (t) {
                        t.preventDefault();
                        const n = t.target.closest("tr"),
                            o = n.querySelector('[data-kt-ecommerce-forms-filter="forms_name"]').innerText;
                        Swal.fire({
                            text: "Are you sure you want to delete " + o + "?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then((function (t) {
                            t.value ? Swal.fire({
                                text: "You have deleted " + o + "!.",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn fw-bold btn-primary"}
                            }).then((function () {
                                e.row($(n)).remove().draw()
                            })) : "cancel" === t.dismiss && Swal.fire({
                                text: o + " was not deleted.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn fw-bold btn-primary"}
                            })
                        }))
                    }))
                }))
            };
            return {
                init: function () {
                    (t = document.querySelector("#kt_ecommerce_forms_table")) && ((e = $(t).DataTable({
                        searchable: true,
                        serverSide: true,
                        language: {
                            url: language === "en" ? "//cdn.datatables.net/plug-ins/1.13.1/i18n/en-GB.json" : "//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json",
                        },
                        ajax: {
                            "url": base_path + language + "/"+ "events",
                            "type": 'GET',
                            /*"data":{core_name:core_name},*/
                        },
                        columns: [
                            {
                                data: 'title',
                                name: 'title'
                            },
                            {
                                data: 'date',
                                name: 'date'
                            },
                            {
                                data: 'added_by',
                                name: 'added_by'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action',

                            },
                        ],

                    })).on("draw", (function () {
                        n()
                    })), document.querySelector('[data-kt-ecommerce-forms-filter="search"]').addEventListener("keyup", (function (t) {
                        e.search(t.target.value).draw()
                    })),/* filter_class.click(function () {
                        $("<option></option>").insertBefore($('.filter_data option:first-child'));
                        filter_class.val("")
                        e.search("").draw()
                        $("option:selected").prop("selected", false)
                    }),*/ $("#reset").click(function () {
                        $("#search").val("");
                        $("<option></option>").insertBefore($('.filter_data option:first-child'));
                        filter_class.val("")
                        e.search("").draw()
                        $("option:selected").prop("selected", false)
                    }), filter_class.on("change", function () {
                        core_name = $(this).val();
                        e.search(core_name.trim()).draw()
                    }), n())
                }
            }
        }();
        KTUtil.onDOMContentLoaded((function () {
            KTAppEcommerceCategories.init()
        }));
    }
});
