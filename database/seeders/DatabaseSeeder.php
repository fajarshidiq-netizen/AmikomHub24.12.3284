<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Insert Kategori Event (Minimal 3 Kategori)
        $catIT = Category::create([
            'name' => 'IT & Coding',
            'slug' => 'it-coding',
        ]);

        $catCreative = Category::create([
            'name' => 'Design & Creative',
            'slug' => 'design-creative',
        ]);

        $catGaming = Category::create([
            'name' => 'E-Sports & Gaming',
            'slug' => 'e-sports-gaming',
        ]);

        // 3. Insert Sampel Events (Minimal 6 Event Acak yang Bervariatif)
        Event::create([
            'category_id' => $catCreative->id,
            'title' => 'UI/UX Masterclass',
            'description' => 'Pelajari prinsip dasar desain UI/UX, user research, wireframing, hingga prototyping menggunakan Figma bersama praktisi berpengalaman.',
            'date' => '2026-08-12 09:00:00',
            'location' => 'Ruang Seminar G.3.2',
            'price' => 75000,
            'stock' => 50,
            'poster_path' => 'posters/uiux-masterclass.png',
        ]);

        Event::create([
            'category_id' => $catGaming->id,
            'title' => 'E-Sport U-Champ 2026',
            'description' => 'Turnamen E-Sport tingkat universitas yang mempertemukan tim-tim terbaik untuk memperebutkan gelar juara dan total hadiah jutaan rupiah.',
            'date' => '2026-08-20 10:00:00',
            'location' => 'Amikom Arena (Basement G.5)',
            'price' => 50000,
            'stock' => 32, // Slot untuk 32 tim
            'poster_path' => 'posters/esport-uchamp.png',
        ]);

        Event::create([
            'category_id' => $catIT->id,
            'title' => 'Laravel Web Development Boot Camp',
            'description' => 'Workshop intensif membangun aplikasi web modern berskala enterprise menggunakan Laravel 11/12 dari nol hingga deployment.',
            'date' => '2026-09-05 08:30:00',
            'location' => 'Laboratorium Komputer 4',
            'price' => 120000,
            'stock' => 40,
            'poster_path' => 'posters/laravel-bootcamp.png',
        ]);

        Event::create([
            'category_id' => $catGaming->id,
            'title' => 'Mobile Legends Amikom Tournament',
            'description' => 'Asah skill mekanik tim kamu dan tunjukkan sportivitas terbaik di turnamen MLBB Amikom Hub.',
            'date' => '2026-09-18 13:00:00',
            'location' => 'Ruang Cinema Amikom',
            'price' => 35000,
            'stock' => 64,
            'poster_path' => 'posters/mlbb-tournament.png',
        ]);

        Event::create([
            'category_id' => $catCreative->id,
            'title' => 'Photography & Visual Storytelling Workshop',
            'description' => 'Bongkar rahasia menghasilkan foto bercerita yang estetik serta teknik editing warna tingkat lanjut menggunakan Lightroom.',
            'date' => '2026-10-02 09:00:00',
            'location' => 'Studio Foto Amikom Creative',
            'price' => 60000,
            'stock' => 25,
            'poster_path' => 'posters/photography-workshop.png',
        ]);

        Event::create([
            'category_id' => $catIT->id,
            'title' => 'Artificial Intelligence & Prompt Engineering Seminar',
            'description' => 'Seminar eksklusif mengenai masa depan teknologi kecerdasan buatan dan bagaimana merevolusi produktivitas menggunakan prompt engineering.',
            'date' => '2026-10-15 13:30:00',
            'location' => 'Grand Auditorium Amikom',
            'price' => 40000,
            'stock' => 300,
            'poster_path' => 'posters/ai-seminar.png',
        ]);
    }
}