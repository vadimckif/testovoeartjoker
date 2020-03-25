$(".chosen-select").chosen({width: "15%"});

$('select[name=\'zone\']').on('change', function() {
  $.ajax({

    url:'user/getcity?zone='+this.value,
    dataType: 'json',

    success: function(json) {

      if (json && json !== '') {
        var html = '<option value="0">Выберите город</option>';
        for (var i = 0; i < json.length; i++) {
          html += '<option value="' + json[i]['ter_id'] + '">' + json[i]['ter_name'] + '</option>';
        }
        $('select[name=\'city\']').html(html);
        $("select[name=\'city\']").trigger("chosen:updated");
      } else {
        $("select[name=\'city\']").html('');
        $("select[name=\'city\']").trigger("chosen:updated");
      }

      $("select[name=\'rajen\']").html('');
      $("select[name=\'rajen\']").trigger("chosen:updated");
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('select[name=\'city\']').on('change', function() {
  $.ajax({

    url:'user/getrajen?city='+this.value,
    dataType: 'json',

    success: function(json) {

      if (json && json !== '') {
        var html = '<option value="0">Выберите район</option>';
        for (var i = 0; i < json.length; i++) {
          html += '<option value="' + json[i]['ter_id'] + '">' + json[i]['ter_name'] + '</option>';
        }
        $('select[name=\'rajen\']').html(html);
        $("select[name=\'rajen\']").trigger("chosen:updated");
      } else {
        $('select[name=\'rajen\']').html('');
        $("select[name=\'rajen\']").trigger("chosen:updated");
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('form').submit(function(e) {
  var fio = $('input[name=\'fio\']').val().trim() ? $('input[name=\'fio\']').val() : '0';
  var email=$('input[name=\'email\']').val()?$('input[name=\'email\']').val():'0';
  var zone=$('select[name=\'zone\']').val()?$('select[name=\'zone\']').val():'0';
  var city=$('select[name=\'city\']').val()?$('select[name=\'city\']').val():'0';
  var rajen=$('select[name=\'rajen\']').val()?$('select[name=\'rajen\']').val():'0';
  var error_valid='';

  if(fio === '0') {
    error_valid+=' Заполните ФИО, ';
  }

  if(email === '0') {
    var error_email = true;
    error_valid+=' Заполните email, ';
  }

  if(!error_email) {
    var r = email.match(/^[0-9a-z-\.]+\@[0-9a-z-]{2,}\.[a-z]{2,}$/i);
    if (!r) {
      error_valid += ' Поле Email заполнено не корректно, ';
    }
  }

  if(zone === '0') {
    error_valid+=' Выберите область, ';
  }

  if(city === '0') {
    error_valid+=' Выберите город, ';
  }

  if(rajen === '0') {
    error_valid+=' Выберите район ';
  }

 if(error_valid)
   {
      alert(error_valid);
       e.preventDefault();
    }
}
);
