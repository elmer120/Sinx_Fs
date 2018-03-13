//var base_url="http://localhost/sinxEasy/";
//form inizializzo le opzioni di selezione
   $(document).ready(function() {
       //faccio un chiamata ajax per popolare il select
            $.ajax({
                type: 'POST',
                url: "get_tipi_associato",
                data: '',
                processData: false,
                contentType: false,
                success: function(data){
                  $('#select_tipo').html(data);
                },
                error: function(data) { 
                     alert("Errore nella chiamata ajax!");
                }
           });
    });
  $(document).ready(function() {
    //faccio un chiamata ajax per popolare il select
         $.ajax({
             type: 'POST',
             url: "get_cariche_direttivo",
             data: '',
             processData: false,
             contentType: false,
             success: function(data){
               $('#select_carica').html(data);
             },
             error: function(data) { 
                  alert("Errore nella chiamata ajax!");
             }
        });
    });