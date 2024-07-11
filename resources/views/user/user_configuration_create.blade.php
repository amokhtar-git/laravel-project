@extends('layouts.app_setting')

@section('title') 
    Create 
@endsection

@section('navContent')
    @section('moduleName') 
        Setting 
    @endsection
    
    <div class="container mt-1">
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="color: red;">Employee Create Screen</th>
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
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
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
                            </select>
                        </div>
                        <div class="col-md-9 mt-3">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="job_description">Job Description</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="3"></textarea>
                    </div>
                    <div style="color: red;font-size: large">Access Right Options</div>
                    <div class="form-group row ">
                        <div class="col-md-3">
                            <label for="create">Create</label>
                            <select class="form-control" id="create" name="create">
                                <option value="yes" {{ old('create') == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ old('create') == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="edit">Edit</label>
                            <select class="form-control" id="edit" name="edit">
                                <option value="yes" {{ old('edit') == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ old('edit') == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="delete">Delete</label>
                            <select class="form-control" id="delete" name="delete">
                                <option value="yes" {{ old('delete') == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ old('delete') == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-1">Create</button>
            <a class="btn btn-success" href="{{ route('user.index') }}">Users</a>
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
                        let cityOptions = '<option value="">Select a city</option>';
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
