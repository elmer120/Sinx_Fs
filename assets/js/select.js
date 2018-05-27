//Specifico per dati associazione
 $(document).ready(function() {
   set_selected();
 });
//seleziona regione corretta nel dropdown
function set_selected()
{
    $("#select_regioni option").each(function(){
      if ($(this).text() == array_dati_associazione.r_name)
        $(this).attr("selected","selected");
    });
}

//prima dell'invio del form riabilita il select province e select comuni
function set_enable()
{
  $("#select_province").attr("disabled",false);
  $("#select_comuni").attr("disabled",false);
}