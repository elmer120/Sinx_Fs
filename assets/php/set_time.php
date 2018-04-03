<?php
//mando l'ora al client con event.
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");
function sendMsg($msg) {
  echo "retry: 1000\n";
  echo "data: $msg" .PHP_EOL;
  echo PHP_EOL;
  ob_flush();
  flush();
}
while(true){
   sendMsg(date("H:i", time()));
   sleep(1);
   }