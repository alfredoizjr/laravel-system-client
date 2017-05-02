$('#search_form').submit(function(e){
  e.preventDefault();


  $('#search').keyup(function(){
     var envio = $('#search').val();
    $('#result').html('<p> loading...</p>');

    $.ajax({
         method: 'POST',
         url: "/history",
         data: {body: envio , _token: token},
         success: function(data){
             console.log(data.message);
         }
    })
  });
 });
