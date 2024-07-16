@extends('layouts.main')
@section('document-title','Matériels')
@push('styles')
    @include('layouts.partials.css.__datatable_css')
    <link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
    <link href="{{asset('libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">
    <style>
        .last-col {
            width: 1%;
            white-space: nowrap;
        }
    </style>
@endpush
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- #####--Card Title--##### -->
                    <div class="card-title">
                        <div id="__fixed"  class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0"> <i class="fa  fas fa-boxes me-2 text-secondary"></i>Liste des matériels</h5>
                            <div class="page-title-right">
                                <button class="filter-btn btn btn-soft-warning"><i class="fa fa-filter"></i> Filtrer</button>
                                    <a href="{{route('materiels.ajouter')}}" class="btn btn-soft-secondary" ><i class="mdi mdi-plus"></i> Ajouter
                                </a>
                            </div>
                        </div>
                        <hr class="border">
                    </div>
                    <div class="switch-filter row px-3 d-none mt-2 mb-4">
                        <div class="card-title col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Filtres</h5>
                            </div>
                            <hr class="border">
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label" for="nom-input">Nom</label>
                            <input type="text" class="form-control" id="nom-input">
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label" for="marque-input">Marque</label>
                            <input type="text" class="form-control" id="marque-input">
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label" for="emplacement-select">Emplacement</label>
                            <select class="select2 form-control mb-3 custom-select"  id="emplacement-select">
                            </select>
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label" for="categorie-select">Catégorie</label>
                            <select class="select2 form-control mb-3 custom-select"  id="categorie-select">
                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button id="search-btn" class="btn btn-primary"><i class="mdi mdi-magnify"></i> Rechercher
                            </button>
                        </div>
                    </div>

                    <!-- #####--DataTable--##### -->
                    <div class="row">
                        <div class="card-title switch-filter d-none col-12">
                            <hr class="border">
                        </div>
                        <div class="col-12">
                            <div >
                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 20px">
                                            <input type="checkbox" class="form-check-input" id="select-all-row">
                                        </th>
                                        <th>Nom</th>
                                        <th>Marque</th>
                                        <th>Inventaire</th>
                                        <th>Emplacement</th>
                                        <th>Catégorie</th>
                                        <th style="width: 100px">Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    @include('layouts.partials.js.__datatable_js')
    <script>
        $('.filter-btn').click(e => {
            $('.switch-filter').toggleClass('d-none')
        })
        const __dataTable_columns =  [
            {data: 'selectable_td', orderable: false, searchable: false, class: 'check_sell'},
            {data: 'nom', name: 'nom'},
            {data: 'marque', name: 'marque'},
            {data: 'inventaire', name: 'inventaire'},
            {data: 'departement_id', name: 'departement_id',orderable: false,},
            {data: 'category_id', name: 'category_id' ,orderable: false,},
            {data: 'actions', name: 'actions', orderable: false,},
        ];
        const __dataTable_filter_inputs_id = {
            nom: '#nom-input',
            marque: '#marque-input',
            emplacement_id: '#emplacement-select',
            category_id: '#categorie-select',
        }
        const __dataTable_filter_trigger_button_id = '#search-btn';
        const __dataTable_ajax_link = "{{ route('materiels.liste') }}";
        const __dataTable_id = "#datatable";

        $('#emplacement-select').select2({
            width:'100%',
            placeholder: 'Sélectionnez un emplacement',
            ajax: {
                // The URL of your server endpoint that returns the product data
                url:'{{route('departements.select')}}',
                cache: true, // The type of request, GET or POST
                type: 'GET',
                processResults: function(data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                },
            },
            allowClear: true
        })
        $('#categorie-select').select2({
            width:'100%',
            placeholder: 'Sélectionnez une catégorie',
            ajax: {
                // The URL of your server endpoint that returns the product data
                url:'{{route('category.select','materiel')}}',
                cache: true, // The type of request, GET or POST
                type: 'GET',
                processResults: function(data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                },
            },
            allowClear: true
        })
    </script>
    <script src="{{asset('js/dataTable_init.js')}}" ></script>
@endpush
