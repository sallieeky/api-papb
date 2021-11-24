<?php

namespace App\Console\Commands;

use App\Models\CheckIn;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecordCheckin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:checkin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record checkin as late';

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
     * @return int
     */
    public function handle()
    {
        $user = User::all();
        foreach ($user as $us) {
            $cek = CheckIn::where([['user_id', $us->id], ['tanggal', '=', Carbon::now()->format('Y-m-d')]])->first();
            if (!$cek) {
                CheckIn::create([
                    "user_id" => $us->id,
                    "keterangan" => "Terlambat",
                    "jam" => "Terlambat",
                    "tanggal" => Carbon::now()->format('Y-m-d')
                ]);
            }
        }

        echo "Success record as late";
    }
}
