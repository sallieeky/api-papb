<?php

namespace App\Console\Commands;

use App\Models\CheckOut;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecordCheckOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record checkout as late';

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
            $cek = CheckOut::where([['user_id', $us->id], ['tanggal', '=', Carbon::now()->format('Y-m-d')]])->first();
            if (!$cek) {
                CheckOut::create([
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
