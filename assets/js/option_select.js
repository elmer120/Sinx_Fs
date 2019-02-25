
  //seleziona option corretta nel dropdown
  function set_selected(element_id,text_to_select)
  {
     $("#"+element_id+" option").each(function(){
       if ($(this).text() == text_to_select)
         $(this).attr("selected","selected");
       });
  }

    //prima dell'invio del form riabilita il select province e select comuni
  function set_enable()
  {
    $("#select_province").attr("disabled",false);
    $("#select_comuni").attr("disabled",false);
  }
  