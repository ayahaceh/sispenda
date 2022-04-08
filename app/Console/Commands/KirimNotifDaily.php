<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Traits\TgTrait; // Telegram ada di trait

class KirimNotifDaily extends Command
{

    use TgTrait; // Gunakan trait

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kirim_notif:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim notifikasi spm/sp2d setiap hari';

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
        // Kirim Notif SPM Belum diproses ke KBUD
        $this->kirim_notif_kbud();
        // Kirim notif SP2D belum di Upload 
        $this->kirim_notif_operator_sp2d();

        $this->info('Successfully sent.');
    }
}
