@extends('layouts.app_setting')

@section('title')
    Edit User
@endsection

@section('navContent')
    @section('moduleName') Setting @endsection
    <div class="container mt-1">
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="color: red;">Employee Edit Screen</th>
                    </tr>
                </thead>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Leave blank to keep current password</small>
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
                    <div class="col-md-12 mt-3">
                        <label for="job_description">Job Description</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="3">{{ $user->job_description }}</textarea>
                    </div>
                    <div style="color: red;font-size: large">Access Right Options</div>
                    <div class="form-group row ">
                        <div class="col-md-3">
                            <label for="create">Create</label>
                            <select class="form-control" id="create" name="create">
                                <option value="yes" {{ $user->create == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->create == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="edit">Edit</label>
                            <select class="form-control" id="edit" name="edit">
                                <option value="yes" {{ $user->edit == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->edit == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="delete">Delete</label>
                            <select class="form-control" id="delete" name="delete">
                                <option value="yes" {{ $user->delete == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->delete == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a class="btn btn-success mt-3" href="{{ route('user.index') }}">Users</a>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            var selectedCountryCode = "{{ $user->country }}"; // Assuming 'country' holds the country code
            var selectedCityCode = "{{ $user->city }}"; // Assuming 'city' holds the city code
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