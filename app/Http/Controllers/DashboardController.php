<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @throws Exception
     */
    public function overview()
    {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $items = [];
        foreach ($tables as $table) {
            $item['name'] = $table;
            $item['count'] = DB::table($table)->count();
            array_push($items, $item);
        }
        return view('secretroom', compact('items'));
    }

    public function index(string $table)
    {
        $keys = [];
        $tables = DB::getDoctrineSchemaManager()->listTables();
        foreach ($tables as $t) {
            if ($t->getName() == $table) {
                $keys = collect($t->getColumns())->keys();
            }
        }
        $columnsAndTypes = [];
        $items = DB::table($table)->paginate();
//        $primary = DB::table($table)->select(DB::raw("SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'"));
//        dd($primary->Column_name);
        foreach ($keys as $column) {
            $type = DB::connection()->getDoctrineColumn($table, $column)->getType()->getName();
            $columnsAndTypes[$column] = $type;
        }
        return view('tables/index', compact('keys', 'columnsAndTypes', 'table', 'items'));
    }

    public function new(string $table)
    {
        $columns = $this->getColumns($table);
        return view('tables/new', compact('table', 'columns'));
    }

    public function create(Request $request, string $table)
    {
        $new = (object)$request->only($this->getColumnNames($table));
        if ($request->has('created_at')) {
            $new->created_at = Carbon::now();
        }
        if ($request->has('updated_at')) {
            $new->updated_at = Carbon::now();
        }
        $id = DB::table($table)->insertGetId((array)$new);
        if ($id > 0) {
            return redirect('secretroom/' . $table . '/' . $id)->with('notice', 'Successfully added.');
        } else {
            return back()->with('alert', 'Add failed.');
        }
    }

    public function show(string $table, string $id)
    {
        $columns = $this->getColumns($table);
        $item = DB::table($table)->find($id);
        $keys = collect($item)->keys();
        return view('tables/show', compact('item', 'table', 'id', 'keys', 'columns'));
    }

    public function edit(string $table, string $id)
    {
        $item = DB::table($table)->find($id);
        $columns = $this->getColumns($table);
        $keys = array_column($columns, 'name');
        $types = array_column($columns, 'type');
        return view('tables/edit', compact('item', 'table', 'id', 'keys', 'columns', 'types'));
    }

    public function update(Request $request, string $table, string $id)
    {
        $new = $request->only($this->getColumnNames($table));
        $response = DB::table($table)->where('id', $id)->update($new);
        if ($response) {
            return redirect('secretroom/' . $table . '/' . $id . '/edit')->with('notice', 'Successfully updated.');
        } else {
            return back()->with('alert', 'Update failed.');
        }
    }

    public function delete(string $table, string $id)
    {
        $item = DB::table($table)->find($id);
        return view('tables/delete', compact('item', 'table', 'id'));
    }

    public function destroy(string $table, string $id)
    {
        $response = DB::table($table)->delete($id);
        if ($response) {
            return redirect('secretroom/' . $table)->with('notice', 'Successfully deleted.');
        } else {
            return back()->with('alert', 'Delete failed.');
        }
    }

    private function getColumnNames(string $table): array
    {
        $columns = $this->getColumns($table);
        return array_column($columns, 'name');
    }

    private function getColumns(string $table): array
    {
        $tables = DB::getDoctrineSchemaManager()->listTables();
        $keys = [];

        foreach ($tables as $t) {
            if ($t->getName() == $table) {
                $keys = collect($t->getColumns())->keys();
            }
        }

        $columns = []; // id, name, type
        foreach ($keys as $index => $key) {
            $type = DB::connection()->getDoctrineColumn($table, $key)->getType()->getName();
            $item['id'] = $index + 1;
            $item['name'] = $key;
            $item['type'] = $type;

            array_push($columns, (object)$item);
        }

        return $columns;
    }
}
