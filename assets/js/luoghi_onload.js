//var base_url="http://localhost/sinxEasy/";
//form inizializzo le opzioni di selezione
$(document).ready(function() {
    //faccio un chiamata ajax per popolare il select
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
});
 //quando una regione è selezionata carico via ajax le provincie corrispondenti
$(document).ready(function() {
       // faccio un chiamata ajax per popolare il select delle provincie
         $.ajax({
            url: 'get_province',
             type: 'POST',
             dataType : "text",
             data: '',
             success: function(data){
               
                 $('#select_province').html(data);
                 //$('#select_province').removeAttr('disabled');
                 
             },
             error: function(data) { 
                 console.log(data);
             }
        });
   

});
   //quando una provincia è selezionata carico via ajax i comuni corrispondenti
$(document).ready(function() {
       // faccio un chiamata ajax per popolare il select dei comuni
         $.ajax({
            url: 'get_comuni',
             type: 'POST',
             dataType : "text",
             data: '',
             success: function(data){
                
                 $('#select_comuni').html(data);
                 //$('#select_comuni').removeAttr('disabled');
                 setTimeout(set_selected(),"500");
             },
             error: function(data) { 
                 console.log(data);
             }
    });

});

//seleziona regione prov e comune corretti nel dropdown
function set_selected()
{
    $("#select_regioni option").each(function(){
      if ($(this).text() == array_dati_associazione.r_name)
        $(this).attr("selected","selected");
    });
    $("#select_province option").each(function(){
      if ($(this).text() == array_dati_associazione.p_name)
        $(this).attr("selected","selected");
    });
    $("#select_comuni option").each(function(){
      if ($(this).text() == array_dati_associazione.c_name)
        $(this).attr("selected","selected");
    });
}