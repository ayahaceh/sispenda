<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SpmModel;
use App\Models\ProsesPjbModel;

class UpdateStatusSpmSelesai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status_spm_selesai:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Status SPM Bank ke SPM Selesai setiap Bulan';

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
        $bulan_ini = date('m');
        $getData = ProsesPjbModel::where('id_ref_proses_pejabat', STATUS_SPM_BANK_5)
            ->whereMonth('tgl_proses', '<', $bulan_ini)
            ->get();
        foreach ($getData as $value) {
            // cari data spm bulan lalu yang statusnya masih bank (5)
            $spm = SpmModel::where('id', $value->id_spm)
                ->where('id_status_spm', STATUS_SPM_BANK_5)
                ->first();
            if ($spm) {
                // update status menjadi 10
                $spm->id_status_spm = 10;
                $spm->save();
            }
        }
        // $this->info('SPM Bank (5) telah diupdate ke Status Selesai (10) !');
        // ----
    }
}
