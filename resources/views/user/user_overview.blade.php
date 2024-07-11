@extends('layouts.app_setting')

@section('title')
    Users
@endsection

@section('navContent')
    @section('moduleName') Setting @endsection
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.bulkAction') }}">
            @csrf
            <div class="position-r  elative mb-3">
                <div class="d-inline-block">
                    <a href="{{ route('user.create') }}" class="btn btn-success me-2 btn-sm">Create</a>
                    <button type="submit" name="action" value="edit" class="btn btn-primary me-2 btn-sm">Edit</button>
                    <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Delete</button>
                </div>
                <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 300px;">
                    <input id="searchInput" class="form-control" type="search" placeholder="Search" aria-label="Search" style="width: 130%;">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="color: red;">Users Over View</th>
                        </tr>
                    </thead>
                </table>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2"><input type="checkbox" id="checkAll"></th>
                            <th scope="col" rowspan="2" class="nowrap">Name</th>
                            <th scope="col" rowspan="2">Email</th>
                            <th scope="col" rowspan="2">Country</th>
                            <th scope="col" rowspan="2">City</th>
                            <th scope="col" rowspan="2">Address</th>
                            <th scope="col" colspan="3" class="text-center">Access Right</th>
                        </tr>
                        <tr>
                            <th scope="col">Create</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
                                <td title="{{ $user->job_description }}" class="nowrap">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->country }}</td>
                                <td>{{ $user->city }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->create }}</td>
                                <td>{{ $user->edit }}</td>
                                <td>{{ $user->delete }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });

        // Live search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            let searchTerm = this.value.toLowerCase();
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                let name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.startsWith(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Shortcut key (Ctrl + F) to focus the search bar
        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.key === 'f') {
                event.preventDefault();
                document.getElementById('searchInput').focus();
            }
        });
    </script>
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .nowrap {
            white-space:nowrap;
        }
        [title]:hover::after {
            content: attr(title);
            position: absolute;
            background-color: #000;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            white-space: nowrap;
            z-index: 1000;
        }
    </style>
@endsection
