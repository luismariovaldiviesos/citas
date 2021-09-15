@extends('layouts.theme.app')

@section('content')
<br><br>
<div class="container" id="calendar" wire:ignore>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div >

                </div>
            </div>
        </div>
    </div> --}}


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
    </script>

@endpush

@endsection


