@extends('layouts.theme.app')
@section('content')

@can('ver_estadistica')

<div id="dash" class="main-content">

    <div class="row">
        <div class="col-lg-8">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">
                            <h1>Estadísticas generales</h1>

                            {!! $chartVentasxMes->container() !!}
                                <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
                            {{ $chartVentasxMes->script() }}
                        </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">


                        </div>
                </div>
            </div>
        </div>



        <div class="col-ms-12 col-md-12 col-lg-12 mt-2">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="widget-one">

                        </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endcan




@push('script')





@endpush

@endsection


