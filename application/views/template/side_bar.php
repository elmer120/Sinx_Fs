<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- script x orologio -->
<script src="<?php echo base_url('assets/js/get_time.js');?>"></script> 
<div class="uk-width-1-6@m">   <!-- inizio colonna 1/6 -->

        <div class="uk-text-left"> <!-- orologio -->
            <span class="uk-margin-small-right" uk-icon="clock"></span> <!-- icona -->
            <span id="clock" class="uk-text-bold"></span>
        </div>

        <!-- Calendario - jsCalendar Default theme -->
        <!--div style="" class="auto-jsCalendar" 
             data-month-format="month YYYY"
             data-day-format="DDD"
             data-language="it">
             
        </div-->

        <style>
			html, body {
				font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif;
			}

		


			#wrapper {
				margin: 5px;
				/*width: 800px;*/
				box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.4);
			}
			#wrapper .jsCalendar table {
				box-shadow: none;
			}
			.clear {
				clear: both;
			}
			#events-calendar {
				float: left;
			}
			#events {
				float: left;
				margin: 10px 20px 10px 5px;
			}
			#events .title {
				padding: 5px 0px;
				/*text-align: center;*/
				font-weight: bold;
				border-bottom: 1px solid rgba(0, 0, 0, 0.4);
			}
			#events .subtitle {
				padding: 5px 0px;
				font-size: 14px;
				/*text-align: center;*/
				color: #888;
			}
			#events .list {
				/*height: 250px;*/
				overflow-y: auto;
				border-bottom: 1px solid rgba(0, 0, 0, 0.2);
			}
			#events .list .event-item {
				line-height: 24px;
				min-height: 24px;
				padding: 2px 5px;
				border-top: 1px solid rgba(0, 0, 0, 0.2);
			}
			#events .list .event-item .close {
				font-family: Tahoma, Geneva, sans-serif;
				font-weight: bold;
				font-size: 12px;
				color: #000;
				border-radius: 8px;
				height: 14px;
				width: 14px;
				line-height: 12px;
				text-align: center;
				float: right;
				border: 1px solid rgba(0, 0, 0, 0.5);
				padding: 0px;
				margin: 5px;
				display: block;
				overflow: hidden;
				background: #F44336;
				cursor: pointer;
			}
			#events .action {
				text-align: right;
			}
			#events .action input {
				padding: 0px 5px;
				font-size: 12px;
				margin: 10px 5px;
				border: 1px solid #999999;
				height: 28px;
				line-height: 28px;
				width: 120px;
				background: #f8f8f8;
				color: black;
				cursor: pointer;
				transition: all 0.2s;
			}
			#events .action input:hover {
				background: #eee;
				border: 1px solid #000;
				box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.2);
			}
		</style>


		<!-- Wrapper -->
		<div id="wrapper">
			<!-- Calendar element -->
			<div id="events-calendar"></div>
			<!-- Events -->
			<div id="events"></div>
			<!-- Clear -->
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		
		<!-- Create the calendar -->
		<script type="text/javascript">
			// Get elements
			var elements = {
				// Calendar element
				calendar : document.getElementById("events-calendar"),
				// Input element
				events : document.getElementById("events")
			}

			// Create the calendar
			elements.calendar.className = "clean-theme";
			var calendar = jsCalendar.new({
                target : elements.calendar,
                navigator : true,
                zeroFill : true,
                monthFormat : "month YYYY",
                dayFormat : "DDD",
                language : "it"
            
            
            });

			// Create events elements
			elements.title = document.createElement("div");
			elements.title.className = "title";
			elements.events.appendChild(elements.title);
			elements.subtitle = document.createElement("div");
			elements.subtitle.className = "subtitle";
			elements.events.appendChild(elements.subtitle);
			elements.list = document.createElement("div");
			elements.list.className = "list";
			elements.events.appendChild(elements.list);
			elements.actions = document.createElement("div");
			elements.actions.className = "action";
			elements.events.appendChild(elements.actions);
			elements.addButton = document.createElement("input");
			elements.addButton.type = "button";
			elements.addButton.value = "Aggiungi";
			elements.actions.appendChild(elements.addButton);

			var events = {};
			var date_format = "DD/MM/YYYY";
			var current = null;

            // Mostra gli appuntamenti del giorno
			var showEvents = function(date){
				// Date string
				var id = jsCalendar.tools.dateToString(date, date_format, "it");
				// Set date
				current = new Date(date.getTime());
				// Set title
				elements.title.textContent = id;
				// Clear old events
				elements.list.innerHTML = "";
				// Add events on list
				if (events.hasOwnProperty(id) && events[id].length) {
					// Number of events
					elements.subtitle.textContent = events[id].length + " " + ((events[id].length > 1) ? "events" : "event");

					var div;
					var close;
					// For each event
					for (var i = 0; i < events[id].length; i++) {
						div = document.createElement("div");
						div.className = "event-item";
						div.textContent = (i + 1) + ". " + events[id][i].name;
						elements.list.appendChild(div);
						close = document.createElement("div");
						close.className = "close";
						close.textContent = "×";
						div.appendChild(close);
						close.addEventListener("click", (function (date, index) {
							return function () {
								removeEvent(date, index);
							}
						})(date, i), false);
					}
				} else {
					elements.subtitle.textContent = "Nessun evento oggi";
				}
			};

            //Rimuove appuntamento
			var removeEvent = function (date, index) {
				// Date string
				var id = jsCalendar.tools.dateToString(date, date_format, "it");

				// If no events return
				if (!events.hasOwnProperty(id)) {
					return;
				}
				// If not found
				if (events[id].length <= index) {
					return;
				}

				// Remove event
				events[id].splice(index, 1);

				// Refresh events
				showEvents(current);

				// If no events uncheck date
				if (events[id].length === 0) {
					calendar.unselect(date);
				}
			}

			
			showEvents(new Date());

			//evento visualizza appuntamenti (click su data)
			calendar.onDateClick(function(event, date){
				// Update calendar date
				calendar.set(date);
				// Show events
				showEvents(date);
			});
            
            //evento aggiunta appuntamento (click su aggiungi)
			elements.addButton.addEventListener("click", function(){
				// Get event name
				var names = ["John", "Bob", "Anna", "George", "Harry", "Jack", "Alexander"];
				var name = prompt(
					"Event info",
					names[Math. floor(Math.random() * names.length)] + "'s birthday."
				);

				//Return on cancel
				if (name === null || name === "") {
					return;
				}

				// Date string
				var id = jsCalendar.tools.dateToString(current, date_format, "it");

				// If no events, create list
				if (!events.hasOwnProperty(id)) {
					// Select date
					calendar.select(current);
					// Create list
					events[id] = [];
				}

				// Add event  
				events[id].push({name : name}); 
                
                //mando al db


				// Refresh events
				showEvents(current);
			}, false);

            function save_event(){
                $.ajax({
                type: 'POST',
                url: "<?php echo base_url("helpers/site_helper.php/save_event"); ?>",
                data: '',
                processData: false,
                contentType: false,
                success: function(data){
                  $('#select_regioni').html(data);
                  $(this).unbind(e);
                 // $('#select_regioni').trigger('click');
                },
                error: function(data) { 
                     alert("Errore nella chiamata ajax!");
                }
           });
            }

		</script>


</div> <!-- fine colonna -->