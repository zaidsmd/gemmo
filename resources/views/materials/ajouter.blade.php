@extends('layouts.main')
@section('document-title','Ajouter matériel')
@push('styles')
    @include('layouts.partials.css.__datatable_css')
    <link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
    <link href="{{asset('libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/dropify/css/dropify.min.css')}}">
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
                    <form action="{{route('materiels.sauvegarder')}}" enctype="multipart/form-data" method="post">

                        <!-- #####--Card Title--##### -->
                        <div class="card-title">
                            <div id="__fixed" class="d-flex switch-filter justify-content-between align-items-center">
                                <h5 class="m-0"><i class="fa  fas fa-boxes me-2 text-success"></i>Ajouter un matériel</h5>
                                <div class="page-title-right">
                                    <button  class="btn btn-soft-info"
                                      ><i class="mdi mdi-content-save"></i> Sauvegarder
                                    </button>
                                </div>
                            </div>
                            <hr class="border">
                        </div>
                        <!-- #####--DataTable--##### -->
                        @csrf
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_nom" class="form-label required">Nom</label>
                                <input type="text" class="form-control @error('i_nom') is-invalid @enderror " id="i_nom"
                                       name="i_nom" value="{{old('i_nom')}}">
                                @error('i_nom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_statut" class="form-label required">Statut</label>
                                <select name="i_statut" id="i_statut" class="form-control">
                                    <option value="en_prod">En production</option>
                                </select>
                                @error('i_statut')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_marque" class="form-label">Marque</label>
                                <input type="text" class="form-control @error('i_marque') is-invalid @enderror " id="i_marque"
                                       name="i_marque" value="{{old('i_marque')}}">
                                @error('i_marque')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_serial" class="form-label">Numéro de série</label>
                                <input type="text" class="form-control @error('i_serial') is-invalid @enderror " id="i_serial"
                                       name="i_serial" value="{{old('i_serial')}}">
                                @error('i_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_inventaire" class="form-label">Numéro d'inventaire</label>
                                <input type="text" class="form-control @error('i_inventaire') is-invalid @enderror " id="i_inventaire"
                                       name="i_inventaire" value="{{old('i_inventaire')}}">
                                @error('i_inventaire')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_category" class="form-label">Catégorie</label>
                                <select name="i_category" id="i_category" class="form-control"></select>
                                @error('i_category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_departement" class="form-label">Emplacement</label>
                                <select name="i_departement" id="i_departement" class="form-control">
                                    <option value="">Choisir un emplacement</option>
                                    @foreach($departments as $departement)
                                        <option @selected(old('i_departement') == $departement->id) value="{{$departement->id}}">{{$departement->nom}}</option>
                                    @endforeach
                                </select>
                                @error('i_departement')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_quantite" class="form-label">Quantité</label>
                                <input type="number" class="form-control @error('i_quantite') is-invalid @enderror " id="i_quantite"
                                       name="i_quantite" value="{{old('i_quantite')}}">
                                @error('i_quantite')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_prix_achat" class="form-label">Prix d'achat</label>
                                <input type="number" class="form-control @error('i_prix_achat') is-invalid @enderror " id="prix_achat"
                                       name="i_prix_achat" value="{{old('i_prix_achat')}}">
                                @error('i_prix_achat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 row p-0 m-0">
                               <div class="col-12 col-lg-6 mt-3 ">
                                   <label for="i_description" class="form-label ">Description</label>
                                   <textarea rows="8" type="text" class="form-control @error('i_description') is-invalid @enderror " id="i_description"
                                             name="i_description" value="{{old('i_description')}}"></textarea>
                                   @error('i_description')
                                   <div class="invalid-feedback">
                                       {{ $message }}
                                   </div>
                                   @enderror
                               </div>
                               <div class="col-12 col-lg-6 mt-3 ">
                                   <label for="i_image"
                                          class="form-label {{$errors->has('i_image')? 'is-invalid' : ''}}">Image</label>
                                   <input name="i_image" type="file" id="i_image" accept="image/*">
                                   <div class="invalid-feedback">
                                       @if($errors->has('i_image'))
                                           {{ $errors->first('i_image') }}
                                       @endif
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
        <script src="{{asset('libs/dropify/js/dropify.min.js')}}"></script>

    <script>
        $('#i_category').select2({
            width: "100%",
            placeholder: "Sélectionnez une Catégorie",
            ajax: {
                // The URL of your server endpoint that returns the product data
                url: "{{route('category.select')}}",
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
        $('#i_statut , #i_departement').select2()
        $("#i_image").dropify({
            messages: {
                default: "Glissez-déposez un fichier ici ou cliquez",
                replace: "Glissez-déposez un fichier ou cliquez pour remplacer",
                remove: "Supprimer",
                error: "Désolé, le fichier trop volumineux",
            },
        });
    </script>
@endpush
