@extends('layouts.theme.app')
@section('content')

@can('ver_estadistica')

<div id="dash" class="main-content">

    <div class="row">
        <div class="col-lg-8">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">
                            <h1>Estadísticas Generales</h1>

                            {!! $chartBalancexMes->container() !!}
                            <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
                            {{ $chartBalancexMes->script() }}


                        </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">

                        {!! $chartVentasxSemana->container() !!}

                        {{ $chartVentasxSemana->script() }}


                        </div>
                </div>
            </div>
        </div>



        <div class="col-ms-12 col-md-12 col-lg-12 mt-2">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">
                        {!! $chartVentasxMes->container() !!}
                        {{ $chartVentasxMes->script() }}
                        </div>
                </div>
            </div>
        </div>




        <div class="col-lg-6">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">
                        {!! $usuarios->container() !!}
                        {{ $usuarios->script() }}
                        </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">
                        {!! $chartpacientesxmes->container() !!}
                        {{ $chartpacientesxmes->script() }}
                        </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-ms-12 col-md-12 col-lg-12 mt-2">
            <div class="layout-px">
                <div class="widget-content-area">
                       <div class="">
                        {!! $estadoscitas->container() !!}

                        {{ $estadoscitas->script() }}
                        </div>
                </div>
            </div>
        </div> --}}

    </div>

</div>


@endcan




@push('script')





@endpush

@endsection


