<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetCutiKerja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cuti:cutikerja';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Cuti Kerja Tahunan';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = User::all();
        foreach ($data as $item) {
            User::where('id', $item->id)->update(['sisa_cuti' => 12]);
        }

        return Command::SUCCESS;
    }
}
