$(document).ready(function () {
    let route = $("#status_route").val();
    if ($("#checkbox-all").length) {
        $("#checkbox-all").on("change", function () {
            $(".custom-checkbox-table:checkbox").prop("checked", this.checked);
        });
    }

    if ($(".custom-checkbox-table:checkbox").length) {
        $(".custom-checkbox-table:checkbox").on("change", function () {
            let allcheckbox = $(".custom-checkbox-table").length;
            let checked = $(".custom-checkbox-table:checked").length;
            let isChecked = allcheckbox == checked;
            $("#checkbox-all:checkbox").prop("checked", isChecked);
        });
    }



    $(document).on('change', '#checkbox-all', function () {
        $('.custom-checkbox-table:checkbox').prop("checked", this.checked);
    })


    $(document).on('change', '.custom-checkbox-table:checkbox', function () {
        let allcheckbox = $('.custom-checkbox-table').length;
        let checked = $('.custom-checkbox-table:checked').length;
        let isChecked = allcheckbox == checked
        $('#checkbox-all:checkbox').prop("checked", isChecked)
    })


    $(document).on('change', '#filter_data', function () {
        let ids = $('.custom-checkbox-table:checked').map(function () { return $(this).val() }).get().toString()
        let type = $(this).val();
        let csrf = $('meta[name="csrf-token"]').attr("content");

        if (ids == '') {
            $('#filter_data').val(0)
            return Swal.fire({
                title: "No Data selected!",
                type: "danger",
                icon: 'warning',
            })
        }

        if (type != 0) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel!",
                reverseButtons: !0
            }).then(function (e) {

                $form = $("<form style='display:none' action='" + route + "' method='post'></form>");
                $form.append(`<input type="text" name="_token" value="${csrf}" />`)
                $form.append(`<input type="text" name="ids" value="${ids}"/>`);
                $form.append(`<input type="text" name="type" value="${type}"/>`);

                e.value ? $form.appendTo('body').submit() : "cancel" === e.dismiss;

            }, function (dismiss) {
                return false;
            })
        }
    });


    $('body').on('click', '.pagination a, a.data_status', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        setUrl(url)
    });

    $('body').on('input', 'input[name="search_query"]', function(e) {
        var url = $('#search_form').attr('action');
        setUrl(url + '?search_query=' + $(this).val())
    });

    $('body').on('submit', '#search_form', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        setUrl(url + '?search_query=' + $('input[name="search_query"]').val())
    });

  
    btnStatus();



})


function setUrl(url){
    let logo = $('#loader_logo').val();
    $('#ajaxTable').append('<img class="ajaxTableLoader" src="'+logo+'" />');
    window.history.pushState("", "", url);
    btnStatus();
    loadData(url);
}

function btnStatus(){
    $('a.data_status.active').removeClass('active')
    $('a.data_status').each(function() {
        if(window.location.href.includes($(this).attr('href'))){
            $(this).addClass('active')
        }
    });
}

function loadData(url) {
    $("#ajaxTable").addClass("onLoading");
    $.ajax({
        url: url
    }).done(function(data) {
        $("#ajax_container").empty().html(data);
        $("#ajaxTable").removeClass("onLoading");
    }).fail(function() {
        console.log("Failed to load data!");
        $("#ajaxTable").removeClass("onLoading");
    });
}

  /*----------------------------------
       Ajax common getdata
    -----------------------------------------*/
    function ajax_fetch_data(url='', type='GET', data={}, callback){
        let result;
        if(url == '' || type == '', data==''){
            return 'Please provide parameters';
        }
        $('.ajaxDataLoader').show()
        // $.ajaxSetup({
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //     },
        // });
        $.ajax({
            type: type,
            url: url,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            beforeSend: function (options) {
                // $(".ajaxbtn").html("Please Wait....");
                // $(".ajaxbtn").attr("disabled", "");
                let logo = $('#loader_logo').val();
                $('.ajaxmodal').append('<img class="ajaxDataLoader" src="'+logo+'" />');
                
            },

            success: function (response) {
                // $(".ajaxbtn").removeAttr("disabled");
                // toast("success", response);
                // $(".ajaxbtn").html(ajaxbtnhtml);
                // success(response);
                result = response
                callback(result);
               
            },
            error: function (xhr, status, error) {
                // $(".ajaxbtn").html(ajaxbtnhtml);
                // $(".ajaxbtn").removeAttr("disabled");
                // $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toast("error", item);
                    // $("#errors").html(
                    //     "<li class='text-danger'>" + item + "</li>"
                    // );
                });
                // errosresponse(xhr, status, error);
            },
        });

        $('.ajaxDataLoader').hide()

        return result;
  
}

