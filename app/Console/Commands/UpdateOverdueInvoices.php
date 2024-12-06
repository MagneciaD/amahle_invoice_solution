<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use Carbon\Carbon;

class UpdateOverdueInvoices extends Command
{
    protected $signature = 'invoices:update-overdue';
    protected $description = 'Update overdue invoices status to "overdue"';

    public function handle()
    {
        // Fetch invoices where the due date is in the past and status is not yet "overdue"
        $invoices = Invoice::where('due_date', '<', Carbon::now())
                            ->where('status', '!=', 'overdue')
                            ->get();

        foreach ($invoices as $invoice) {
            $invoice->status = 'overdue';
            $invoice->save();
        }

        $this->info('Overdue invoices have been updated.');
    }
}
