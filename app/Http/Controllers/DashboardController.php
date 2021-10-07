<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Exception;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @throws Exception
     */
    public function dashboard()
    {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $items = [];
        foreach ($tables as $table) {
            $item['name'] = $table;
            $item['count'] = DB::table($table)->count();
            array_push($items, $item);
        }
        return view('dashboard', compact('items'));
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

    public function show(string $table, string $id)
    {
//        $schema = DB::getDoctrineSchemaManager();
//        $tables = $schema->listTables();

//        dd($schema);
//        dd(Schema::getColumnListing($table)); // sort by alphabet
//        dd($tables);
//        dd($tables[2]->getName());
//        dd($tables[2]->getColumns());
//        dd(collect($tables[2]->getColumns())->keys());
//        dd($tables[2]->getColumns()['title']->getType()->getName());
        $item = DB::table($table)->find($id);
        $keys = collect($item)->keys();
//        dd($keys);
        return view('tables/show', compact('item', 'table', 'id', 'keys'));
    }
}
