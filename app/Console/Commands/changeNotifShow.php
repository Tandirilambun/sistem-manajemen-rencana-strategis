<?php

namespace App\Console\Commands;

use App\Models\RequestForm;
use Illuminate\Console\Command;

class changeNotifShow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:change-notif-show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will change the flag column of the database with table name is request_form and will change the status from displayed to archived status';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {
        
        RequestForm::whereRaw("created_at < NOW() - INTERVAL '4 days'")
            -> update(['req_show' => 'archived']);
        echo('Command executed successfully');
    }
}
