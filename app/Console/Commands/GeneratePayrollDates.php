<?php

namespace App\Console\Commands;
use App\Contracts\FileExporter;
use App\Helpers\BasicPayDayCalculator;
use App\Helpers\BonusPayDayCalculator;
use App\Contracts\TimeAhead;
use App\PayRollableMonth;
use Illuminate\Console\Command;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| GeneratePayrollDates Artisan Command
|--------------------------------------------------------------------------
|
| This laravel artisan command creates a csv file with payroll date details for
|   the next 12 months
*/

class GeneratePayrollDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a file with payroll dates';

    /**
     * data exporter injected to command
     * Concrete Binding found on App service provider
     * @var FileExporter
     */
    protected $exporter;


    /**
     * months ahead class injected to command
     * Concrete Binding found on App service provider
     * @var TimeAhead
     */
    protected $months;


    /**
     * Create a new command instance.
     * @param  FileExporter $exporter
     * @param  TimeAhead $months
     * @return void
     */
    public function __construct(FileExporter $exporter, TimeAhead $months)
    {
        parent::__construct();
        $this->exporter = $exporter;
        $this->months = $months;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $months = $this->months->getTimeAhead(12);
        $data = [];

        foreach ($months as $month) {
            $payroll_month = new PayRollableMonth($month['m'], $month['Y']);

            $bonus_day_calc = new BonusPayDayCalculator($payroll_month, $payroll_month::BONUS_PAYOUT_DAY);
            $pay_day_calc = new BasicPayDayCalculator($payroll_month);

            $data[] = [
                $month['m'] . '/' . $month['Y'],
                $pay_day_calc->getBasicPayDay(),
                $bonus_day_calc->getBonusPayoutDay()
            ];
        }

        $path =  $this->exporter->outputFile($data, ['Period', 'Basic Payment', 'Bonus Payment'], 'Payroll.csv');
        $this->line('File saved to: ' . $path);
    }
}
