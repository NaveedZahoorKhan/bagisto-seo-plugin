@extends('shop::layouts.master')

@section('page_title')
    Meta Tags - SEO
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('seo.meta_tags') }}
@endsection

@section('content-wrapper')
    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>Meta Tags</h1>
            </div>

            <div class="page-actions">
                <a class="btn btn-sm btn-primary" href="{{ route('admin.seo.meta-tags.create') }}">
                    <i class="icon-plus-circle"></i> {{ __('seo::app.meta-tags.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="table">
                @include('seo::tables.meta_tag_details')
            </div>
        </div>
    </div>
@endsection
