<!doctype html>
<html  lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} | @yield('document-title') </title>
    @stack('styles')
    @include('layouts.head')
    <link rel="icon" href="{{asset('images/logo-sm.png')}}">
    <link rel="stylesheet" href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
</head>
<body data-topbar="dark" style="overflow: hidden; height: 100vh">
<div class="loader-container">
    <div class="loader"></div>
</div>
@include('layouts.top-bar')
@include('layouts.sidebar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid px-3">
            @yield('page')
        </div>
    </div>
    <!-- End Page-content -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script>
                    © Gero.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted by Tarmiz
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<div class="modal fade" id="exercise-modal" tabindex="-1" aria-labelledby="exercise-modal-title" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


</body>
@include('layouts.foot')
<script>
</script>
@if(session()->has('success'))
    <script>
        $(document).ready(function (){
            toastr.success("{!!session()->get('success')!!}")
        })
    </script>
@endif
@if(session()->has('error'))
    <script>
        $(document).ready(function (){

            toastr.error("{!!session()->get('error')!!}")
        })

    </script>
@endif
@if(session()->has('warning'))
    <script>
        $(document).ready(function (){

            toastr.warning("{!!session()->get('warning')!!}")
        })

    </script>
@endif
@if(session()->has('info'))
    <script>
        $(document).ready(function (){
            toastr.info("{!!session()->get('info')!!}")
        })
    </script>
@endif
@stack('scripts')
<script>
    const __csrf_token = '{{csrf_token()}}'
</script>
</html>
