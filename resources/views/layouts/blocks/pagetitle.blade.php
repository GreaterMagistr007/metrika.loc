@if (isset($pageTitle))
<div class="pagetitle">
    <h1>{!! $pageTitle !!}</h1>
    @if (isset($breadCrumbs) && count($breadCrumbs) > 1)
        <nav>
            <ol class="breadcrumb">
                @foreach($breadCrumbs as $breadCrumb)
                    @if ($loop->last)
                        <li class="breadcrumb-item active">{!! $breadCrumb['title'] !!}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{!! $breadCrumb['url'] !!}">{!! $breadCrumb['title'] !!}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    @endif
</div><!-- End Page Title -->
@endif
