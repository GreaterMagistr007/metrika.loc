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

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @yield('content')

</main><!-- End #main -->

@include('layouts.blocks.footer')

@include('layouts.blocks.button-scroll-up')
@include('layouts.blocks.theme-scripts')

</body>

</html>
