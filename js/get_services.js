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
        error: ajaxError,
        success: function(response, textStatus, jqXHR) {
          $('#services').html(response);
        }
    });
}

function ajaxError(jqxhr, type, error) {
  console.log(jqxhr);
  var msg = "An Ajax error occurred!";
  if (type == 'error') {
    if (jqxhr.readyState == 0) {
    // Request was never made - security block?
        msg += "Looks like the browser security-blocked the request.";
    } else {
        // Probably an HTTP error.
        msg += 'Error code: ' + jqxhr.status + "" +
        'Error text: ' + error + "" +
        'Full content of response: ' + jqxhr.responseText;
    }   
  } else {
    msg += 'Error type: ' + type;
    if (error != "") {
        msg += "Error text: " + error;
    }   
  }
  console.log(msg);
}


