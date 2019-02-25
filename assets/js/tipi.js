//form inizializzo le opzioni di selezione
   $(document).ready(function() {
       //faccio un chiamata ajax per popolare il select
            $.ajax({
                type: 'POST',
                url: controller_url+"get_tipi_associato",
                data: '',
                processData: false,
                contentType: false,
                success: function(data){
                  $('#select_tipo').html(data);
                  if(typeof tipo_sel !== 'undefined')
                  {
                    set_selected("select_tipo",tipo_sel);
                  }
                },
                error: function(data) { 
                     alert("Tipi.js: Errore nella chiamata ajax!");
                }
           });
    });
  $(document).ready(function() {
    //faccio un chiamata ajax per popolare il select
         $.ajax({
             type: 'POST',
             url: controller_url+"get_cariche_direttivo",
             data: '',
             processData: false,
             contentType: false,
             success: function(data){
              $('#select_carica').html(data);
              if(typeof carica_sel !== 'undefined')
              {
                set_selected("select_carica",carica_sel);
              }
             },
             error: function(data) { 
                  alert("Tipi.js: Errore nella chiamata ajax!");
             }
        });
    });
