(function (window, undefined) {
    "use strict";

    // تأكد من تحميل SweetAlert2
    if (typeof Swal === "undefined") {
        console.error("SweetAlert2 is not loaded.");
        return;
    }

    // وظيفة التأكيد باستخدام SweetAlert2 مع تنفيذ الحذف باستخدام AJAX
    window.confirmDelete = function (
        event,
        url,
        item_id,
        message = "Do you want to delete this item?",
        title = "Are you sure?"
    ) {
        event.preventDefault();

        // إظهار نافذة التأكيد
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
                // إرسال طلب AJAX لحذف العنصر
                $.ajax({
                    url: url, // الرابط الذي يحدد مكان إرسال الطلب
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"), // تضمين CSRF Token
                        _method: "DELETE", // تحديد أن الطريقة هي DELETE
                    },
                    success: function (response) {
                        if (response.status == "success") {
                            // عند النجاح، عرض رسالة النجاح وحذف العنصر من الصفحة
                            $("#" + item_id).remove();
                            $(".toster_success").text(response.message).show();
                        } else {
                            // في حالة حدوث خطأ
                            Swal.fire("Error!", response.message, "error");
                        }

                        setTimeout(function () {
                            $(".toster_success, .toster_error").hide();
                        }, 3000);
                    },
                    error: function (xhr, status, error) {
                        // في حالة حدوث خطأ في الطلب
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

    window.changeStatus = function (
        event,
        id,
        url,
        statusActive,
        statusInactive
    ) {
        event.preventDefault();

        // تأكد من وجود المتغيرات المترجمة
        var statusActiveText = statusActive;
        var statusInactiveText = statusInactive;

        // تحقق من وجود القيم المترجمة
        if (!statusActiveText || !statusInactiveText) {
            console.error("Translation for status is missing.");
            return;
        }

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                if (response.status === "success") {
                    const statusButton = document.getElementById(
                        "status_" + id
                    );
                    const newStatus =
                        response.data.status === "active"
                            ? "active"
                            : "inactive";

                    // تحديث النص باستخدام القيم المترجمة
                    if (newStatus === "active") {
                        statusButton.innerHTML = statusActiveText; // النص المترجم
                    } else {
                        statusButton.innerHTML = statusInactiveText; // النص المترجم
                    }

                    // تحديث الكلاسات
                    statusButton.classList.remove("btn-danger", "btn-success");
                    statusButton.classList.add(
                        newStatus === "active" ? "btn-success" : "btn-danger"
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
