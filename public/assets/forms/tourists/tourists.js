var table = $('#kt_table_users');
$(function () {
    const language = $('#language').val(),
        app_url = $('#app_url').val();
    $(document).ready(function () {
        "use strict";
        get_users();
        //users();
        /*Table Actions*/
        $(document).on('click', '#delete', function () {
            let id = $(this).data('id');
            confirm_delete(id);
        });
        $(document).on('click', '#edit', function () {
            let id = $(this).data('id');
            edit_user(id);
        });
    });

    function edit_user(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_path + language  + "/" + "tourists/" + id + "/edit",
            success: function (response) {
                $("#tourist_id").val(response.event.id);
                $("#title_en_edit").val(response.event.title['en']);
                $("#title_ar_edit").val(response.event.title['ar']);
                $("#location_en_edit").val(response.event.location['en']);
                $("#location_ar_edit").val(response.event.location['ar']);
                $("#description_en_edit").val(response.event.description['en']);
                $("#description_ar_edit").val(response.event.description['ar']);

                $("#uniqid_edit").val(response.event.QRCode);
                $("#default_latitude_u").val(response.event.lat);
                $("#default_longitude_u").val(response.event.long);

                let map, activeInfoWindow, markers = [];
                window.onload = initMap();
                /* ----------------------------- Initialize Map ----------------------------- */
                function initMap() {
                    var lat = parseFloat(document.getElementById('default_latitude_u').value);
                    var lng = parseFloat(document.getElementById('default_longitude_u').value);

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: {
                            lat: lat,
                            lng: lng,
                        },
                        zoom: 13
                    });
                    map.addListener("click", function (event) {
                        mapClicked(event);
                    });

                    initMarkers();
                }


                /* --------------------------- Initialize Markers --------------------------- */
                function initMarkers() {

                    const initialMarkers = response.initials;
                    for (let index = 0; index < initialMarkers.length; index++) {
                        const markerData = initialMarkers[index];
                        const marker = new google.maps.Marker({
                            position: markerData.position,
                            label: markerData.label,
                            draggable: markerData.draggable,
                            map
                        });
                        markers.push(marker);
                        const infowindow = new google.maps.InfoWindow({
                            content: `<b>${markerData.position.lat}, ${markerData.position.lng}</b>`,
                        });
                        marker.addListener("click", (event) => {
                            if (activeInfoWindow) {
                                activeInfoWindow.close();
                            }
                            infowindow.open({
                                anchor: marker,
                                shouldFocus: false,
                                map
                            });
                            activeInfoWindow = infowindow;
                            markerClicked(marker, index);
                        });
                        marker.addListener("dragend", (event) => {
                            markerDragEnd(event, index);
                        });
                    }
                }

                /* ------------------------- Handle Map Click Event ------------------------- */
                function mapClicked(event) {
                    console.log(map);
                    console.log(event.latLng.lat(), event.latLng.lng());
                }

                /* ------------------------ Handle Marker Click Event ----------------------- */
                function markerClicked(marker, index) {
                    console.log(map);
                    console.log(marker.position.lat());
                    console.log(marker.position.lng());
                }

                /* ----------------------- Handle Marker DragEnd Event ---------------------- */
                function markerDragEnd(event, index) {
                    console.log(map);
                    console.log(event.latLng.lat());
                    console.log(event.latLng.lng());
                    $("#default_latitude_u").val(event.latLng.lat());
                    $("#default_longitude_u").val(event.latLng.lng());
                }
            }
        });
    }

    function confirm_delete(id) {
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
            delete_user(id);
        });
    }

    function delete_user(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: base_path + language  + "/" + "tourists/" + id,
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

    function get_users() {
        var KTUsersList = function () {
            var t, e, n = () => {
                t.querySelectorAll('[data-kt-user-table-filter="delete_row"]').forEach((t => {
                    t.addEventListener("click", (function (t) {
                        t.preventDefault();
                        const n = t.target.closest("tr"),
                            o = n.querySelector('[data-kt-user-table-filter="user_name"]').innerText;
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
                    (t = document.querySelector("#kt_table_users")) && ((e = $(t).DataTable({
                        searchable: true,
                        ajax: {
                            "url": base_path + "tourists",
                            "type": 'GET',
                        },
                        columns: [
                            {
                                data: 'id',
                                name: 'id',
                            },
                            {
                                data: 'name',
                                name: 'name',
                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
                            },
                            {
                                data: 'roles',
                            },
                            {
                                data: 'status',
                                name: 'status',
                            }, {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                    })).on("draw", (function () {
                        n()
                    })), document.querySelector('[data-kt-user-table-filter="search"]').addEventListener("keyup", (function (t) {
                        e.search(t.target.value).draw()
                    })), n())
                }
            }
        }();
        KTUtil.onDOMContentLoaded((function () {
            KTUsersList.init()
        }));
    }
});
