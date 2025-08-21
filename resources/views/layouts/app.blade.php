<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>EMI Processor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">EMI Admin</a>
    <div class="ms-auto">
      @auth
      <form action="{{ route('logout') }}" method="POST">@csrf
        <button class="btn btn-outline-light btn-sm">Logout</button>
      </form>
      @endauth
    </div>
  </div>
</nav>
<div class="container">@yield('content')</div>
</body>
</html>