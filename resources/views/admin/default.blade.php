<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.partials.head')

<body class="app">

    @include('admin.partials.spinner')

    <div>
        <!-- #Left Sidebar ==================== -->
        @include('admin.partials.sidebar')

        <!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            @include('admin.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">

                        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>

                        @include('admin.partials.messages')
                        @yield('content')

                    </div>
                </div>
            </main>
            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © {{ date('Y') }} Designed by
                    <a href="https://colorlib.com" target='_blank' title="Colorlib">Colorlib</a>.
                    Developed by <a href="https://topapp.id/">TopApp.id</a>.
                    All rights
                    reserved.</span>
            </footer>
        </div>
    </div>


    <script src="{{ mix('/js/app.js') }}"></script>
    <!-- Global js content -->

    <!-- End of global js content-->

    <!-- Specific js content placeholder -->
    @stack('js')
    <!-- End of specific js content placeholder -->
    <script>
        let channel = window.Echo.private('App.Models.User.{{ Auth::user()->id }}');
        channel.notification((data) => {
            window.Toastify({
                text: data.body
                , duration: -1
                , close: true
                , gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "#E42C24"
                , }
                , onClick: function() {} // Callback after click
            }).showToast();

        })

    </script>

</body>

</html>
