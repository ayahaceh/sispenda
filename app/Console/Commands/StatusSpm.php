<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StatusSpm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status_spm:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ubah status spm setiap bulan';

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
        $today  = \Carbon\Carbon::now()->format('Y-m-d');
        $getData = \App\Models\ProsesPjbModel::all();
        foreach ($getData as $value) {
            if (formatDateAddMonth(formatDate($value->tgl_proses), 1) == $today) {
                // cari data dengan status spm 5
                $spm = \App\Models\SpmModel::where([
                    ['id', '=', $value->id_spm],
                    ['id_status_spm', '=', 5]
                ])->first();
                if ($spm) {
                    // update status menjadi 10
                    $spm->id_status_spm = 10;
                    $spm->save();
                }
            }
        }
        $this->info('Successfully update status spm.');



        // ----
    }
}
