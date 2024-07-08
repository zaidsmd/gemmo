@extends('layouts.main')
@section('document-title','Matériaux')
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
                        <div id="__fixed"  class="d-flex switch-filter justify-content-between align-items-center">
                            <h5 class="m-0"> <i class="fa  fas fa-boxes me-2 text-secondary"></i>Liste des matériaux</h5>
                            <div class="page-title-right">
                                <a href="{{route('materiels.ajouter')}}" class="btn btn-soft-secondary" ><i class="mdi mdi-plus"></i> Ajouter
                                </a>
                            </div>
                        </div>
                        <hr class="border">
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
                                        <th>SN</th>
                                        <th>Inventaire</th>
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
        const __dataTable_columns =  [
            {data: 'selectable_td', orderable: false, searchable: false, class: 'check_sell'},
            {data: 'nom', name: 'nom'},
            {data: 'marque', name: 'marque'},
            {data: 'serial', name: 'serial'},
            {data: 'inventaire', name: 'inventaire'},
            {data: 'actions', name: 'actions', orderable: false,},
        ];
        const __dataTable_ajax_link = "{{ route('materiels.liste') }}";
        const __dataTable_id = "#datatable";
    </script>
    <script src="{{asset('js/dataTable_init.js')}}" ></script>
@endpush
