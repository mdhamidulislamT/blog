(function ($) {
    "use strict";
    /*----------------------------
    Ajaxform Submit
    ------------------------------*/
    $(".ajaxform").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var ajaxbtnhtml = $(".ajaxbtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".ajaxbtn").html("Please Wait....");
                $(".ajaxbtn").attr("disabled", "");
            },

            success: function (response) {
                $(".ajaxbtn").removeAttr("disabled");
                toast("success", response);
                $(".ajaxbtn").html(ajaxbtnhtml);
                success(response);
            },
            error: function (xhr, status, error) {
                $(".ajaxbtn").html(ajaxbtnhtml);
                $(".ajaxbtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toast("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                // errosresponse(xhr, status, error);
            },
        });
    });

    /*----------------------------------
        ajaxform Submit With Reload
    -----------------------------------------*/
    $(".ajaxform_with_reload").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var ajaxbtnhtml = $(".ajaxbtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".ajaxbtn").html("Please Wait....");
                $(".ajaxbtn").attr("disabled", "");
            },

            success: function (response) {
                $(".ajaxbtn").removeAttr("disabled");
                toast("success", response);
                $(".ajaxbtn").html(ajaxbtnhtml);
                location.reload();
            },
            error: function (xhr, status, error) {
                $(".ajaxbtn").html(ajaxbtnhtml);
                $(".ajaxbtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toast("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                // errosresponse(xhr, status, error);
            },
        });
    });

    /*----------------------------------
        ajaxform Submit with Reset
    ----------------------------------------*/
    $(".ajaxform_with_reset").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var ajaxbtnhtml = $(".ajaxbtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".ajaxbtn").html("Please Wait....");
                $(".ajaxbtn").attr("disabled", "");
            },

            success: function (response) {
                console.log(response);

                $(".ajaxbtn").removeAttr("disabled");
                toast("success", response);
                $(".ajaxbtn").html(ajaxbtnhtml);
                $(".ajaxform_with_reset").trigger("reset");
            },
            error: function (xhr, status, error) {
                console.log( error);
                $(".ajaxbtn").html(ajaxbtnhtml);
                $(".ajaxbtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toast("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                // errosresponse(xhr, status, error);
            },
        });
    });

  


    /*--------------------------
        Sweetalret Active
    --------------------------------*/
    function Sweet(icon, title, time = 3000) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: time,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        Toast.fire({
            icon: icon,
            title: title,
        });
    }

    function toast(type, title) {
        toastr.options = {
            progressBar: true,
        };
        if (type == "success") toastr.success(title);
        if (type == "info") toastr.info(title);
        if (type == "error") toastr.error(title);
        if (type == "warning") toastr.warning(title);
    }

    $(document).on("click", ".delete_btn", function (e) {
        e.preventDefault();
        let form = $(".delete_form");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel!",
            reverseButtons: !0,
        }).then(
            function (e) {
                e.value ? form.submit() : "cancel" === e.dismiss;
            },
            function (dismiss) {
                return false;
            }
        );
    });
})(jQuery);
