@extends('layouts.app')
@section('title')
    @yield('title')
@endsection

@section('moduleContent')
            <!-- First Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle " href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Overview
              </a>
            </div>
              
            <!-- Second Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Operations
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Receipts</a></li>
                <li><a class="dropdown-item" href="#">Deliveries</a></li>
                <li><a class="dropdown-item" href="#">Physical Inventory</a></li>
                <li><a class="dropdown-item" href="#">Scrap</a></li>
                <li><a class="dropdown-item" href="#">Replenishment</a></li>
              </ul>
            </div>
            
            <!-- Third Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Products
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Products</a></li>
              </ul>
            </div>
            
            <!-- Fourth Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Reporting
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Stock</a></li>
                <li><a class="dropdown-item" href="#">Moves History</a></li>
                <li><a class="dropdown-item" href="#">Move Analysis</a></li>
                <li><a class="dropdown-item" href="#">Performance</a></li>
              </ul>
            </div>
            
            <!-- Fifth Dropdown -->
            <div class="dropdown sub_menu">
              <a class="no-caret navbar-brand dropdown-toggle" href="#" id="dropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Configuration
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Warehouses</a></li>
                <li><a class="dropdown-item" href="#">Operations Types</a></li>
                <li><a class="dropdown-item" href="#">Product Categories</a></li>
                <li><a class="dropdown-item" href="#">Reordering Rules</a></li>
              </ul>
            </div>
            
@endsection
@section('navContent')
  @yield('menuName')
  @yield('navContent')
@endsection