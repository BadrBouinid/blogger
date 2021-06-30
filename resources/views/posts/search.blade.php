
@extends('layouts.app-main')

@section('content')

<div class="row mt-5">

<div class="col-md-8">
@if(count($posts)>0)
@foreach($posts as $post)
<div class="card rounded-0">
<div class="card-body">
<h3 class="card-title">
{{$post->title}}
</h3>
<img src="{{URL::to('images/'.$post->file)}}" alt="" class="rounded mb-2 card-img img-fluid">
<div class="card-text">{{\Illuminate\Support\Str::limit($post->body)}}</div>
<a href="{{ route ('posts.show', $post->id) }}" class="btn btn-link">Voir</a>
</div>
</div>
@endforeach
@else
<div class="alert alert-info">Aucun article trouvé</div>
@endif
{{ $posts->links('pagination::bootstrap-4') }}
  


</div>
<div class="col-md-4">
@include('layouts.sidebar')
</div>
</div>
</div>

@endsection