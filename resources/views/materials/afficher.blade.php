@extends('layouts.main')
@section('document-title','Matériel')
@push('styles')
@endpush
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <!-- #####--Card Title--##### -->
                        <div class="card-title">
                            <div id="__fixed" class="d-flex switch-filter justify-content-between align-items-center">
                                <h5 class="m-0"><i class="fa  fas fa-boxes me-2 text-secondary"></i>Matériel: {{$materiel->nom}}</h5>
                                <div>
                                    <a href="{{route('materiels.modifier',$materiel->id)}}" class="btn btn-soft-warning"  ><i class="fa fa-edit me-2"></i> Modifier</a>
                                @if($materiel->employe()->exists())
                                        <button class="btn btn-soft-danger" data-bs-target="#detach-modal" data-bs-toggle="modal" ><i class="fa fa-external-link-alt me-2"></i> Détacher</button>
                                    @else
                                        <button class="btn btn-soft-secondary" data-bs-target="#materiel-modal" data-bs-toggle="modal" ><i class="fa fa-link me-2"></i> Attacher</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-4  col-md-6 col-12">
            <div class="card overflow-hidden">
                <div class="rounded overflow-hidden "
                     style="max-width: 100%">
                    @if($materiel->image)
                        <img src="{{asset('storage/materiels/'.$materiel->image)}}"
                             class="border-0 w-100" alt="">
                    @else
                        <img src="https://placehold.co/150x150?text={{$materiel->nom}}"
                             class="border-0 w-100" alt="">
                    @endif
                </div>
                <div class="card-body overflow-hidden p-0">
                    <div class="row mx-0">
                        <div
                            class="col-12 pb-3 text-center d-flex flex-column align-items-center ">
                            <h2 class="text-center  mt-3 mb-0">{{$materiel->nom}} </h2>
                            <h5 class="text-center text-secondary mt-2">{{\App\Models\Materiel::STATUS[$materiel->statut]}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9 col-xl-8 col-md-6 col-12 d-flex">
            <div class="card w-100">
                <div class="card-body">
                    <div class="card-title">
                        <h5>
                            Information de matériel
                        </h5>
                        <hr class="border">
                    </div>
                    <div class="row">
                        <div class=" col-xl-3 col-lg-6  my-1   d-flex align-items-center">
                            <div class="rounded bg-info  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-filter text-white fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Category</span>
                                <p class="mb-0 h5 text-black">{{$materiel->category->nom ?? '---'}}</p>
                            </div>
                        </div>
                        <div class=" col-xl-3 col-lg-6  my-1   d-flex align-items-center">
                            <div class="rounded bg-warning  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-copyright text-white fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Marque</span>
                                <p class="mb-0 h5 text-black">{{$materiel->marque ?? '---'}}</p>
                            </div>
                        </div>
                        <div class=" col-xl-3 col-lg-6  my-1  d-flex align-items-center">
                            <div class="rounded bg-secondary  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-barcode text-white fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Numéro de série</span>
                                <p class="mb-0 h5 text-black">{{$materiel->serial}}</p>
                            </div>
                        </div>
                        <div class=" col-xl-3 col-lg-6  my-1 d-flex align-items-center">
                            <div class="rounded bg-danger  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-qrcode text-white fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Numéro d'inventaire</span>
                                <p class="mb-0 h5 text-black">{{$materiel->inventaire ?? '---'}} </p>
                            </div>
                        </div>
                        <div class=" col-xl-3 col-lg-6  my-1 d-flex align-items-center">
                            <div class="rounded bg-soft-info  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-dollar-sign text-info fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Prix d'achat</span>
                                <p class="mb-0 h5 text-black">{{$materiel->prix_achat ? number_format($materiel->prix_achat,2,'.',' ')  : '0.00 MAD'}} </p>
                            </div>
                        </div>
                        <div class=" col-xl-3 col-lg-6  my-1 d-flex align-items-center">
                            <div class="rounded bg-soft-warning  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-box text-warning fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Quantité</span>
                                <p class="mb-0 h5 text-black">{{$materiel->quantite ? number_format($materiel->quantite)  : '0'}} </p>
                            </div>
                        </div>
                        <div class=" col-xl-3 col-lg-6  my-1 d-flex align-items-center">
                            <div class="rounded bg-soft-secondary  p-2 d-flex align-items-center justify-content-center"
                                 style="width: 49px">
                                <i class="fa fa-building text-secondary fa-2x"></i>
                            </div>
                            <div class="ms-3 ">
                                <span class="font-weight-bolder font-size-sm">Emplacement</span>
                                <p class="mb-0 h5 text-black">{{$materiel->departement ? $materiel->departement->nom :'---'}} </p>
                            </div>
                        </div>
                        @if($materiel->employe()->exists())
                            <div class=" col-xl-3 col-lg-6  my-1 d-flex align-items-center">
                                <div class="rounded bg-soft-danger  p-2 d-flex align-items-center justify-content-center"
                                     style="width: 49px">
                                    <i class="fa fa-user text-danger fa-2x"></i>
                                </div>
                                <div class="ms-3 ">
                                    <span class="font-weight-bolder font-size-sm">Employé attaché</span>
                                    <p class="mb-0 h5 text-black">{{$materiel->employe->first()->name}} </p>
                                </div>
                            </div>
                        @endif

                        <div class="bg-soft-light text-primary rounded w-100 h-100 p-3">
                            {{$materiel->description ?? 'Acune déscription'}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Historique</h5>
                        <hr class="border">
                    </div>
                    <table class="table table-bordered table-stripped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($historique as $item)
                            <tr>
                                <td>{{$item->date}}</td>
                                <td>{{$item->action}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="materiel-modal" tabindex="-1" aria-labelledby="add-cat-modal-title" aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center" id="add-cat-modal-title">Attacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('materiels.attacher')}}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="materiel" value="{{$materiel->id}}">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label required " for="user">Employé</label>
                                <select name="user" id="user"></select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button class="btn btn-primary">Attacher</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="detach-modal" tabindex="-1" aria-labelledby="add-cat-modal-title" aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center" id="add-cat-modal-title">Détacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('materiels.dettacher',$materiel->id)}}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <p>Voulez-vous vraiment détacher ce matériel ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button class="btn btn-warning">Détacher</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@push('scripts')
    <script>
        $('#user').select2({
            width: "100%",
            placeholder: "Sélectionnez un employé",
            minimumInputLength: 3, // Specify the ajax options for loading the product data
            dropdownParent: $('#materiel-modal'),
            ajax: {
                // The URL of your server endpoint that returns the product data
                url: "{{route('users.select')}}",
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
    </script>
@endpush
