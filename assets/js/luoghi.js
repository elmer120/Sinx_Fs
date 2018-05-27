//var base_url="http://localhost/sinxEasy/";
//form inizializzo le opzioni di selezione
function Get_regioni() {
    //faccio una chiamata ajax per popolare il select
    $.ajax({
        type: 'POST',
        url: "get_regioni",
        data: '',
        processData: false,
        contentType: false,
        success: function(data){
          $('#select_regioni').html(data);
        },
        error: function(data) { 
             alert("Errore nella chiamata ajax!");
        }
   });
}

$(document).ready(Get_regioni());
    //quando una regione è selezionata carico via ajax le provincie corrispondenti
   $(document).ready(function() {
       $('#select_regioni').change(function Get_province() {
        // faccio un chiamata ajax per popolare il select delle provincie
          $.ajax({
             url: 'get_province',
              type: 'POST',
              dataType : "text",
              data: {"region_select" : $(this).val()},
              success: function(data){
                  //popolo le province
                  $('#select_province').html(data);
                  //riabilito il select
                  $('#select_province').attr('disabled',false);
                  //disabilito il select dei comuni
                  $('#select_comuni').html('');
                  $('#select_comuni').attr('disabled',true);
              },
              error: function(data) { 
                  console.log(data);
              }
         });
     });

  });
      //quando una provincia è selezionata carico via ajax i comuni corrispondenti
   $(document).ready(function() {
       $('#select_province').change(function get_comuni(){
          // faccio un chiamata ajax per popolare il select dei comuni
            $.ajax({
               url: 'get_comuni',
                type: 'POST',
                dataType : "text",
                data: {"provincia_select" : $(this).val().toString()},
                success: function(data){
                    //popolo i comuni
                    $('#select_comuni').html(data);
                    //riabilito il select
                    $('#select_comuni').attr('disabled',false);
                    
                },
                error: function(data) { 
                    console.log(data);
                }
           });
       });

  });
  