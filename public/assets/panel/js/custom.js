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
        var size = this.getAttribute("data-modal-size");

        $(target+" .modal-body").load(ajax_link);
        $(target+" .modal-title").html(title);
        $(target+" .modal-dialog").removeClass().addClass("modal-dialog");
        $(target+" .modal-dialog").addClass(size);

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