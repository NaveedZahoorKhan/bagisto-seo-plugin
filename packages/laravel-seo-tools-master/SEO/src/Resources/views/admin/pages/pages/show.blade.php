@extends(config('seo.layout'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{pathinfo($data['record']->path,PATHINFO_BASENAME)}}</li>
@endsection
@section('header')
    <i class="fa fa-globe text-muted"></i> {{$data['record']->title}}
@endsection
@section('tools')
    &nbsp;
    <div class="btn-group">

        <a class="btn btn-outline-secondary" target="_blank" href="{{url($data['record']->path)}}">Visit Page</a>
        <a class="btn btn-outline-secondary" target="_blank"
           href="https://developers.facebook.com/tools/debug/sharing/?q={{urlencode($data['record']->getFullUrl())}}">
            <i class="fa fa-facebook-official"></i> Facebook Validate
        </a>
        <a class="btn btn-outline-secondary" href="https://cards-dev.twitter.com/validator" target="_blank">
            <i class="fa fa-twitter"></i> Twiter Card Validate
        </a>
        <a class="btn btn-outline-secondary" target="_blank"
           href="https://developers.google.com/speed/pagespeed/insights/?url={{urlencode($data['record']->getFullUrl())}}">
            <i class="fa fa-google"></i> Google Page Speed
        </a>
        <a class="btn btn-outline-secondary" href="{{route('pages.edit',$data['record']->id)}}"><i
                    class="fa fa-pencil"></i> Edit
        </a>
    </div>

@endsection
@section('content-wrapper')
    @include('seo::admin.includes.analysis')
@endSection