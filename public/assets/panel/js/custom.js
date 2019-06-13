/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

$(document).ready(function(){
    $(".swal-alert").on('click',function(e) {
        e.preventDefault();
        var bt = $(".swal-alert");
        var ajax_link = this.getAttribute("data-ajax-link");
        var method = this.getAttribute("data-method");
        var csrf = this.getAttribute("data-csrf");
        var target = bt.data("target");
        var title = bt.data("title");
        var text = bt.data("text");
        var type = bt.data("type");
        var cancel = bt.data("cancel");
        var confirmText = bt.data("confirm-text");
        Swal.fire({
            title: title,
            text: text,
            type: type,
            showCancelButton: cancel,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmText,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    url:ajax_link,
                    type: method,
                    data: {_token: csrf},

                    success: function (response){
                        new PNotify({
                            title: '',
                            text: response.message,
                            type: 'success'
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000)
                    },
                    error:function (response){
                        new PNotify({
                            title: 'oops',
                            text:' Unable to load',
                            type: 'error'
                        });

                    }
                });

            }
        })
    });
    $(document).on('click', '.modal-ajax-load', function(e){

        e.preventDefault();
        var ajax_link = this.getAttribute("data-ajax-link");
        var target = this.getAttribute("data-target");
        var title = this.getAttribute("data-modal-title");
        var size = this.getAttribute("data-modal-size");
        // $(target+" .modal-body").load(ajax_link);
        $.ajax({
            url:ajax_link,
            type:'GET',
            // data: $(this).serialize(),

            success: function (response){
                $(target+" .modal-body").html(response);
            },

            error:function (response){
                new PNotify({
                    title: 'oops',
                    text:' Unable to load',
                    type: 'error'
                });

            }
        });


        $(target+" .modal-title").html(title);
        $(target+" .modal-dialog").removeClass().addClass("modal-dialog");
        $(target+" .modal-dialog").addClass(size);

    });


    $(document).on("submit", "form.form-ajax-submit", function(e){
        e.preventDefault();

        var target = this.getAttribute("action");
        var method = this.getAttribute("method");
        var formData = new FormData(this);


        $.ajax({
            url:target,
            type:method,
            contentType: false,
            processData: false,
            // data: $(this).serialize(),
            data: formData,

            success: function (response){
                new PNotify({
                    title: '',
                    text: response.message,
                    type: 'success'
                });
                setTimeout(function(){
                    location.reload();
                }, 1000)
            },

            error:function (response){
                var errors = response.responseJSON.errors;
                $.each( errors, function( index, value ) {
                    new PNotify({
                        title: index,
                        text: value,
                        type: 'error'
                    });
                });
                setTimeout(function(){
                    $('[type="submit"]').prop('disabled', false);

                }, 2500);

            }
        });

    });
});
