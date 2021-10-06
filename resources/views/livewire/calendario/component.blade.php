
<div class="container" >

    <div id='calendar-container'>

        <br>
        <br>
        <div id='calendar'>

        </div>
        {{-- MODAL --}}

        <!-- Modal -->
        <div class="modal fade" id="theModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion de cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
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
                   select: function(){
                    //$('#theModal').modal('toggle');
                   },
                    //  dateClick(info) {
                    //      var titulo = prompt('ingrese el titulo');
                    //      var date = new Date(info.dateStr + 'T00:00:00');
                    //         console.log(events);
                    //  },

                    eventClick: function(info){
                        //alert('Paciente: ' + info.event.title);
                        $('#theModal').modal('toggle');
                    },

                   });
                calendar.render();

            });


      </script>
       <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />


    </div>

</div>





