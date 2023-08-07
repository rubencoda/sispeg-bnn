<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class WarningAlpha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warning:alpha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warning System Pegawai Alpha';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(3);
        $data = User::where('status_duty', 'Off Duty')->whereDate('check_in_today', '<=', $date)->get();
        $total = $data->count();

        if ($total > 0) {

            $attatch = [
                'email' => 'bnnsidoarjo@gmail.com',
                'title' => 'Warning System'
            ];

            Mail::send('email.warning-email', ['data' => $data], function ($message) use ($attatch) {
                $message->to($attatch['email'])
                    ->subject($attatch['title']);
            });
        }
        return Command::SUCCESS;
    }
}
