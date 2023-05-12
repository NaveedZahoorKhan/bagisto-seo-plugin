@extends(config('seo.layout'))

@section('page_title')
    Meta Tags - SEO
@endsection


@section('content-wrapper')
    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>Meta Tags</h1>
            </div>

            <div class="page-actions">
                <a class="btn btn-sm btn-primary" href="{{ route('meta-tags.create') }}">
                    <i class="icon-plus-circle"></i> {{ __('seo::admin.app.meta-tags.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="table">
                @include('seo::admin.tables.meta_tag_details')
            </div>
        </div>
    </div>
@endsection
