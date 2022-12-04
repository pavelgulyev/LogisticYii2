$('#logistic-form').on('beforeSubmit', function () {
  var form = $(this);
  var data = form.serialize();
  $.ajax({
      url: '/calculator/fill',
      type: 'POST',
      data: data,
      success: function (data) {
          $('#print').html(data.message);
          form.children('.has-success').removeClass('has-success');
          form[0].reset();
      },
      error: function () {
          alert('Ошибка отправки данных ajax');
      }
  });
  return false;
});
