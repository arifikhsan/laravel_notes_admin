<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
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

    public function table(string $table)
    {
//        $columns = Schema::getColumnListing($table);
        $columnsAndTypes = [];
        $items = DB::table($table)->paginate();
//        dd(collect($items->items()[0])->keys());
        $keys = collect($items->items()[0])->keys();
        foreach ($keys as $column) {
            $type = DB::connection()->getDoctrineColumn($table, $column)->getType()->getName();
            $columnsAndTypes[$column] = $type;
        }
        return view('table', compact('keys', 'columnsAndTypes', 'table', 'items'));
    }
}
