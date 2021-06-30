
@extends('layouts.app-main')

@section('content')

<div class="row mt-5">

<div class="col-md-8">
<div class="card rounded-0">
<div class="card-body">
<h3 class="card-title">
{{$post->title}}
</h3>
<h6>{{$post->user->name}}</h6>
<p><span class="class-muted">{{$post->created_at}}</span></p>
<img src="{{URL::to('images/'.$post->file)}}" alt="" class="rounded mb-2 card-img img-fluid">
<div class="card-text">{{$post->body}}</div>
</div>
</div>

<div class="card rounded-0">
<div class="card-body">
<h3 class="card-title">
Commentaire <span class="badge alert-dark">{{count($post->comments)}}</span>
</h3>
<hr>
@foreach($post->comments as $comment)
<div class="media border p-3">
  <div class="media-body">
   <h6>{{App\Models\User::findOrFail($comment->user_id)->name}}<small><i>{{$comment->created_at}}</i></small></h6>
    <p>{{$comment->body}}</p>
  </div>
</div>
@endforeach
@auth
<form action="{{route('comments.store')}}" method="post">
<div class="mb-3">
<input type="hidden" name="_token" value="{{Session::token()}}">
<input type="hidden" name="post_id" value="{{$post->id}}">
  <label for="nom" class="form-label">Nom & Prenom</label>
  <input type="text" class="form-control" name="nom" value="{{Auth::user()->name}}" placeholder="Nom & Prenom">
</div>

<div class="mb-3">
  <label for="message" class="form-label">Message</label>
 <textarea name="body" class="form-control"  cols="30" rows="10" placeholder="Message"></textarea>
</div>

<button class="btn btn-primary">Valider</button>
</form>
@else
<a href="{{route('users.login')}}" class="btn btn-link">Connectez vous pour commenter</a>
@endauth
@if(Auth::user()->is_admin)
<div class="mx-auto mt-4 mb-3">
<a href="{{route('posts.edit',$post->id)}}" class="btn btn-warning btn-sm">Modifier</a>
<a href="{{route('posts.destroy',$post->id)}}" class="btn btn-danger btn-sm">Supprimer</a>
</div>
@endif
</div>
</div>
</div>





<div class="col-md-4">
@include('layouts.sidebar')
</div>

</div>

@endsection