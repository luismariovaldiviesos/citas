@extends('layouts.theme.app')

<style>
    .confirmado {
        background-color: #5cb85c  !important;
    }
    .cancelado {
        background-color: #d9534f  !important;
    }
    .reprogramado {
        background-color: #f0ad4e  !important;
    }
    .pagado {
        background-color: #5bc0de  !important;
    }
    .parcialmente {
        background-color: #5bc0de  !important;
    }
</style>

@section('content')
<br><br>
<div class="container" id="calendar" wire:ignore>



</div>




@push('script')

    <script>
        const calendarEL =  document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEL, {
            initialView: 'dayGridMonth',
            locale: 'es',
            selectable:true,
            select: function(event){
                console.log(event)
            }
        });

        calendar.render();

        var taskEvents = [];
        let events = {!! $citas !!}


        events.forEach(event => {
            if(event.status == 'Confirmada') {
                var colorEvent = 'confirmado';
            }else if (event.status == 'Cancelado') {
                var colorEvent = 'cancelado';
            }else if (event.status == 'Reprogramado') {
                var colorEvent = 'reprogramado';
            }else if (event.status == 'Pagada') {
                var colorEvent = 'pagado';
            }else if (event.status == 'Parcialmente') {
                var colorEvent = 'parcialmente';
            }
            let taskEvent = {
                id: event.id,
                title: event.descripcion,
                start:  event.fecha_ini,
                end:  event.fecha_fin,
                className: colorEvent
            };

            taskEvents.push(taskEvent);
            console.log(event.fecha_ini);
        });

        var calendarLocale = 'es';
        var firstDay = '1';





    </script>

@endpush

@endsection


