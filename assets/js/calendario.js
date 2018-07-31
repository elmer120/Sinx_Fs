			//variabili globali
			var elements = {
				// Calendar element
				calendar : document.getElementById("events-calendar"),
				// Input element
				events : document.getElementById("events")
			}
			
			var events = {};
			var date_format = "DD/MM/YYYY";
			var giorno_selezionato = new Date();

			//imposta tema del calendario
			elements.calendar.className = "clean-theme";
			// costruttore crea il calendario
			var calendar = jsCalendar.new({
                target : elements.calendar,
                navigator : true,
                zeroFill : true,
                monthFormat : "month YYYY",
                dayFormat : "DDD",
                language : "it"
            });

			// crea gli elementi per gli appuntamenti
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


            //Rimuove appuntamento
			var removeEvent = function (date, index) {
				// Date string
				var id = jsCalendar.tools.dateToString(date, date_format, "it");
				var id_us = jsCalendar.tools.dateToString(giorno_selezionato, "YYYY-MM-DD", "it");
				// se non ci sono appuntamenti return
				if (!events.hasOwnProperty(id)) {
					return;
				}
				// se l'appuntamento è vuoto
				if (events[id].length <= index) {
					return;
				}
				
				// Rimuovo l'appuntamento dal database
				$.ajax({
                type: 'POST',
				async: false,
                url: "remove_event",
				data: {"title" : events[id][index].name, "date" : id_us },
				//processData: false,
                //contentType: false,
                success: function(data){
				    alert(data);
                },
                error: function(data) { 
                    alert(data);
                }
           		});
			    // Rimuovo l'appuntamento da js
				events[id].splice(index, 1);

				// se non ci sono appuntamenti deseleziono 
				if (events[id].length === 0) {
					calendar.unselect(date);
				}   
				
				// ricarico gli appuntamenti
				mostra_appuntamenti(date);

				
			}

			//evento click su data
			calendar.onDateClick(function(event, date){
				// aggiorna il calendario con la date selezionata
				calendar.set(date);
				giorno_selezionato=date;
				//mostra gli eventi
				mostra_appuntamenti(date);
			});
            
            //evento aggiunta appuntamento (click su aggiungi)
			elements.addButton.addEventListener("click", function(){
				
				//preparo le variabili
				var all_users = null;
				var name = null;
				
				
				//chiedo il nome dell'appuntamento
				name = prompt("Ricorda un appuntamento:");
				
				//annullo tutto se viene cliccato cancel
				if (name === null || name === "") {
					return;
				}
				
				//chiedo se è per tutti o meno
				if (confirm ("Se l'evento deve essere visualizzato a tutti gli utenti clicca su OK,\n altrimenti se l'evento è solo per te clicca su Cancel"))
				{
					all_users = 1;
				}
				else
				{
					all_users = 0;
								 
				}
				
				//recupero la data del giorno dell'appuntamento nel formato corretto x il db
				var date = jsCalendar.tools.dateToString(giorno_selezionato, "YYYY-MM-DD", "it");
				var id = jsCalendar.tools.dateToString(giorno_selezionato, date_format, "it");

				// If no events, create list
				if (!events.hasOwnProperty(id)) {
					// seleziono il giorno selezionato
					calendar.select(giorno_selezionato);
					// creo la lista di appuntamenti
					events[id] = [];
				}

				//controllo i dati inseriti
				if(name != null && name != "" && date != null && date != "" && all_users != null)
				{
					//mando al db con ajax
						save_event(name,date,all_users);
				}
				else
				{ alert('Errore dati inseriti nulli!!');
				return; }

				// Refresh appuntamenti
				mostra_appuntamenti(giorno_selezionato);

			}, false);

			//salva un nuovo appuntamento nel database ajax
            function save_event(title,date,all_users){
                $.ajax({
                type: 'POST',
                url: "save_event",
                data: {"title" : title, "date" : date, "all_users" : all_users},
                //processData: false,
                //contentType: false,
                success: function(data){
					alert(data);
                },
                error: function(data) { 
                     alert(data);
                }
           });
            }

			//recupera e visualizza gli appuntamenti in calendario
			function mostra_appuntamenti(date){
                $.ajax({
                type: 'POST',
				async: false,
                url: "get_events",
				//processData: false,
                //contentType: false,
                success: function(data){
					data = $.parseJSON(data);
				// Date string
				var id = jsCalendar.tools.dateToString(date,date_format, "it");
				// Set title
				elements.title.textContent = id;
				// Clear old events
				elements.list.innerHTML = "";
				
				//per ogni appuntamento recuperato dal db
				
				events={};
				for (var i = 0; i < data.length; i++) { 
					// viene aggiunto al calendatio
					var tmp=data[i].date;
					if(events[tmp]==undefined)
					{	
						events[tmp]=[];
						calendar.select(tmp);
					}
					events[data[i].date].push({ name : data[i].title }); 
				    
				}
				
				// se ci sono appuntamenti per la data selezionata
				if (events.hasOwnProperty(id) && events[id].length) {
					// numero di appuntamento
					elements.subtitle.textContent = events[id].length + " " + ((events[id].length > 1) ? "appuntamenti" : "appuntamento");

					var div;
					var close;
					//per ogni appuntamento
					for (var i = 0; i < events[id].length; i++) {
						div = document.createElement("div");
						div.className = "event-item";
						div.textContent = (i + 1) + ". " + events[id][i].name;
						elements.list.appendChild(div);
						close = document.createElement("div");
						close.className = "close";
						close.textContent = "×";
						div.appendChild(close);
						//imposto l'evento rimuovi sulla 'x' dell'appuntamento
						close.addEventListener("click", (function (date, index) {
							return function () {
								removeEvent(date, index);
							}
						})(date, i), false);
					}
				} else {
					elements.subtitle.textContent = "Nessun appuntamento oggi";
				}
				
                },
                error: function(data) { 
                     alert(data);
                }
           });
            }

			mostra_appuntamenti(giorno_selezionato);
