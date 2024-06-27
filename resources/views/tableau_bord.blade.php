@php use Carbon\Carbon; @endphp
@extends('layouts.main')
@section('document-title','Tableau de bord')
@push('styles')
    <link href="{{ asset('libs/daterangepicker/css/daterangepicker.min.css') }}" rel="stylesheet">
    <link href="{{asset('libs/chartist/chartist.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('libs/tippy.js/tippy.css')}}">
@endpush
@section('page')
    <div class="row ">
        <div class="col-12 mb-4">
            <div class="card-title m-0 p-2 pt-0">
                <div id="__fixed"
                     class="d-flex flex-wrap flex-sm-nowrap  switch-filter justify-content-between align-items-center">
                    <h5 class="m-0 ">Tableau de bord
                    </h5>
                    <div class="page-title-right col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12 mt-2 mt-sm-0">
                        <form action="{{route('tableau_bord.liste')}}" method="get">
                            <div class="input-group  border-1 border border-light rounded" id="datepicker1">
                                <input type="text" class="form-control datepicker text-primary ps-2 "
                                       id="i_date"
                                       placeholder="mm/dd/yyyy"
                                       name="i_date" readonly>
                                <span class="input-group-text text-primary"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chiffres d'affaires -->
        <div class="col-xl-3 col-12 col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body bg-soft-success  overflow-hidden  rounded">
                    <div class="d-flex flex-nowrap align-items-center">
                        <i class="fa fa-dollar-sign text-success fa-3x"></i>
                        <div class="ms-4">
                            <h4 class="text-muted ">
                                {{number_format($chiffre_affaires['ca'],2,'.',' ')}} MAD
                            </h4>
                            <h6 class="m-0 text-muted  ">Chiffre d'affaires TTC</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12 col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body bg-soft-info  overflow-hidden  rounded">
                    <div class="d-flex flex-nowrap align-items-center">
                        <i class="fa fa-wallet text-info fa-3x"></i>
                        <div class="ms-4">
                            <h4 class="text-muted ">
                                {{number_format($chiffre_affaires['recette'],2,'.',' ')}} MAD
                            </h4>
                            <h6 class="m-0 text-muted  ">Recette TTC</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12 col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body bg-soft-warning  overflow-hidden  rounded">
                    <div class="d-flex flex-nowrap align-items-center">
                        <i class="fa fa-file-invoice text-warning fa-3x"></i>
                        <div class="ms-4">
                            <h4 class="text-muted ">
                                {{number_format($chiffre_affaires['creance'],2,'.',' ')}} MAD
                            </h4>
                            <h6 class="m-0 text-muted  ">Créance TTC</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12 col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body bg-soft-danger  overflow-hidden  rounded">
                    <div class="d-flex flex-nowrap align-items-center">
                        <i class="fa fa-shopping-cart text-danger fa-3x"></i>
                        <div class="ms-4">
                            <h4 class="text-muted ">
                                {{number_format($chiffre_affaires['total_av'],2,'.',' ')}} MAD
                            </h4>
                            <h6 class="m-0 text-muted  ">Total d'avoir TTC</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Charges -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5 class="text-black-50">Charges</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-3 xol-12 col-md-6">
                            <div class="border p-3 rounded shadow-sm">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 bg-success rounded-circle"
                                             style="width: 10px;height: 10px;"></div>
                                        <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total des
                                            Achats </h5>
                                    </div>
                                    <i class="fa fa-question-circle text-info tippy-btn"
                                       title="Somme du total TTC des documents de décaissement d'achat."
                                       data-tippy-placement="top"></i>
                                </div>
                                <div class="d-flex align-items-end">
                                    <h4 style="width: 100%"
                                        class="mb-1 text-danger border-bottom border-2 border-success me-2"></h4>
                                    <h4 class="m-0 text-end text-muted"
                                        style="white-space: nowrap;">{{number_format($charges['total_faa'],2,'.',' ')}}
                                        MAD</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 xol-12 col-md-6">
                            <div class="border p-3 rounded shadow-sm">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 bg-info rounded-circle"
                                             style="width: 10px;height: 10px;"></div>
                                        <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total des Dettes</h5>
                                    </div>
                                    <i class="fa fa-question-circle text-info tippy-btn"
                                       title="Somme du montant impayé des documents de décaissement d'achat."
                                       data-tippy-placement="top"></i>
                                </div>
                                <div class="d-flex align-items-end">
                                    <h4 style="width: 100%"
                                        class="mb-1 text-danger border-bottom border-2 border-info me-2"></h4>
                                    <h4 class="m-0 text-end text-muted"
                                        style="white-space: nowrap;">{{number_format($charges['dettes'],2,'.',' ')}}
                                        MAD</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 xol-12 col-md-6">
                            <div class="border p-3 rounded shadow-sm">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 bg-warning rounded-circle" style="width: 10px;height: 10px;"></div>
                                        <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total des dépenses</h5>
                                    </div>
                                    <i class="fa fa-question-circle text-info tippy-btn"
                                       title="Somme de dépenses"
                                       data-tippy-placement="top"></i>
                                </div>
                                <div class="d-flex align-items-end">
                                    <h4 style="width: 100%"
                                        class="mb-1  border-bottom border-2 border-warning me-2"></h4>
                                    <h4 class="m-0 text-end text-muted"
                                        style="white-space: nowrap;">{{number_format($charges['total_depense'],2,'.',' ')}}
                                        MAD</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 xol-12 col-md-6">
                            <div class="border p-3 rounded shadow-sm">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center ">
                                    <div class="me-2 bg-danger rounded-circle" style="width: 10px;height: 10px;"></div>
                                    <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total Décaissements</h5>
                                </div>
                                    <i class="fa fa-question-circle text-info tippy-btn"
                                       title="Tous les décaissements sauf les opérations bancaires."
                                       data-tippy-placement="top"></i>
                                </div>
                                <div class="d-flex align-items-end">
                                    <h4 style="width: 100%"
                                        class="mb-1 text-danger border-bottom border-2 border-danger me-2"></h4>
                                    <h4 class="m-0 text-end text-muted"
                                        style="white-space: nowrap;">{{number_format($charges['total_decaissement'],2,'.',' ')}}
                                        MAD</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Suivi -->
        <div class="col-xl-3 col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        {{--                        <span class="float-end text-muted font-size-12">{{$date_picker_start}}-{{$date_picker_end}}</span>--}}
                        <h5 class="text-black-50">Suivi des ventes</h5>
                    </div>
                    <div class="card mb-0 overview shadow-none">
                        <div class="card-body border-bottom">
                            <div class="">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <div class="overview-content">
                                            <i class="mdi mdi-paperclip  text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 text-end">
                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.dvs')</p>
                                        <h4 class="mb-0 font-size-20">{{number_format($suivi_vente['total_dv'],2,'.',' ')}}
                                            MAD</h4>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                        <div class="card-body border-bottom">
                            <div class="">
                                <div class="row  align-items-center">
                                    <div class="col-4">
                                        <div class="overview-content">
                                            <i class="mdi mdi-inbox-full  text-purple"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 text-end">
                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.bcs')</p>
                                        <h4 class="mb-0 font-size-20">{{number_format($suivi_vente['total_bc'],2,'.',' ')}}
                                            MAD</h4>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                        <div class="card-body border-bottom">
                            <div class="">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <div class="overview-content">
                                            <i class="mdi mdi-dolly text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 text-end">
                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.bls')</p>
                                        <h4 class="mb-0 font-size-20">{{number_format($suivi_vente['total_bl'],2,'.',' ')}}
                                            MAD</h4>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="row  align-items-center">
                                    <div class="col-4">
                                        <div class="overview-content">
                                            <i class="mdi mdi-backup-restore text-pink"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 text-end">
                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.brs')</p>
                                        <h4 class="mb-0 font-size-20">{{number_format($suivi_vente['total_br'],2,'.',' ')}}
                                            MAD</h4>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card" style="height: calc(100% - 24px)">
                <div class="card-body">
                    <div class="card-title">
                        <h5 class="text-black-50">Aperçu graphique annuel</h5>
                    </div>
                    <div id="morris-line-chart">

                    </div>
                </div>
            </div>
        </div>
        <!-- Facture en echeance -->
        <div class="col-xl-5 col-12 col-md-6">
            <div class="card" style="height: 26.5rem">
                <div class="card-body d-flex flex-column h-100">
                    <div class="card-title">
                        <h5 class="text-black-50">Factures en échéance </h5>
                    </div>
                    <div class="card mb-0 overview shadow-none pt-3 overflow-y-scroll h-100">
                        <table class="table table-bordered table-striped" style="border-collapse: collapse !important;">
                            <thead>
                            <tr>
                                <th>Facture</th>
                                <th>Total</th>
                                <th>Montant a payé</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($factures_echeance as $facture)
                                <tr>
                                    <td>{{$facture->reference}}</td>
                                    <td>{{number_format($facture->total_ttc,2,'.',' ')}} MAD</td>
                                    <td>{{number_format($facture->solde,2,'.',' ')}} MAD</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="23" class="text-center">Aucun facture</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Alerte de stock -->
        <div class="col-xl-4 col-12 col-md-6">
            <div class="card" style="height: 26.5rem">
                <div class="card-body d-flex flex-column h-100">
                    <div class="card-title">
                        <h5 class="text-black-50">Alerte de stock </h5>
                    </div>
                    <div class=" mb-0 overview shadow-none pt-3 overflow-y-scroll " >
                        <table class="table table-bordered table-striped" style="border-collapse: collapse !important;">
                            <thead>
                            <tr>
                                <th>Article</th>
                                <th>Quantité</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($alerte_stock as $article)
                                <tr>
                                    <td>{{$article->reference}}</td>
                                    <td>{{number_format($article->quantite,2,'.',' ')}} MAD</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Aucun article</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Suivi document -->
        @foreach($suivi_documents as $suivi_document)
            @include('partials.suivi_document')
        @endforeach

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('libs/daterangepicker/js/daterangepicker.js') }}"></script>
    <!-- Plugin Js-->
    <script src="{{asset("libs/chartist/chartist.min.js")}}"></script>
    <script src="{{asset("libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js")}}"></script>
    <script src="{{asset('libs/morris.js/morris.min.js')}}"></script>
    <script src="{{asset('libs/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('libs/tippy.js/tippy.standalone.min.js')}}"></script>
    <script src="{{asset('libs/tippy.js/tippy.all.min.js')}}"></script>
    <!-- Peity chart-->
    <script src="{{asset('libs/peity/jquery.peity.min.js')}}"></script>
    <script>
        $('.peity-line').each(function () {
            $(this).peity("line", $(this).data());
        });
        var line = new Morris.Line({
            element: 'morris-line-chart',
            resize: false,
            data: @json($chart),
            xkey: 'y',
            ykeys: ['ca', 'depenses', 'commandes', 'achats', 'encaissement'],
            labels: ['CA', 'Depenses', 'Commandes', 'Achats', 'Encaissement'],
            gridLineColor: 'rgba(108, 120, 151, 0.2)',
            lineColors: ['#0acf97', '#44a2d2', '#f9bc0b', '#f1556c', '#3b5461'],
            lineWidth: 2,
            parseTime: false,
            hideHover: 'auto'
        });
    </script>
    <script>
        @php
            $exercice = session()->get('exercice')
        @endphp
        const __datepicker_dates = {
            "Trimestre 1": ['{{Carbon::today()->setYear($exercice)->firstOfYear()->format('d/m/Y')}}', '{{Carbon::today()->setYear($exercice)->setMonth(3)->lastOfMonth()->format('d/m/Y')}}'],
            'Trimestre 2': ['{{Carbon::now()->setYear($exercice)->setMonth(4)->firstOfMonth()->format('d/m/Y')}}', '{{Carbon::now()->setYear($exercice)->setMonth(6)->lastOfMonth()->format('d/m/Y')}}'],
            'Trimestre 3': ['{{Carbon::now()->setYear($exercice)->setMonth(7)->firstOfMonth()->format('d/m/Y')}}', '{{Carbon::now()->setYear($exercice)->setMonth(9)->lastOfMonth()->format('d/m/Y')}}'],
            'Trimestre 4': ['{{Carbon::now()->setYear($exercice)->setMonth(10)->firstOfMonth()->format('d/m/Y')}}', '{{Carbon::now()->setYear($exercice)->setMonth(12)->lastOfMonth()->format('d/m/Y')}}'],
            'Les 30 derniers jours': ['{{Carbon::today()->setYear($exercice)->subDays(29)->format('d/m/Y')}}', '{{Carbon::today()->setYear($exercice)->format('d/m/Y')}}'],
            'Ce mois-ci': ['{{Carbon::today()->firstOfMonth()->setYear($exercice)->format('d/m/Y')}}', '{{Carbon::today()->setYear($exercice)->lastOfMonth()->format('d/m/Y')}}'],
            'Le mois dernier': ['{{Carbon::today()->setYear($exercice)->subMonths(1)->firstOfMonth()->format('d/m/Y')}}', '{{Carbon::today()->subMonths(1)->lastOfMonth()->format('d/m/Y')}}'],
            'Cette exercice': ['{{Carbon::today()->setYear($exercice)->firstOfYear()->format('d/m/Y')}}', '{{Carbon::today()->setYear($exercice)->lastOfYear()->format('d/m/Y')}}'],
        };
        const __datepicker_start_date = '{{$date_picker_start}}';
        const __datepicker_end_date = '{{$date_picker_end}}';
        const __datepicker_min_date = '{{Carbon::today()->setYear($exercice)->firstOfYear()->format('d/m/Y')}}';
        const __datepicker_max_date = '{{Carbon::today()->setYear($exercice)->lastOfYear()->format('d/m/Y')}}';
        $('.datepicker').daterangepicker({
            ranges: __datepicker_dates,
            locale: {
                format: "DD/MM/YYYY",
                separator: " - ",
                applyLabel: "Appliquer",
                cancelLabel: "Annuler",
                fromLabel: "De",
                toLabel: "à",
                customRangeLabel: "Plage personnalisée",
                weekLabel: "S",
                daysOfWeek: [
                    "Di",
                    "Lu",
                    "Ma",
                    "Me",
                    "Je",
                    "Ve",
                    "Sa"
                ],
                monthNames: [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                firstDay: 1
            },
            startDate: __datepicker_start_date,
            endDate: __datepicker_end_date,
            minDate: __datepicker_min_date,
            maxDate: __datepicker_max_date
        })
        $('#i_date').change(function () {
            $(this).closest('form').submit()
        })
    </script>
    <script>
        tippy(".tippy-btn")
    </script>
@endpush
