<?php

namespace App\Console\Commands;

use App\charity_period;
use App\charity_periods_transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateNextDateIfInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Create:NextDateIfInactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Next Date If Inactive';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $charity = charity_period::where('status',"!=","active")->get();
        foreach ($charity as $item) {
            if (!$item['next_date'] or $item['next_date']<= date("Y-m-d")){
            $Day = date("d",strtotime($item['start_date']));
                $nextMonthStrTime = strtotime(date("Y-m-d")." +".$item['period'] ." months");
                $nextDate =  strtotime(date("Y-m",$nextMonthStrTime)."-01 +".$Day." days");
            charity_period::where('id',$item['id'])->update(['next_date'=>date("Y-m-d",$nextDate)]);
            }
        }

    }
}
