<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 navbar-custom">
  <a class="navbar-brand" href="{{ url('/') }}">Template</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('companies.index') }}">Companies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
      </li>
    </ul>
  </div>
</nav>