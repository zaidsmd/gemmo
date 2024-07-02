@extends('layouts.main')
@section('document-title','Modifier matériel')
@push('styles')
    <link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/dropify/css/dropify.min.css')}}">

@endpush
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('materiels.mettre_a_jour',$materiel->id)}}" id="materiel_form" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        <!-- #####--Card Title--##### -->
                        <div class="card-title">
                            <div id="__fixed" class="d-flex switch-filter justify-content-between align-items-center">
                                <h5 class="m-0"><i class="fa  fas fa-boxes me-2 text-success"></i>Modifier matériel </h5>
                                <div class="page-title-right">
                                    <button  class="btn btn-soft-warning"
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
                                       name="i_nom" value="{{old('i_nom',$materiel->nom)}}">
                                @error('i_nom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_statut" class="form-label required">Statut</label>
                                <select name="i_statut" id="i_statut" class="form-control">
                                    <option @selected(old('i_statut', $materiel->statut) == "en_prod" ) value="en_prod">En production</option>
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
                                       name="i_marque" value="{{old('i_marque',$materiel->marque)}}">
                                @error('i_marque')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_serial" class="form-label">Numéro de série</label>
                                <input type="text" class="form-control @error('i_serial') is-invalid @enderror " id="i_serial"
                                       name="i_serial" value="{{old('i_serial',$materiel->serial)}}">
                                @error('i_serial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_inventaire" class="form-label">Inventaire</label>
                                <input type="text" class="form-control @error('i_inventaire') is-invalid @enderror " id="i_inventaire"
                                       name="i_inventaire" value="{{old('i_inventaire',$materiel->inventaire)}}">
                                @error('i_inventaire')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_category" class="form-label">Catégorie</label>
                                <select name="i_category" id="i_category" class="form-control">
                                    @if($materiel->category_id)
                                        <option selected value="{{$materiel->category_id}}">{{$materiel->category->nom}}</option>
                                    @endif
                                </select>
                                @error('i_category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_departement" class="form-label">Emplacement</label>
                                <select name="i_departement" id="i_departement" class="form-control">
                                    @foreach($departements as $departement)
                                        <option @selected(old('i_departement',$materiel->departement_id) == $departement->id) value="{{$departement->id}}">{{$departement->nom}}</option>
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
                                       name="i_quantite" value="{{old('i_quantite',$materiel->quantite)}}">
                                @error('i_quantite')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_prix_achat" class="form-label">Prix d'achat</label>
                                <input type="number" class="form-control @error('i_prix_achat', $materiel->prix_achat) is-invalid @enderror " id="prix_achat"
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
                                              name="i_description">{{old('i_description',$materiel->description)}}</textarea>
                                    @error('i_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-6 mt-3 ">
                                    <label for="i_image"
                                           class="form-label {{$errors->has('i_image')? 'is-invalid' : ''}}">Image</label>
                                    <input name="i_image" type="file" id="i_image" accept="image/*"
                                           @if($materiel->image) data-default-file="{{asset('storage/materiels/'.$materiel->image)}}" @endif>
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
        $('#i_statut, #i_departement').select2()
    </script>
    <script src="{{asset('libs/dropify/js/dropify.min.js')}}"></script>

    <script>
        $("#i_image").dropify({
            messages: {
                default: "Glissez-déposez un fichier ici ou cliquez",
                replace: "Glissez-déposez un fichier ou cliquez pour remplacer",
                remove: "Supprimer",
                error: "Désolé, le fichier trop volumineux",
            },
        });
        $('#i_image').on('dropify.afterClear', function(event, element) {
            if ($('#i_supprimer_image').length){
                $('#i_supprimer_image').val(1)
            }else {
                $('#materiel_form').append('<input id="i_supprimer_image" type="hidden" name="i_supprimer_image" value="1" >');
            }
        });
    </script>
@endpush
