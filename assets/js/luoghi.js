//var base_url="http://localhost/sinxEasy/";
//form inizializzo le opzioni di selezione
   $(document).ready(function() {
    $('#select_regioni').on('mousedown', function(e) {
        //impedisco l'apertura della select
        e.preventDefault();
       //faccio una chiamata ajax per popolare il select
            $.ajax({
                type: 'POST',
                url: "get_regioni",
                data: '',
                processData: false,
                contentType: false,
                success: function(data){
                  $('#select_regioni').html(data);
                  $(this).unbind(e);
                 // $('#select_regioni').trigger('click');
                },
                error: function(data) { 
                     alert("Errore nella chiamata ajax!");
                }
           });
        });
  });
    //quando una regione è selezionata carico via ajax le provincie corrispondenti
   $(document).ready(function() {
       $('#select_regioni').change(function(){
          // faccio un chiamata ajax per popolare il select delle provincie
            $.ajax({
               url: 'get_province',
                type: 'POST',
                dataType : "text",
                data: {"region_select" : $(this).val()},
                success: function(data){
                  
                    $('#select_province').html(data);
                    $('#select_province').removeAttr('disabled');
                    
                },
                error: function(data) { 
                    console.log(data);
                }
           });
       });

  });
      //quando una provincia è selezionata carico via ajax i comuni corrispondenti
   $(document).ready(function() {
       $('#select_province').change(function(){
          // faccio un chiamata ajax per popolare il select dei comuni
            $.ajax({
               url: 'get_comuni',
                type: 'POST',
                dataType : "text",
                data: {"provincia_select" : $(this).val().toString()},
                success: function(data){
                 
                    $('#select_comuni').html(data);
                    $('#select_comuni').removeAttr('disabled');
                    
                },
                error: function(data) { 
                    console.log(data);
                }
           });
       });

  });
  