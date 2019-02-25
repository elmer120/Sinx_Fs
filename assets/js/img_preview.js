//crea l'anteprima del immagine caricata
function previewFile() {
    var preview = $("#preview"); //recupero elemento dove verrà caricata l'immagine
    var file    = $("input[type='file']")[0].files[0]; //recupero il file
    if(file.size>parseInt(2048000))
    {
      alert("Max file allowed: 2 MB!");
      $("#file").empty();
      $("#filename").empty();
      return false;
    }
    var reader  = new FileReader(); //istanzio il lettore di file
    //quando c'è un upload
    reader.addEventListener("load", function () { 
      preview.attr('src',reader.result);  //cambio il src della preview
      preview.removeClass("uk-border-circle"); //rimuove border radius
    }, false);
  
    if (file) {
      reader.readAsDataURL(file); //leggo il contenuto del file
    }
  
  }