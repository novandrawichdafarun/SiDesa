<?php

namespace Database\Seeders;

use App\Models\LetterRequest;
use App\Models\News;
use App\Models\Resident;
use App\Models\Role;
use App\Models\User;
use App\Models\Complaint;
use Database\Factories\ComplaintFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ComplaintSeeder::class,
            LetterTypeSeeder::class,
        ]);

        $rolePenduduk = Role::where('name', 'penduduk')->first()->id ?? 2;

        $jumlahRW = 2; // Buat 2 RW
        $jumlahRTperRW = 3; // Tiap RW punya 3 RT
        $pendudukPerRT = 5; // Tiap RT diisi 5 penduduk dummy

        for ($i = 1; $i <= $jumlahRW; $i++) {
            $noRW = str_pad($i, 2, '0', STR_PAD_LEFT); // '01', '02'

            for ($j = 1; $j <= $jumlahRTperRW; $j++) {
                $noRT = str_pad($j, 2, '0', STR_PAD_LEFT); // '01', '02'

                // C. Buat PENDUDUK Random di RT ini
                // Kita gunakan UserFactory untuk membuat user random,
                // tapi kita paksa role_id nya jadi Penduduk
                User::factory($pendudukPerRT)->create([
                    'role_id' => $rolePenduduk, // Pastikan role penduduk
                ])->each(function ($user) use ($noRT, $noRW) {

                    // 1. Buat Profil Penduduk (Sesuai RT/RW Loop)
                    $resident = Resident::factory()->create([
                        'user_id' => $user->id,
                        'rt' => $noRT, // Wajib sama dengan loop agar filter dashboard RT jalan
                        'rw' => $noRW, // Wajib sama dengan loop
                    ]);

                    // 2. Buat Random Transaksi (Surat & Aduan)

                    // 40% Penduduk pernah bikin surat
                    if (rand(0, 100) < 40) {
                        LetterRequest::factory()->create(['user_id' => $user->id]);
                    }

                    // 20% Penduduk pernah bikin aduan
                    if (rand(0, 100) < 20) {
                        Complaint::factory()->create(['resident_id' => $resident->id]);
                    }
                });
            }
        }
    }
}
