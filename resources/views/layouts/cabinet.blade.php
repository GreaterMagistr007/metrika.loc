@include('layouts.blocks.head')
<body>
<style>
    .hidden {
        display: none!important;
    }
</style>
@include('layouts.blocks.header')

@include('layouts.blocks.sidebar')

<main id="main" class="main">

    @include('layouts.blocks.pagetitle')

    @yield('content')

</main><!-- End #main -->

@include('layouts.blocks.footer')

@include('layouts.blocks.button-scroll-up')
@include('layouts.blocks.theme-scripts')

</body>

</html>
