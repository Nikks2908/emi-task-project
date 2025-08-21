<?php

namespace App\Repositories;

use App\Models\LoanDetail;
use Illuminate\Support\Collection;

class EloquentLoanDetailsRepository implements LoanDetailsRepositoryInterface {
    public function all(): Collection {
        return LoanDetail::orderBy('clientid')->get();
    }
    public function minStartDate(): ?string {
        return LoanDetail::min('first_payment_date');
    }
    public function maxEndDate(): ?string {
        return LoanDetail::max('last_payment_date');
    }
}