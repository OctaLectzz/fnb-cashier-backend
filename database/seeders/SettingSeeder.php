<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'title' => 'Wine POS',
            'description' => 'Wine POS adalah platform yang membantu individu dalam merencanakan dan mengembangkan karir mereka',
            'address' => 'Jl. Seta No.32 Larangan RT04/RW04 Gayam Sukoharjo, Jawa Tengah',
            'logo' => 'IMG1722247571-wine-pos-logo.png',
            'logo_size' => 80,
            'about' => '<p class="text-subtitle text-grey-8"><b>Wine POS</b> adalah platform yang didedikasikan untuk membantu individu dalam mencapai kesuksesan karir mereka. Kami menyediakan berbagai sumber daya, tips, dan alat penilaian yang dirancang untuk memfasilitasi eksplorasi jalur karir, pengembangan keterampilan, dan pencapaian tujuan profesional.</p><p class="text-subtitle text-grey-8">Dengan fokus pada panduan karir yang terpersonalisasi, kami berkomitmen untuk mendukung setiap langkah perjalanan karir Anda, dari awal hingga mencapai puncak kesuksesan. Di Winepos, kami percaya bahwa setiap individu memiliki potensi untuk mencapai karir impian mereka, dan kami ada di sini untuk membantu mewujudkannya.</p>'
        ]);
    }
}
