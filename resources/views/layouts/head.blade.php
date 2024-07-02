<!-- Bootstrap Css -->
@vite('resources/css/bootstrap.scss')
<!-- Icons Css -->
@vite('resources/css/icons.scss')
<!-- common used libraries -->
<link href="{{asset('libs/toastrjs/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
<link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('libs/daterangepicker/css/daterangepicker.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('libs/dropify/css/dropify.min.css')}}">
<style>
    #__locales_select ~ .select2 .select2-selection {
        background-color: transparent; !important;
        border: none !important;
    }
    #__locales_select ~ .select2 .select2-selection .select2-selection__rendered {
        color: rgba(255,255,255,.5) !important  ;
    }
</style>
<!-- App Css-->
@vite('resources/css/app.scss')
