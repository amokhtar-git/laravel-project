@extends('layouts.app_setting')

@section('title')
    Edit Warehouse
@endsection

@section('navContent')
    @section('moduleName') Setting @endsection
    <div class="container mt-1">
        <form method="POST" action="{{ route('warehouse.update', $warehouse->id) }}">
            @csrf
            @method('PUT')
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="color: red;">Warehouse Edit Screen</th>
                    </tr>
                </thead>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $warehouse->name }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="id_user">Employee</label>
                        <div class="col-md-3">
                            <label for="id_user">Employee</label>
                            <select name="id_user" class="form-control" id="id_user">
                                <option value="">Select an Employee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $warehouse->id_user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-9 mt-3">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="1">{{ $user->address }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a class="btn btn-success mt-3" href="{{ route('warehouse.index') }}">Warehouses</a>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            var selectedCountryCode = "{{ $warehouse->country }}"; // Assuming 'country' holds the country code
            var selectedCityCode = "{{ $warehouse->city }}"; // Assuming 'city' holds the city code
            // Fetch countries
            $.getJSON('https://restcountries.com/v3.1/all', function(countries){
                let countryOptions = '<option value="">Select a country</option>';
                $.each(countries,function(index,country){
                    // Check if this country should be selected
                    let selected = country.cca2 === selectedCountryCode ? 'selected' : '';
                    countryOptions += `<option value="${country.cca2}" ${selected}>${country.name.common}</option>`;
                });
                // {{ old('edit') == 'yes' ? 'selected' : '' }}
                $('#country').html(countryOptions);
                // Trigger change event to load cities if a country is already selected
                if (selectedCountryCode) {
                    $('#country').trigger('change');
                }
            })
            .fail(function(){
                console.error('Error fetching countries');
            });
            // Handle country change
            $('#country').change(function(){
                let countryCode = $(this).val();
                if(countryCode){
                    // Fetch cities based on selected country
                    $.getJSON(`http://api.geonames.org/searchJSON?country=${countryCode}&featureClass=P&maxRows=1000&username=acc.ahmed`, function(data){
                        let cityOptions = '<option value="">Select a city</option>';
                        $.each(data.geonames, function(index, city){
                            // Check if this city should be selected
                            let selected = city.name === selectedCityCode ? 'selected' : '';
                            cityOptions += `<option value="${city.name}" ${selected}>${city.name}</option>`;
                        });
                        $('#city').html(cityOptions);
                    }).fail(function(){
                        console.error('Error fetching cities');
                    });
                } else {
                    $('#city').html('<option value="">Select a city</option>');
                }
            });
            // Trigger change event to load cities if a country is already selected
            if (selectedCountryCode) {
                $('#country').trigger('change');
            }
        });
    </script>
@endsection