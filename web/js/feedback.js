$(function() {

  var $feedbackForm = $("#fb-form");
  var $feedbackTab  = $("#fb-tab");
  var $success = $("#fb-success fb-description");
  var $error   = $("#fb-error fb-description");

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
            $success.html(response).fadeIn();
        },
        error: function(xhr, status, error) {
            $success.hide();
            $error.html(xhr.responseText).fadeIn();
        }
    });

  }).on('reset', function(ev) {
      $feedbackForm.toggle("slide");
  });

});
