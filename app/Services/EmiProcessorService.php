<?php 

namespace App\Services;

use App\Repositories\LoanDetailsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EmiProcessorService {
    public function __construct(private LoanDetailsRepositoryInterface $repo) {}

    public function process(): void {
        $start = $this->repo->minStartDate();
        $end   = $this->repo->maxEndDate();
        if (!$start || !$end) return;

        // Build month list inclusive (Y_M like 2019_Feb)
        $months = $this->buildMonthKeys($start, $end);

        // Drop & recreate emi_details (RAW SQL)
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $cols = array_map(fn($m) => "`$m` DECIMAL(15,2) DEFAULT 0", $months);
        $sql  = "CREATE TABLE emi_details (
                    clientid BIGINT NOT NULL PRIMARY KEY,
                    ".implode(",\n", $cols)."
                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        DB::statement($sql);

        // Insert rows per client and update month columns
        $loans = $this->repo->all();
        foreach ($loans as $loan) {
            // Insert base row (all zeros by default)
            DB::table('emi_details')->insert(['clientid' => $loan->clientid]);

            // Figure schedule months for this client
            $clientMonths = $this->buildMonthKeys($loan->first_payment_date, $loan->last_payment_date);
            // EMI split with exact total matching
            [$base, $lastAdjust] = $this->splitEvenly((float)$loan->loan_amount, (int)$loan->num_of_payment);

            // Assign amounts across the client’s months (num_of_payment entries)
            $assignMonths = array_slice($clientMonths, 0, $loan->num_of_payment);
            $updates = [];
            foreach ($assignMonths as $i => $key) {
                $val = $base;
                if ($i === count($assignMonths) - 1) $val = round($val + $lastAdjust, 2);
                $updates["`$key`"] = number_format($val, 2, '.', '');
            }

            if (!empty($updates)) {
                // Build one UPDATE with RAW SQL assignments
                $setParts = [];
                foreach ($updates as $col => $val) {
                    $setParts[] = "$col = $val";
                }
                $updateSql = "UPDATE emi_details SET ".implode(', ', $setParts)." WHERE clientid = ?";
                DB::update($updateSql, [$loan->clientid]);
            }
        }
    }

    private function buildMonthKeys(string $start, string $end): array {
        $startTs = strtotime(date('Y-m-01', strtotime($start)));
        $endTs   = strtotime(date('Y-m-01', strtotime($end)));
        $keys = [];
        while ($startTs <= $endTs) {
            $keys[]  = date('Y_M', $startTs); // e.g., 2019_Feb
            $startTs = strtotime('+1 month', $startTs);
        }
        return $keys;
    }

    private function splitEvenly(float $total, int $n): array {
        // base rounded to 2 decimals
        $base = round($total / $n, 2);
        $assigned = round($base * $n, 2);
        $adjust = round($total - $assigned, 2); // add to last installment (may be negative/positive)
        return [$base, $adjust];
    }
}