//Riceve l'ora dal server in real time
(function get_time()
{var source = new EventSource('http://localhost/sinxEasy/assets/php/set_time.php');

source.addEventListener('message',function (event)
  {document.getElementById("clock").innerHTML=event.data;},false);

source.addEventListener('error', function(event) { 
if (event.readyState === EventSource.CLOSED)
{get_time();}},false);
})();