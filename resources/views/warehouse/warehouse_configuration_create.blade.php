@extends('layouts.app_setting')

@section('title') 
    Create 
@endsection

@section('navContent')
    @section('moduleName') 
        Setting 
    @endsection
    
    <div class="container mt-1">
        <form method="POST" action="{{ route('warehouse.store') }}">
            @csrf
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="color: red;">Warehouse Create Screen</th>
                    </tr>
                </thead>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus>
                    </div>
                    <div class="col-md-3">
                        <label for="id_user">Employee</label>
                        <select name="id_user" class="form-control" id="id_user">
                            <option value="">Select an Employee</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control" id="id_user" name="id_user" value="{{ old('id_user') }}"> --}}
                    </div>
                    <div class="col-md-3">
                        <label for="country">Country:</label>
                        <select class="form-control" id="country" name="country">
                            <!-- Options will be populated dynamically -->
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <label for="city">City:</label>
                            <select class="form-control" id="city" name="city">
                                <option value="">Select a City</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-9 mt-3">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-1">Create</button>
            <a class="btn btn-success" href="{{ route('warehouse.index') }}">Warehouses</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Fetch countries
            $.getJSON('https://restcountries.com/v3.1/all', function (countries) {
                let countryOptions = '<option value="">Select a Country</option>';
                $.each(countries, function (index, country) {
                    countryOptions += `<option value="${country.cca2}">${country.name.common}</option>`;
                });
                $('#country').html(countryOptions);
            })
            .fail(function() {
                console.error('Error fetching countries');
            });

            // Handle country change
            $('#country').change(function () {
                let countryCode = $(this).val();
                if (countryCode) {
                    // Fetch cities based on selected country
                    $.getJSON(`http://api.geonames.org/searchJSON?country=${countryCode}&featureClass=P&maxRows=1000&username=acc.ahmed`, function (data) {
                        console.log('City data:', data); // Debugging step
                        let cityOptions = '<option value="">Select a City</option>';
                        $.each(data.geonames, function (index, city) {
                            cityOptions += `<option value="${city.name}">${city.name}</option>`;
                        });
                        $('#city').html(cityOptions);
                    }).fail(function () {
                        console.error('Error fetching cities');
                    });
                } else {
                    $('#city').html('<option value="">Select a city</option>');
                }
            });
        });
    </script>
@endsection
