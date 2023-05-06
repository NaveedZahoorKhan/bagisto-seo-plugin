<form action="{{route('meta-tags.global')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        @foreach($tags as $tag)
        @include('seo::admin.forms.tag')
        @endforeach
    </div>
    <div class="form-group text-right">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>