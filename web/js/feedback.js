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
    // Don't submit the form.
    ev.preventDefault();

    var $form = $(this);
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize(),
        success: function(response, status, xhr) {
            $error.hide();
            $success.fadeIn().html(response);
        },
        error: function(xhr, status, error) {
            $success.hide();
            $error.fadeIn().html(xhr.responseText);
        }
    });

  }).on('reset', function(ev) {
      $feedbackForm.toggle("slide");
  });

});
