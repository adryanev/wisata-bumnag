<!DOCTYPE html>
<html lang="en" class="no-js">
@include('landing.partials.head')
<body class="is-boxed has-animations">

    <div class="body-wrap boxed-container">
        @include('landing.partials.header')
        @include('landing.main')
        @include('landing.partials.footer')
    </div>

    <script src="{{ asset('landing/js/main.min.js') }}"></script>
</body>
</html>
