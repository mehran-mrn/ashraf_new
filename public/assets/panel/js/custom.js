/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

$(document).ready(function(){
    $(".modal-ajax-load").on('click',function(e){
        e.preventDefault();
        var ajax_link = this.getAttribute("data-ajax-link");
        var target = this.getAttribute("data-target");
        var title = this.getAttribute("data-modal-title");

        $(target+" .modal-body").load(ajax_link);
        $(target+" .modal-title").html(title);
    });


    $(document).on("submit", "form.form-ajax-submit", function(e){
        e.preventDefault();

        var target = this.getAttribute("action");
        var method = this.getAttribute("method");


        $.ajax({
            url:target,
            type:method,
            data: $(this).serialize(),

            success: function (response){
                $(".error_content").fadeOut('slow');
                $(".message_content").html("");
                $(".message_content").append("<li><b>"  + response.message + "</b></li>"  + "\n");
                $(".message_content").fadeIn('slow');
                setTimeout(function(){
                    location.reload();
                }, 2000)
            },

            error:function (response){
                var errors = response.responseJSON;
                $(".message_content").hide();
                $(".error_content").html("");
                $.each( errors, function( index, value ) {
                    $(".error_content").append("<li><b>"  + value + "</b></li>"  + "\n");
                });
                $(".error_content").fadeIn('slow');

            }
        });

    });
});