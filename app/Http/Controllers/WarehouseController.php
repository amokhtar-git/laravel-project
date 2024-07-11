<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all(); // Fetch all warehouse
        // $users = User::all();
        return view('warehouse.warehouse_overview', compact('warehouses')); // Pass warehouse to the view
    }

    public function create()
    {
        $users = User::all();
        return view('warehouse.warehouse_configuration_create', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id', // Ensure id_user exists in users table
            'country' => 'required|string',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouse.create')->with('success', 'Warehouse created successfully.');
    }
    public function show(string $id)
    {
        //
    }

    public function edit($id)
{
    $warehouse = Warehouse::findOrFail($id);
    $users = User::all();
    return view('warehouse.warehouse_edit', compact('warehouse','users'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'id_user' => 'required|exists:users,id', // Ensure id_user exists in users table
        'country' => 'required|string',
        'city' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
    ]);

    $warehouse = Warehouse::findOrFail($id);
    $warehouse->update($request->all());

    return redirect()->route('warehouse.index')->with('success', 'Warehouse updated successfully.');
}
public function destroy($id)
{
    $warehouse = Warehouse::findOrFail($id);
    $warehouse->delete();
    return redirect()->route('warehouse.index')->with('success', 'Warehouse deleted successfully.');
}

public function bulkAction(Request $request)
{
    $request->validate([
        'warehouse_ids' => 'required|array',
        'warehouse_ids.*' => 'exists:warehouses,id',
        'action' => 'required|string|in:edit,delete',
    ]);

    $warehouseIds = $request->input('warehouse_ids');
    $action = $request->input('action');

    if ($action === 'delete') {
        Warehouse::whereIn('id', $warehouseIds)->delete();
        return redirect()->route('warehouse.index')->with('success', 'Warehouse deleted successfully.');
    } elseif ($action === 'edit') {
        if (!empty($warehouseIds)) {
            return redirect()->route('warehouse.edit', $warehouseIds[0]);
        }
    }
    return redirect()->route('warehouse.index')->with('success', 'Action completed successfully.');
}

}
