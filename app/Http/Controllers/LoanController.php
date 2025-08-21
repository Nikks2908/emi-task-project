<?php

namespace App\Http\Controllers;

use App\Repositories\LoanDetailsRepositoryInterface;

class LoanController extends Controller {
    public function __construct(private LoanDetailsRepositoryInterface $repo) {}
    public function index() {
        $loans = $this->repo->all();
        return view('loans.index', compact('loans'));
    }
    public function dashboard() { return view('dashboard'); }
}
