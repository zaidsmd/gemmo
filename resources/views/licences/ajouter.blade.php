@extends('layouts.main')
@section('document-title','Ajouter licence')
@push('styles')
    <link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
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
                    <form action="{{route('licences.sauvegarder')}}" method="post">

                        <!-- #####--Card Title--##### -->
                        <div class="card-title">
                            <div id="__fixed" class="d-flex switch-filter justify-content-between align-items-center">
                                <h5 class="m-0"><i class="fa  fas fa-boxes me-2 text-success"></i>Ajouter une licence
                                </h5>
                                <div class="page-title-right">
                                    <button class="btn btn-soft-info"
                                    ><i class="mdi mdi-content-save"></i> Sauvegarder
                                    </button>
                                </div>
                            </div>
                            <hr class="border">
                        </div>
                        <!-- #####--DataTable--##### -->
                        @csrf
                        <div class="row">
                            <div class="col-6 d-md-block d-none">
                                <hr class="border border-success">
                            </div>
                            <div class="col-6 d-md-block d-none">
                                <hr class="border border-info">
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_category" class="form-label">Catégorie</label>
                                        <select name="i_category" id="i_category" class="form-control"></select>
                                        @error('i_category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_nom" class="form-label required">Nom</label>
                                        <input type="text" class="form-control @error('i_nom') is-invalid @enderror "
                                               id="i_nom"
                                               name="i_nom" value="{{old('i_nom')}}">
                                        @error('i_nom')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_date_achat" class="form-label">Date d'achat</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('i_date_achat') is-invalid @enderror " id="i_date_achat"
                                                   name="i_date_achat" value="{{old('i_date_achat')}}">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                            @error('i_date_achat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_date_expiration" class="form-label">Date d'expiration</label>
                                        <div class="input-group">
                                            <input type="text"
                                                   class="form-control @error('i_date_expiration') is-invalid @enderror "
                                                   id="i_date_expiration"
                                                   name="i_date_expiration" value="{{old('i_date_expiration')}}">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                            @error('i_date_expiration')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 ">
                                        <label for="i_description" class="form-label ">Description</label>
                                        <textarea rows="8" type="text"
                                                  class="form-control @error('i_description') is-invalid @enderror "
                                                  id="i_description"
                                                  name="i_description" value="{{old('i_description')}}"></textarea>
                                        @error('i_description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_departement" class="form-label">Emplacement</label>
                                        <select name="i_departement" id="i_departement" class="form-control">
                                            <option value="">Choisir un emplacement</option>
                                            @foreach($departements as $departement)
                                                <option
                                                    @selected(old('i_departement') == $departement->id) value="{{$departement->id}}">{{$departement->nom}}</option>
                                            @endforeach
                                        </select>
                                        @error('i_departement')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_prix_achat" class="form-label">Prix d'achat</label>
                                        <div class="input-group">
                                            <input type="number"
                                                   class="form-control @error('i_prix_achat') is-invalid @enderror "
                                                   id="prix_achat"
                                                   name="i_prix_achat" value="{{old('i_prix_achat')}}">
                                            <span class="input-group-text">
                                                MAD
                                            </span>
                                            @error('i_prix_achat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <label for="i_quantite" class="form-label">Quantité</label>
                                        <input type="number"
                                               class="form-control @error('i_quantite') is-invalid @enderror "
                                               id="i_quantite"
                                               name="i_quantite" value="{{old('i_quantite')}}">
                                        @error('i_quantite')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#i_category').select2({
            width: "100%",
            placeholder: "Sélectionnez une Catégorie",
            ajax: {
                // The URL of your server endpoint that returns the product data
                url: "{{route('category.select','licence')}}",
                cache: true, // The type of request, GET or POST
                type: "GET",
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data,
                    };
                },
            },
        })
        $('#i_departement').select2()
        $('#i_date_achat , #i_date_expiration').datepicker({
            format: 'dd/mm/yyyy'
        });
    </script>
@endpush
