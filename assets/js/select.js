//seleziona regione prov e comune corretti nel dropdown
setTimeout(set_selected(),"2000");
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