function get_services() {
    $.ajax({
        url: service_ajax.ajaxurl,
        data: ({action: 'service_status'}),
        beforeSend: function(xhr) {
          $('#spinner').show();
        },
        complete: function() {
          $('#spinner').hide();
        },
        error: function() {
          $('#services').html("<div class='alert alert-warning' style='margin-top:2em;'>We are currently experiencing problems retrieving the status of our services. Please try again in a few minutes.</div>");
        },
        success: function(response, textStatus, jqXHR) {
          $('#services').html(response);
        }
    });
}



