@extends('layouts.app-main')

@section('content')
<form action="{{route('users.register')}}" method="post">
<div class="row mt-5">

<div class="col-md-8 mx-auto">

<div class="card">
<div class="card-body">
<h3 class="card-title">
Inscription
</h3>
<hr>
<div class="mb-3">
<input type="hidden" name="_token" value="{{Session::token()}}">
  <label for="nom" class="form-label">Nom & Prenom*</label>
  <input type="text" class="form-control" name="nom" placeholder="Nom & Prenom">
</div>

<div class="mb-3">
  <label for="body" class="form-label">Email*</label>
  <input type="email" class="form-control" name="email" placeholder="Email">
  </div>

<div class="mb-3">
  <label for="password" class="form-label">Mot de passe*</label>
  <input type="password" class="form-control" name="password" placeholder="Mot de passe">
</div>
<button class="btn btn-primary">Valider</button>
</div>

</div>
</div>
</div>
</form>
@endsection