@extends('layouts.app')
@section('content')
<h4 class="mb-3">Loan Details</h4>
<table class="table table-sm table-bordered bg-white shadow-sm">
  <thead class="table-light">
    <tr>
      <th>Client ID</th><th># Payments</th><th>First</th><th>Last</th><th>Loan Amount</th>
    </tr>
  </thead>
  <tbody>
    @foreach($loans as $l)
    <tr>
      <td>{{ $l->clientid }}</td>
      <td>{{ $l->num_of_payment }}</td>
      <td>{{ $l->first_payment_date }}</td>
      <td>{{ $l->last_payment_date }}</td>
      <td>{{ number_format($l->loan_amount,2) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection