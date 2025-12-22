<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LetterTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('letter_types')->insert([
      ['name' => 'Surat Keterangan Domisili', 'code' => 'SKD', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Surat Keterangan Tidak Mampu', 'code' => 'SKTM', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Surat Keterangan Usaha', 'code' => 'SKU', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
