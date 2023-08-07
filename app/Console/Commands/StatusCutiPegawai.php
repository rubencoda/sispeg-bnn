<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class StatusCutiPegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:statuscuti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduling Off Duty Cuti User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = now();
        $data = User::where('akhir_cuti', '<', $now)->where('status_duty', 'Off Duty Cuti')->get();
        foreach ($data as $item) {
            User::where('id', $item->id)->update(['status_duty' => 'Off Duty', 'akhir_cuti' => null]);
        }
        return Command::SUCCESS;
    }
}
