<nav class="navbar navbar-expand-lg navbar-light has-shadow">
  <div class="container">

    <a class="navbar-brand" href="#"> AffProducts </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.view') }}"> All Products </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="productsCategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
          </a>
          <div class="dropdown-menu" aria-labelledby="productsCategories">
            @foreach ($categories as $category)
              <a class="dropdown-item" href="{{ route('products.view', $category->slug) }}"> {{ $category->name }} </a>
            @endforeach
          </div>
        </li>
      </ul>
    </div>

  </div>
</nav>
