<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            rekening_seeder::class,
            dasar_setoran_seeder::class,
            // desa_seeder::class,  // Ga perlu di seeder karena sudah dipecah kedalam 4 buah desa seeder
            desa_a_seeder::class,
            desa_b_seeder::class,
            desa_c_seeder::class,
            desa_d_seeder::class,

            kec_seeder::class,
            kab_seeder::class,
            prov_seeder::class,

            satkers_seeder::class,
            user_groups_seeder::class,
            user_seeder::class,
            user_pbb_seeder::class,
            npop_tkp_seeder::class,
            setting_default_seeder::class,
            jenis_perolehan_seeder::class,
            tarif_njop_seeder::class,
            tarif_bphtb_seeder::class,
            nop_pbb_seeder::class,
            nop_pbb_dua_seeder::class,
            profil_seeder::class,
            profil_dua_seeder::class,
            urut_stpd_seeder::class,
            status_user_seeder::class,

            web_assets_seeder::class,
            web_kanal_pembayaran_seeder::class,
            web_profil_pejabat_seeder::class,
            web_regulasi_seeder::class,
            jenis_logs_seeder::class,

            penandatangan_seeder::class,
        ]);
    }
}
