public function run(): void
{
    $this->call([
        UserSeeder::class,
        ProfilSeeder::class,
        PejabatSeeder::class,
        BeritaSeeder::class,
        GaleriSeeder::class,
        LayananSeeder::class,
        PengaturanSeeder::class,
        StrukturSeeder::class,  // ← Tambahkan
    ]);
}
