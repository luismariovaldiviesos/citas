
<div class="container"  wire:ignore>

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

                    <label for="" >PaACIENTE</label>
                    <input type="text" wire:model.defer="title" class="form-control" >
                    <label for="" >DE:</label>
                    <input type="text" wire:model.defer="start" disabled class="form-control" >
                    <label for="" >A:</label>
                    <input type="text" wire:model.defer="end" disabled class="form-control" >

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

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
                     dateClick(info) {
                         var titulo = prompt('ingrese el titulo');
                         var date = new Date(info.dateStr + 'T00:00:00');
                            console.log(info.dateStr);
                     },


                    // eventClick: function(info){
                    //     //alert('Paciente: ' + info.event.title);
                    //     var hi =  info.event.start.getHours();
                    //     var mi = info.event.start.getMinutes();
                    //     var hf =  info.event.end.getHours();
                    //     var mf = info.event.end.getMinutes();
                    //     @this.title =  info.event.title;
                    //     @this.start = ""+hi+":"+mi;
                    //     @this.end =  ""+hf+":"+mf;
                    //     $('#theModal').modal('toggle');
                    //     console.log(""+h+":"+m);

                    // },

                    eventClick: function(info){

                        console.log(event);
                        alert(info.event.extendedProps.estado);
                    },



                   });
                calendar.render();

            });


      </script>
       <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />


    </div>

</div>





