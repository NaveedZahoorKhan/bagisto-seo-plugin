@php $metaTags = $data['metaTags']; @endphp
<div class="tab-pane fade" id="nav-page-meta-tags" role="tabpanel" aria-labelledby="nav-page-meta-tags-tab">
    <form action="{{route('admin.seo.meta-tags.global')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @foreach($metaTags as $group=>$tags)
        <fieldset>
            <div class="row">
                @include('seo::forms.tag',['tag'=>$tags])
            </div>
        </fieldset>
        @endforeach
        <div class="form-group text-right">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
</div>