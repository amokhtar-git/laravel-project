<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .moduleName{
            font-size: 25px; /* Larger text for the main screen name */
            color: red;
            text-decoration: none;
        }
        .navbar-brand {
            font-size: 20px; /* Larger text for the main screen name */
        }
        .dropdown-menu .dropdown-item {
        font-size: 15px; /* Smaller text for the submenu items */
        }
        .navbar-nav .dropdown {
        position: relative;
        }
        .navbar-nav .dropdown .dropdown-menu {
        left: 0; /* Align dropdown menu to the left */
        right: auto;
        }
        .sub_menus_wrapper {
        display: flex;
        justify-content: flex-end; /* Move submenus to the right */
        gap: .5rem; /* Space between submenus */
        margin-right: 500px;
        }
        .sub_menu {
        display: inline-block;
        font-size: 13px;
        font-weight: lighter;
        }
        .no-caret::after {
        display: none !important; /* Remove the caret */
        }
        .container2{
            margin-top: 65px;
            border-radius: 5px; 
            display: block;
            min-height: 55px;
            height: auto;
            overflow: hidden;
            min-width: 95%;
            background-color: #dedede3e;  
        }
        .inline-block{
            display: inline-block
        }
        .navbar-toggler{
            display: contents;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark fixed-top pt-1 pb-1 ">
        <div class="container-fluid">
          <a class="moduleName " href="#">
            @yield('moduleName')
          </a>
          <div class="sub_menus_wrapper">
            @yield('moduleContent')
          </div>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Application Modules</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home Screen Page</a>
                  <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                  <a class="nav-link active" aria-current="page" href="#">Inventory</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sections
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
              </ul>
              <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
              </form>
            </div>
          </div>
        </div>
    </nav>
    <div class="container container2 ">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @yield('navContent')
    </div >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
  </body>
</html>
