@extends('layouts.main')
@section('document-title','Ajouter employé')
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
                    <form action="{{route('users.sauvegarder')}}" method="post">
                        @csrf
                        <!-- #####--Card Title--##### -->
                        <div class="card-title">
                            <div id="__fixed" class="d-flex switch-filter justify-content-between align-items-center">
                                <h5 class="m-0"><i class="fa  fas fa-boxes me-2 text-success"></i>Ajouter un employé
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
                        <div class="row align-items-center">
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
                                <label for="i_email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('i_email') is-invalid @enderror "
                                       id="i_email"
                                       name="i_email" value="{{old('i_email')}}">
                                @error('i_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <label for="i_post" class="form-label">Post</label>
                                <input type="text" class="form-control @error('i_post') is-invalid @enderror "
                                       id="i_post"
                                       name="i_post" value="{{old('i_post')}}">
                                @error('i_post')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                                <div class="form-check-inline d-flex align-items-center mt-3">
                                    <label for="i_loggable" class="form-check-label me-2">Peut se connecter</label>
                                    <input name="i_loggable" value="1" type="checkbox" id="i_loggable" switch="bool">
                                    <label for="i_loggable" data-on-label="Oui" data-off-label="Non"></label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 mt-3 d-none" id="password-container">
                                <label for="i_password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('i_password') is-invalid @enderror "
                                       id="i_password"
                                       name="i_password">
                                @error('i_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('libs/select2/js/select2.min.js')}}"></script>
    <script>
        $('#i_category').select2()
        $('#i_statut').select2()
        $('#i_loggable').on('change', function () {
            if ($(this).is(':checked')) {
                $('#password-container').removeClass('d-none')
            } else {
                $('#password-container').addClass('d-none')
            }
        })
    </script>
@endpush
