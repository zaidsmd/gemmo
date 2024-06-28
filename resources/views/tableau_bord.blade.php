@php use Carbon\Carbon; @endphp
@extends('layouts.main')
@section('document-title','Tableau de bord')
@push('styles')
    <link href="{{ asset('libs/daterangepicker/css/daterangepicker.min.css') }}" rel="stylesheet">
    <link href="{{asset('libs/chartist/chartist.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('libs/tippy.js/tippy.css')}}">
@endpush
@section('page')
{{--    <div class="row ">--}}
{{--        <div class="col-12 mb-4">--}}
{{--            <div class="card-title m-0 p-2 pt-0">--}}
{{--                <div id="__fixed"--}}
{{--                     class="d-flex flex-wrap flex-sm-nowrap  switch-filter justify-content-between align-items-center">--}}
{{--                    <h5 class="m-0 ">Tableau de bord--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Chiffres d'affaires -->--}}
{{--        <div class="col-xl-3 col-12 col-md-6">--}}
{{--            <div class="card overflow-hidden">--}}
{{--                <div class="card-body bg-soft-success  overflow-hidden  rounded">--}}
{{--                    <div class="d-flex flex-nowrap align-items-center">--}}
{{--                        <i class="fa fa-dollar-sign text-success fa-3x"></i>--}}
{{--                        <div class="ms-4">--}}
{{--                            <h4 class="text-muted ">--}}
{{--                            </h4>--}}
{{--                            <h6 class="m-0 text-muted  ">Chiffre d'affaires TTC</h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-12 col-md-6">--}}
{{--            <div class="card overflow-hidden">--}}
{{--                <div class="card-body bg-soft-info  overflow-hidden  rounded">--}}
{{--                    <div class="d-flex flex-nowrap align-items-center">--}}
{{--                        <i class="fa fa-wallet text-info fa-3x"></i>--}}
{{--                        <div class="ms-4">--}}
{{--                            <h4 class="text-muted ">--}}
{{--                            </h4>--}}
{{--                            <h6 class="m-0 text-muted  ">Recette TTC</h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-12 col-md-6">--}}
{{--            <div class="card overflow-hidden">--}}
{{--                <div class="card-body bg-soft-warning  overflow-hidden  rounded">--}}
{{--                    <div class="d-flex flex-nowrap align-items-center">--}}
{{--                        <i class="fa fa-file-invoice text-warning fa-3x"></i>--}}
{{--                        <div class="ms-4">--}}
{{--                            <h4 class="text-muted ">--}}
{{--                            </h4>--}}
{{--                            <h6 class="m-0 text-muted  ">Créance TTC</h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-12 col-md-6">--}}
{{--            <div class="card overflow-hidden">--}}
{{--                <div class="card-body bg-soft-danger  overflow-hidden  rounded">--}}
{{--                    <div class="d-flex flex-nowrap align-items-center">--}}
{{--                        <i class="fa fa-shopping-cart text-danger fa-3x"></i>--}}
{{--                        <div class="ms-4">--}}
{{--                            <h4 class="text-muted ">--}}
{{--                            </h4>--}}
{{--                            <h6 class="m-0 text-muted  ">Total d'avoir TTC</h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Charges -->--}}
{{--        <div class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="card-title">--}}
{{--                        <h5 class="text-black-50">Charges</h5>--}}
{{--                    </div>--}}
{{--                    <div class="row mt-2">--}}
{{--                        <div class="col-xl-3 xol-12 col-md-6">--}}
{{--                            <div class="border p-3 rounded shadow-sm">--}}
{{--                                <div class="d-flex align-items-center justify-content-between mb-2">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="me-2 bg-success rounded-circle"--}}
{{--                                             style="width: 10px;height: 10px;"></div>--}}
{{--                                        <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total des--}}
{{--                                            Achats </h5>--}}
{{--                                    </div>--}}
{{--                                    <i class="fa fa-question-circle text-info tippy-btn"--}}
{{--                                       title="Somme du total TTC des documents de décaissement d'achat."--}}
{{--                                       data-tippy-placement="top"></i>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-end">--}}
{{--                                    <h4 style="width: 100%"--}}
{{--                                        class="mb-1 text-danger border-bottom border-2 border-success me-2"></h4>--}}
{{--                                    <h4 class="m-0 text-end text-muted"--}}
{{--                                        style="white-space: nowrap;">--}}
{{--                                        MAD</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-3 xol-12 col-md-6">--}}
{{--                            <div class="border p-3 rounded shadow-sm">--}}
{{--                                <div class="d-flex align-items-center justify-content-between mb-2">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="me-2 bg-info rounded-circle"--}}
{{--                                             style="width: 10px;height: 10px;"></div>--}}
{{--                                        <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total des Dettes</h5>--}}
{{--                                    </div>--}}
{{--                                    <i class="fa fa-question-circle text-info tippy-btn"--}}
{{--                                       title="Somme du montant impayé des documents de décaissement d'achat."--}}
{{--                                       data-tippy-placement="top"></i>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-end">--}}
{{--                                    <h4 style="width: 100%"--}}
{{--                                        class="mb-1 text-danger border-bottom border-2 border-info me-2"></h4>--}}
{{--                                    <h4 class="m-0 text-end text-muted"--}}
{{--                                        style="white-space: nowrap;">--}}
{{--                                        MAD</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-3 xol-12 col-md-6">--}}
{{--                            <div class="border p-3 rounded shadow-sm">--}}
{{--                                <div class="d-flex align-items-center justify-content-between mb-2">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="me-2 bg-warning rounded-circle" style="width: 10px;height: 10px;"></div>--}}
{{--                                        <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total des dépenses</h5>--}}
{{--                                    </div>--}}
{{--                                    <i class="fa fa-question-circle text-info tippy-btn"--}}
{{--                                       title="Somme de dépenses"--}}
{{--                                       data-tippy-placement="top"></i>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-end">--}}
{{--                                    <h4 style="width: 100%"--}}
{{--                                        class="mb-1  border-bottom border-2 border-warning me-2"></h4>--}}
{{--                                    <h4 class="m-0 text-end text-muted"--}}
{{--                                        style="white-space: nowrap;">--}}
{{--                                        MAD</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-3 xol-12 col-md-6">--}}
{{--                            <div class="border p-3 rounded shadow-sm">--}}
{{--                                <div class="d-flex align-items-center justify-content-between mb-2">--}}
{{--                                <div class="d-flex align-items-center ">--}}
{{--                                    <div class="me-2 bg-danger rounded-circle" style="width: 10px;height: 10px;"></div>--}}
{{--                                    <h5 class="m-0  text-black-50 text-uppercase font-size-13">Total Décaissements</h5>--}}
{{--                                </div>--}}
{{--                                    <i class="fa fa-question-circle text-info tippy-btn"--}}
{{--                                       title="Tous les décaissements sauf les opérations bancaires."--}}
{{--                                       data-tippy-placement="top"></i>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-end">--}}
{{--                                    <h4 style="width: 100%"--}}
{{--                                        class="mb-1 text-danger border-bottom border-2 border-danger me-2"></h4>--}}
{{--                                    <h4 class="m-0 text-end text-muted"--}}
{{--                                        style="white-space: nowrap;">--}}
{{--                                        MAD</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Suivi -->--}}
{{--        <div class="col-xl-3 col-12 col-md-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="card-title">--}}
{{--                        --}}{{--                        <span class="float-end text-muted font-size-12">{{$date_picker_start}}-{{$date_picker_end}}</span>--}}
{{--                        <h5 class="text-black-50">Suivi des ventes</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card mb-0 overview shadow-none">--}}
{{--                        <div class="card-body border-bottom">--}}
{{--                            <div class="">--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="overview-content">--}}
{{--                                            <i class="mdi mdi-paperclip  text-success"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-8 text-end">--}}
{{--                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.dvs')</p>--}}
{{--                                        <h4 class="mb-0 font-size-20">--}}
{{--                                            MAD</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- end row -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body border-bottom">--}}
{{--                            <div class="">--}}
{{--                                <div class="row  align-items-center">--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="overview-content">--}}
{{--                                            <i class="mdi mdi-inbox-full  text-purple"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-8 text-end">--}}
{{--                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.bcs')</p>--}}
{{--                                        <h4 class="mb-0 font-size-20">--}}
{{--                                            MAD</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- end row -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body border-bottom">--}}
{{--                            <div class="">--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="overview-content">--}}
{{--                                            <i class="mdi mdi-dolly text-warning"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-8 text-end">--}}
{{--                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.bls')</p>--}}
{{--                                        <h4 class="mb-0 font-size-20">--}}
{{--                                            MAD</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- end row -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="">--}}
{{--                                <div class="row  align-items-center">--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="overview-content">--}}
{{--                                            <i class="mdi mdi-backup-restore text-pink"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-8 text-end">--}}
{{--                                        <p class="text-muted font-size-13 mb-1">@lang('ventes.brs')</p>--}}
{{--                                        <h4 class="mb-0 font-size-20">--}}
{{--                                            MAD</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- end row -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--    </div>--}}
@endsection
@push('scripts')
@endpush
