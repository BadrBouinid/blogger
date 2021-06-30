@extends('layouts.app-main')

@section('content')
<form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
<div class="row mt-5">

<div class="col-md-8 mx-auto">

<div class="card">
<div class="card-body">
<h3 class="card-title">
Modifier un article
</h3>
<hr>
<div class="mb-3">
<input type="hidden" name="_token" value="{{Session::token()}}">
  <label for="titre" class="form-label">Titre</label>
  <input type="text" class="form-control" value="{{$post->title}}" name="titre" placeholder="Titre">
</div>

<div class="mb-3">
  <label for="body" class="form-label">Déscription</label>
 <textarea name="body" class="form-control" cols="30" rows="10">{{$post->body}}</textarea>
</div>

<div class="mb-3">
 <img src="{{URL::to('images/'.$post->file)}}" alt="" class="h-10 img-fluid rounded">
</div>
<div class="mb-3">
  <label for="file" class="form-label">File</label>
  <input type="file" class="form-control" name="file" placeholder="File">
</div>
<button class="btn btn-primary">Valider</button>
</div>

</div>
</div>
</div>
</form>
@endsection