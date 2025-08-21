@extends('layouts.app')
@section('content')
<div class="d-flex gap-3">
  <a class="btn btn-outline-primary" href="{{ route('loans.index') }}">Loan Details</a>
  <a class="btn btn-primary" href="{{ route('emi.index') }}">EMI Processing</a>
</div>
@endsection