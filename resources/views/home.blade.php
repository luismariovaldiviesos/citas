@extends('layouts.theme.app')
@section('content')

@can('ver_estadistica')

<div id="dash" class="main-content">

    <div class="row">
        <div class="col-lg-8">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="widget-one">
                       <p>ventas anuales</p>

                        {{-- carga la gráfica --}}
                        {{-- {!! $chartVentasxMes->container() !!} --}}
                        {{-- fin grafica --}}

                        {{-- otra manera de cargar la libreria desde los archivos del proyecto --}}
                        <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
                        {{-- fin carga de libreria  --}}

                        {{-- {{ $chartVentasxMes->script() }} --}}
                        </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="widget-one">
                          ventas semana
                          {{-- {!! $chartVentasxSemana->container() !!} --}}

                          {{-- esta es otro forma de cargar la libreria desde el cdn --}}
                          {{-- <script src="{{ LarapexChart::cdn() }}"></script> --}}
                          {{-- fin --}}

                          {{-- {{ $chartVentasxSemana->script() }} --}}

                        </div>
                </div>
            </div>
        </div>



        <div class="col-ms-12 col-md-12 col-lg-12 mt-2">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="widget-one">
                           ventas anuales

                           {{-- {!! $chartBalancexMes->container() !!} --}}

                           {{-- esta es otro forma de cargar la libreria desde el cdn --}}
                           {{-- <script src="{{ LarapexChart::cdn() }}"></script> --}}
                           {{-- fin --}}

                           {{-- {{ $chartBalancexMes->script() }} --}}
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


