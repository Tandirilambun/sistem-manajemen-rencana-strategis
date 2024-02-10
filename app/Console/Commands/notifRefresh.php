<?php

namespace App\Console\Commands;

use App\Models\RequestForm;
use Illuminate\Console\Command;

class notifRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'second:notif-refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will get Data from database to retrieve notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $notif_item = RequestForm::with('users')
        //     ->where('req_show', '=', 'displayed')
        //     ->orderBy('created_at', 'desc')
        //     ->get();
        // return view('main.index',[
        //     'notif_item' => $notif_item
        // ]);
    }
}
