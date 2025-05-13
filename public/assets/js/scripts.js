(function (window, undefined) {
    "use strict";

    if (typeof Swal === "undefined") {
        console.error("SweetAlert2 is not loaded.");
        return;
    }

    window.confirmDelete = function (
        event,
        url,
        item_id,
        message = "Do you want to delete this item?",
        title = "Are you sure?"
    ) {
        event.preventDefault();

        Swal.fire({
            title: title,
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        _method: "DELETE",
                    },
                    success: function (response) {
                        if (response.status == "success") {
                            $("#" + item_id).remove();
                            $(".toster_success").text(response.message).show();
                            if ($("#dataTable")) {
                                $(".modal.fade.dtr-bs-modal").hide();
                                $(".modal-backdrop.fade").hide();
                                var currentPage = $("#dataTable")
                                    .DataTable()
                                    .page();
                                $("#dataTable")
                                    .DataTable()
                                    .page(currentPage)
                                    .draw(false);
                            }
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }

                        setTimeout(function () {
                            $(".toster_success, .toster_error").hide();
                        }, 3000);
                    },
                    error: function () {
                        Swal.fire(
                            "Error!",
                            "There was an error deleting the item.",
                            "error"
                        );
                    },
                });
            }
        });
    };

    window.changeStatus = function (event, id, url, lang) {
        event.preventDefault();
        var statusText = "";

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                if (response.status === "success") {
                    const statusButton = document.getElementById(
                        "status_" + id
                    );
                    if ($("#dataTable")) {
                        $(".modal.fade.dtr-bs-modal").hide();
                        $(".modal-backdrop.fade").hide();
                        var currentPage = $("#dataTable").DataTable().page();
                        $("#dataTable")
                            .DataTable()
                            .page(currentPage)
                            .draw(false);
                    }
                    const newStatus = response.data.status;
                    if (lang == "ar") {
                        statusText = newStatus == 1 ? "مفعل" : "غير مفعل";
                    } else {
                        statusText = newStatus == 1 ? "Active" : "Inactive";
                    }
                    statusButton.innerHTML = statusText;

                    // تحديث الكلاسات
                    statusButton.classList.remove("btn-danger", "btn-success");
                    statusButton.classList.add(
                        newStatus == 1 ? "btn-success" : "btn-danger"
                    );

                    $(".toster_success").text(response.message).show();
                } else {
                    $(".toster_error").text(response.message).show();
                }

                setTimeout(function () {
                    $(".toster_success, .toster_error").hide();
                }, 3000);
            },
        });
    };
})(window);
