<?php

namespace App\Console\Commands;

use App\Models\DataPegawai;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PresensiCuti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:cuti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Presensi Cuti';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('status_duty', 'Off Duty Cuti')->get();

        foreach ($users as $user) {
            $pegawai = DataPegawai::where('user_id', $user->id)->get()->toArray();
            DB::table('presensis')->insert(['user_id' => $user->id, 'pegawai_id' => $pegawai[0]['id'], 'keterangan' => 'cuti', 'created_at' => now()]);
        }
        return Command::SUCCESS;
    }
}
