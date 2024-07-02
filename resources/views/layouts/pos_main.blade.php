<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | @yield('document-title') </title>
    @stack('styles')
    @include('layouts.head')
    <link rel="icon" href="{{ asset('images/logo-sm.png') }}">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
</head>

<body data-topbar="dark" style="overflow: hidden; height: 100vh">
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="main">
        <div class="page-content pt-3">
            <div class="container-fluid px-3">
                @yield('page')
            </div>
        </div>
        <!-- End Page-content -->
        <footer class="footer" style="left: 0 !important">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        © Gemmo.
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
</body>
@include('layouts.foot')
<script></script>
@if (session()->has('success'))
    <script>
        toastr.success('{!! session()->get('success') !!}')
    </script>
@endif
@if (session()->has('error'))
    <script>
        toastr.error('{!! session()->get('error') !!}')
    </script>
@endif
@if (session()->has('warning'))
    <script>
        toastr.warning('{!! session()->get('warning') !!}')
    </script>
@endif
@if (session()->has('info'))
    <script>
        toastr.info('{!! session()->get('info') !!}')
    </script>
@endif
@stack('scripts')
<script>
    const __csrf_token = '{{ csrf_token() }}';
    const __exercice_change_url = "{{ route('exercice.changer') }}";
    const __api_token = '{{Auth::user()->createToken('auth-api')->plainTextToken}}'
    const __exercice = '{{session()->get('exercice')}}';
</script>

</html>
