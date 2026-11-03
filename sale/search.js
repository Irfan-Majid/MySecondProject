/*$('#sug_input').keyup(function (e) {
  if ($(this).val().length >= 1) {
    $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
        'product_name': $(this).val()
      },
      dataType: 'json',
      encode: true,
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
        alert(ajaxOptions);
      }
    }).done(function (data) {
      //console.log(data)
      $('#result').html(data).fadeIn();
      $('#result li').click(function () {

        $('#sug_input').val($(this).text());
        $('#result').fadeOut(500);

      });

      $("#sug_input").blur(function () {
        $("#result").fadeOut(800);
      });

    });

  } else {

    $("#result").hide();

  };

  e.preventDefault();
});

*//*
$('#sug-form').submit(function (e) {
  e.preventDefault();
  $('#qty').val('');
  $.ajax({
    type: 'POST',
    url: 'search.php',
    data: {
      'p_name': $('#sug_input').val()
    },
    dataType: 'json',
    encode: true,
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
      alert(ajaxOptions);
    }
  }).done(function (data) {
    //console.log(data);
    $('#name').val(data[0]);
    $('#small').text("( " + data[3] + " Tk per unit )");
    var stock_quantity = data[2];
    $('#qty').blur(function () {
      var a = $('#qty').val();
      if (a > stock_quantity) {
        
      $("#submit").attr("disabled",true);
      $("#discount").attr("disabled",true);
        $("#myModal").modal('show');
        $(".close").click(function () {
          $("#myModal").modal('hide')
        });
        $('#sale_price').val("");
      } else {
        
      $("#discount").attr("disabled",false);
        $('#sale_price').val(data[3] * a);
      }

    });
  }).fail(function () {
    alert();
  });
});

*/
/*$('#discount').blur(function () {
  var a = $('#discount').val().trim();
  if (a.indexOf("%") < 0) {
  $('#discount').val(a+"%");
  }else{
  a=a.substring(0,a.indexOf("%"));
  }
  var b = $('#sale_price').val().trim();
  if (a != null && b != null) {
    if (a < 50) {
      var c = b - (b / 100 * a);
      $('#Net_price').val(c);
      
      $("#submit").attr("disabled",false);
       
    } else {
      $("#submit").attr("disabled",true);
      alert("Discount can not be more then 50%")
    }
  }
})*/
/*for clicking product show in form*/

/*$(".click").click(function(e){
              
              $.ajax({
    type: 'POST',
    url: 'search.php',
    data: {
      'p_id': $(this).val()
    },
    dataType: 'json',
    encode: true,
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
      alert(ajaxOptions);
    }
  }).done(function (data) {
    $('#name').val(data[0]);
    $('#small').text("( " + data[3] + " Tk per unit )");
    var stock_quantity = data[2];
    $('#qty').blur(function () {
      
      var a = $('#qty').val();
      if (a > stock_quantity) {
        /*
      $("#submit").attr("disabled",true);
      $("#discount").attr("disabled",true);
        $("#myModal").modal('show');
        $(".close").click(function () {
          $("#myModal").modal('hide')
        });
        $('#sale_price').val("");*/
    /*  } else {*/
        /*
      $("#discount").attr("disabled",false);
        $('#sale_price').val(data[3] * a);*/
    /*  }

    });*/
 
 /* })
         })*/