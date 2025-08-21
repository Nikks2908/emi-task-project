<?php

namespace App\Http\Controllers;

use App\Services\EmiProcessorService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmiController extends Controller {
    public function __construct(private EmiProcessorService $service) {}

    public function index() {
        $hasTable = Schema::hasTable('emi_details');
        $columns = $rows = [];
        if ($hasTable) {
            $columns = DB::getSchemaBuilder()->getColumnListing('emi_details');
            $rows = DB::table('emi_details')->orderBy('clientid')->get();
        }
        return view('emi.index', compact('hasTable','columns','rows'));
    }

    public function process() {
        $this->service->process();
        return redirect()->route('emi.index')->with('status','EMI data processed successfully.');
    }
}
