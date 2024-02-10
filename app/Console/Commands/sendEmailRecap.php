<?php

namespace App\Console\Commands;

use App\Models\Users;
use App\Mail\activityRecap;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendEmailRecap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-email-recap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send an activity recap email monthly to user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = Users::select('email','name') -> orderBy('id_user','asc') -> get();
        foreach ($user as $user_email){
            $email_name = $user_email->name;
            Mail::to($user_email -> email) 
                -> send(new activityRecap($email_name));
        }
        echo('command for send email is successfully');
    }
}
