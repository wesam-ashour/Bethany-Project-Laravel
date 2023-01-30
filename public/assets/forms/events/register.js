$(function () {
    const table = $('#kt_ecommerce_forms_table'),
        language = $('#language').val(),
        app_url = $('#app_url').val(),
        filter_class = $(".filter_data");
    let id = 0, core_name = "";
    $(document).ready(function () {
        "use strict";
        get_forms();
        /*Table Actions*/
        table_function();
        $(document).on('click', '#delete', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            confirm_delete(id,name);
        });
    });

    function confirm_delete(id,name) {
        const o = "sads";
        Swal.fire({
            text: language === "en" ? "Are you sure you want to delete this item?" : "هل أنت متأكد أنك تريد حذف هذا البند؟",
            icon: "warning",
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: language === "en" ? "Yes, delete!" : "نعم ، احذف!",
            cancelButtonText: language === "en" ? "No, cancel" : "لا ، إلغاء",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        });
        var confirm_delete = document.getElementsByClassName("swal2-confirm");
        confirm_delete[0].addEventListener('click', function () {
            delete_user(id,name);
        });
    }

    function delete_user(id,name) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: base_path + language +  "/DeleteUserRegister/" + id,
            data: {"event_id":name},
            success: function (response) {
                if (response['success']) {
                    Swal.fire({
                        text: language === "en" ? "You have deleted the item!." : "لقد قمت بحذف العنصر !.",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                        customClass: {confirmButton: "btn fw-bold btn-primary"}
                    });
                    $('#kt_ecommerce_forms_table').DataTable().ajax.reload();
                } else if (response['error']) {
                    Swal.fire({
                        text: language === "en" ? "The item was not deleted." : "لم يتم حذف العنصر.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: language === "en" ? "Ok, got it!" : "حسنًا ، فهمت!",
                        customClass: {confirmButton: "btn fw-bold btn-primary"}
                    });
                }
            }
        });
    }


    function table_function() {
        form_status();
    }

    function repeater() {
        $('#kt_docs_repeater_advanced').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },
            show: function () {
                $(this).slideDown();
                $(this).find('[data-kt-repeater="select2"]').select2();
                $(this).find('[data-kt-repeater="datepicker"]').flatpickr();
                new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            ready: function () {
                $('[data-kt-repeater="select2"]').select2();
                $('[data-kt-repeater="datepicker"]').flatpickr();
                new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
            }
        });
        /*document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]').forEach((e => {
            $(e).hasClass("select2-hidden-accessible") || $(e).select2({minimumResultsForSearch: -1})
        }))*/
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
                    var id = $("input[name=editId]").val();
                    (t = document.querySelector("#kt_ecommerce_forms_table")) && ((e = $(t).DataTable({
                        searchable: true,
                        serverSide: true,
                        language: {
                            url: language === "en" ? "//cdn.datatables.net/plug-ins/1.13.1/i18n/en-GB.json" : "//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json",
                        },
                        ajax: {
                            "url": base_path + language + "/event/register" + '/' + id,
                            "type": 'GET',
                            "data": {id: id},
                        },
                        columns: [
                            {
                                data: 'full_name',
                                name: 'full_name'
                            },
                            {
                                data: 'email',
                                name: 'email'
                            },
                            {
                                data: 'mobile',
                                name: 'mobile'
                            },
                            {
                                data: 'email_verified',
                                name: 'email_verified'
                            },
                            {
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },

                        ]
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
