@extends('layouts.app')
@section('content')
<h4 class="mb-3">EMI Processing</h4>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('emi.process') }}" class="mb-3">
  @csrf
  <button class="btn btn-danger">Process Data</button>
  <small class="text-muted ms-2">Drops & recreates <code>emi_details</code> then fills it.</small>
</form>

@if($hasTable)
  <div class="table-responsive">
    <table class="table table-sm table-bordered bg-white shadow-sm">
      <thead class="table-light">
        <tr>
          @foreach($columns as $col)
            <th>{{ $col }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($rows as $row)
          <tr>
            @foreach($columns as $col)
              <td>{{ is_numeric($row->$col) ? number_format($row->$col, 2) : $row->$col }}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <p class="text-muted">No data yet. Click <strong>Process Data</strong> to generate <code>emi_details</code>.</p>
@endif
@endsection