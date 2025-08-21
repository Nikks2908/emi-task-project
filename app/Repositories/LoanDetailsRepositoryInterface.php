<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface LoanDetailsRepositoryInterface {
    public function all(): Collection;
    public function minStartDate(): ?string;
    public function maxEndDate(): ?string;
}