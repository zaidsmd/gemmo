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
                </div>
            </div>
        </div>
        <!-- Chiffres d'affaires -->
        <!-- Charges -->
        <div class="row mt-2">
            <div class="col-xl-3 col-12 col-md-6 mt-3">
                <div class="border p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-2 bg-primary rounded-circle"
                                 style="width: 10px;height: 10px;"></div>
                            <h5 class="m-0  text-black-50 text-uppercase font-size-13">Nombre de matériaux</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <h4 style="width: 100%"
                            class="mb-1 text-danger border-bottom border-2 border-primary me-2"></h4>
                        <h4 class="m-0 text-end text-muted"
                            style="white-space: nowrap;">{{$material_total}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-12 col-md-6 mt-3">
                <div class="border p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-2 bg-secondary rounded-circle"
                                 style="width: 10px;height: 10px;"></div>
                            <h5 class="m-0  text-black-50 text-uppercase font-size-13">Catégorie des matériaux</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <h4 style="width: 100%"
                            class="mb-1 text-danger border-bottom border-2 border-secondary me-2"></h4>
                        <h4 class="m-0 text-end text-muted"
                            style="white-space: nowrap;">{{$categorie_materiel_total}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-12 col-md-6 mt-3">
                <div class="border p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-2 bg-warning rounded-circle" style="width: 10px;height: 10px;"></div>
                            <h5 class="m-0  text-black-50 text-uppercase font-size-13">Nombre des licences</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <h4 style="width: 100%"
                            class="mb-1  border-bottom border-2 border-warning me-2"></h4>
                        <h4 class="m-0 text-end text-muted"
                            style="white-space: nowrap;">{{$licences_total}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-12 col-md-6 mt-3">
                <div class="border p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center ">
                            <div class="me-2 bg-danger rounded-circle" style="width: 10px;height: 10px;"></div>
                            <h5 class="m-0  text-black-50 text-uppercase font-size-13">Catégorie des licences</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <h4 style="width: 100%"
                            class="mb-1 text-danger border-bottom border-2 border-danger me-2"></h4>
                        <h4 class="m-0 text-end text-muted"
                            style="white-space: nowrap;">{{$categorie_licence_total}}</h4>
                    </div>
                </div>
            </div>
            <div class=" col-md-6 col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Licences presque expirées</h5>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Licence</th>
                                <th>Date d'expiration</th>
                                <th style="width: 1%;white-space: nowrap" >Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($licences as $licence)
                                <tr>
                                    <td>{{$licence->nom}}</td>
                                    <td>{{$licence->date_expiration}}</td>
                                    <td><a href="{{route('licences.afficher',$licence->id)}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="100" >Aucun Licence</td>
                                    </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Suivi -->
    </div>
@endsection
@push('scripts')
@endpush
