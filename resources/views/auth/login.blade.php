@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="card shadow">
      <div class="card-body">
        <h5 class="mb-3">Login</h5>
        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" value="{{ old('username') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection