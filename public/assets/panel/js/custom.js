/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */



$('.ajaxload-popup').magnificPopup({
    type: 'ajax',
    alignTop: true,
    overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
    callbacks: {
        parseAjax: function(mfpResponse) {
            THEMEMASCOT.initialize.TM_datePicker();
        }
    }
});
