$(function() {

  var $feedbackForm = $("#fb-form");
  var $feedbackTab  = $("#fb-tab");
  var $success = $("#fb-success");
  var $error   = $("#fb-error");

  $feedbackTab.click(function(ev) {
    $feedbackForm.toggle("slide");
    $success.hide();
    $error.hide();
  });

  $feedbackForm.find("form").on('submit', function(ev) {
    var $form = $(this);
    $.ajax({
      type: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      success: function(response, status, xhr) {
        $error.hide();
        $success.html(response).fadeIn().delay(4500).fadeOut();
      },
      error: function(xhr, status, error) {
        $success.hide();
        $error.html(xhr.responseText).fadeIn();
      }
    });
    // Don't submit the HTML form.
    ev.preventDefault();
  }).on('reset', function(ev) {

  });

});
