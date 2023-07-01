@extends('admin::layouts.content')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
<li class="breadcrumb-item">Settings</li>
@endsection
@section('content-wrapper')
<nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-site-tab" data-toggle="tab" href="#nav-site" role="tab" aria-controls="nav-global" aria-selected="true">Site
    </a>

    <a class="nav-item nav-link" id="nav--page-meta-tags-tab" data-toggle="tab" href="#nav-page-meta-tags" role="tab" aria-controls="nav-page-meta-tags" aria-selected="false">Global Meta
    </a>

</nav>
<div class="tab-content mt-3" id="nav-tabContent">
    @include('seo::admin.tabs.site')
    @include('seo::admin.tabs.page')
</div>

@endSection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#seo-settings-tab a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        })

    });
</script>
@endsection