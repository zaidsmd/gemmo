@extends('layouts.main')
@section('document-title','Matériel')
@push('styles')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <!-- #####--Card Title--##### -->
                        <div class="card-title">
                            <div id="__fixed" class="d-flex switch-filter justify-content-between align-items-center">
                                <h5 class="m-0"><i class="fa  fas fa-boxes me-2 text-success"></i>Matériel: {{$materiel->nom}}</h5>
                            </div>
                            <hr class="border">
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
