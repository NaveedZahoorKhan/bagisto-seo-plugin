@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('meta-tags.index')}}">Meta Tags</a></li>
    <li class="breadcrumb-item">Create</li>
@endsection
@section('tools')
@endsection
@section('content-wrapper')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    @include('seo::admin.forms.meta_tag')
                </div>
            </div>
        </div>
    </div>
@endSection