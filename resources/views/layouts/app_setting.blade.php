@extends('layouts.app')
@section('title')
    @yield('title')
@endsection

@section('moduleContent')
            <!-- First Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle " href="{{ route('user.index') }}" id="dropdownMenu" role="button"  aria-expanded="false">
                Overview
              </a>
            </div>
              
            <!-- Second Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Operations
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Operations 1</a></li>
                <li><a class="dropdown-item" href="#">Operations 2</a></li>
                <li><a class="dropdown-item" href="#">Operations 3</a></li>
                <li><a class="dropdown-item" href="#">Operations 4</a></li>
                <li><a class="dropdown-item" href="#">Operations 5</a></li>
              </ul>
            </div>
            
            <!-- Third Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Products
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Products 1</a></li>
                <li><a class="dropdown-item" href="#">Products 2</a></li>
                <li><a class="dropdown-item" href="#">Products 3</a></li>
              </ul>
            </div>
            
            <!-- Fourth Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Reporting
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Reporting 1</a></li>
                <li><a class="dropdown-item" href="#">Reporting 2</a></li>
                <li><a class="dropdown-item" href="#">Reporting 3</a></li>
                <li><a class="dropdown-item" href="#">Reporting 4</a></li>
              </ul>
            </div>
            
            <!-- Fifth Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Configuration
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" arialabelledby="dropdownMenu">
                <li><a class="dropdown-item" href="{{ route('user.index') }}">Users</a></li>
                <li><a class="dropdown-item" href="{{ route('warehouse.index') }}">Warehouses</a></li>
                <li><a class="dropdown-item" href="#">Configuration 3</a></li>
                <li><a class="dropdown-item" href="#">Configuration 4</a></li>
                <li><a class="dropdown-item" href="#">Configuration 5</a></li>
              </ul>
            </div>
            
@endsection
@section('navContent')
  @yield('menuName')
  @yield('navContent')
@endsection