@extends('layouts.app_setting')

@section('title')
    Warehouse
@endsection

@section('navContent')
    @section('moduleName') Setting @endsection
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('warehouse.bulkAction') }}">
            @csrf
            <div class="position-r  elative mb-3">
                <div class="d-inline-block">
                    <a href="{{ route('warehouse.create') }}" class="btn btn-success me-2 btn-sm">Create</a>
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
                            <th style="color: red;">Warehouses Over View</th>
                        </tr>
                    </thead>
                </table>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2"><input type="checkbox" id="checkAll"></th>
                            <th scope="col" rowspan="2" class="nowrap">Name</th>
                            <th scope="col" rowspan="2">Employee</th>
                            <th scope="col" rowspan="2">Country</th>
                            <th scope="col" rowspan="2">City</th>
                            <th scope="col" rowspan="2">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                            <tr>
                                <td><input type="checkbox" name="warehouse_ids[]" value="{{ $warehouse->id }}"></td>
                                <td class="nowrap">{{ $warehouse->name }}</td>
                                <td class="nowrap">
                                    {{ $warehouse->user ? $warehouse->user->name : 'No user assigned' }}
                                </td>                                
                                <td>{{ $warehouse->country }}</td>
                                <td>{{ $warehouse->city }}</td>
                                <td>{{ $warehouse->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('input[name="warehouse_ids[]"]');
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
