
<div class="container">

    <div id='calendar-container' wire:ignore>

        <br>
        <br>
        <div id='calendar'>

        </div>


      <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>


      <script>

            window.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var data =   @this.events;
                var calendar = new Calendar(calendarEl,
                 {
                   initialView: 'dayGridMonth',
                   locale: "es",
                   timeZone: 'local',
                   headerToolbar: {
                       left: 'prev,next today',
                       center: 'title',
                       right: 'dayGridMonth, timeGridWeek,listWeek,timeGridDay'
                   },
                   selectable:true,
                   events: JSON.parse(data), // carga data del metodo
                   select: function(event){
                       console.log(event);
                   }

                    //  dateClick(info) {
                    //      var titulo = prompt('ingrese el titulo');
                    //      var date = new Date(info.dateStr + 'T00:00:00');
                    //         console.log(events);
                    //  },

                   });
                calendar.render();

            });


      </script>
       <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />


    </div>

</div>





