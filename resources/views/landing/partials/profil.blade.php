<!-- ===== PROFIL ===== -->
<section id="profil" class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-12 fade-in">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0a1638]">Profil Lapas</h2>
            <div class="section-divider"></div>
        </div>

        <!-- Content -->
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-stretch">

            <!-- Text / Quote -->
            <div class="fade-in order-2 md:order-1 flex">
                <div class="bg-[#0a1638] text-white p-6 sm:p-8 rounded-xl shadow-lg flex flex-col justify-center w-full">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-quote-left text-[#FFD700] text-2xl mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="text-sm sm:text-base leading-relaxed text-justify whitespace-pre-line">
                                @if($profil && $profil->sejarah)
                                    {{ $profil->sejarah }}
                                @else
                                    Lapas Perempuan Kelas IIA Palangka Raya dibentuk karena adanya kebutuhan akan lembaga pemasyarakatan khusus perempuan di Kalimantan Tengah. Pembentukannya ditetapkan berdasarkan Keputusan Menteri Hukum dan HAM RI Nomor SEK-33.KP.03.03 Tahun 2016 tanggal 14 Desember 2016 dan mulai beroperasi pada 19 Januari 2017.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="fade-in order-1 md:order-2 flex">
                @if($profil && $profil->foto_gedung && file_exists(public_path($profil->foto_gedung)))
                    <img src="{{ asset($profil->foto_gedung) }}"
                         alt="Gedung Lapas Perempuan Palangka Raya"
                         class="zoomable rounded-xl shadow-2xl w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/images4.jpg') }}"
                         alt="Gedung Lapas Perempuan Palangka Raya"
                         class="zoomable rounded-xl shadow-2xl w-full h-full object-cover">
                @endif
            </div>

        </div>

    </div>
</section>
