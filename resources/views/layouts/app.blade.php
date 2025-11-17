<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Product Management')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  @stack('styles')
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="{{ url('/') }}">Product</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="topNav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/products/create') }}">Add Product</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4">
    @yield('content')
  </main>

  <footer class="border-top py-3">
    <div class="container text-center small text-muted">
      &copy; {{ date('Y') }} Product Management
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')
</body>
</html>
