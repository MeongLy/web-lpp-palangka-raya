<!-- ===== VISI & MISI ===== -->
<section id="visi-misi" class="py-16 sm:py-20 bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-12 fade-in">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0a1638]">Visi & Misi</h2>
            <div class="section-divider"></div>
        </div>

        <!-- Content -->
        <div class="grid md:grid-cols-2 gap-6 lg:gap-8">

            <!-- Visi -->
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg fade-in border-t-4 border-[#FFD700]">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-[#0a1638] rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-eye text-[#FFD700] text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#0a1638]">Visi</h3>
                </div>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed whitespace-pre-line">
                    @if($profil && $profil->visi)
                        {{ $profil->visi }}
                    @else
                        Menjadi lembaga pemasyarakatan perempuan yang unggul dalam pembinaan, berbasis hak asasi manusia, dan berwawasan lingkungan.
                    @endif
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg fade-in border-t-4 border-[#FFD700]">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-[#0a1638] rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-bullseye text-[#FFD700] text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#0a1638]">Misi</h3>
                </div>

                @if($profil && $profil->misi)
                    @php
                        // Pecah misi berdasarkan baris baru
                        $misiList = preg_split('/\r\n|\r|\n/', trim($profil->misi));
                        $misiList = array_filter($misiList); // Hapus baris kosong
                    @endphp

                    <ul class="space-y-3 text-sm sm:text-base text-gray-700">
                        @foreach($misiList as $misi)
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-[#FFD700] mt-1 mr-3 text-base flex-shrink-0"></i>
                            <span>{{ ltrim($misi, '-•* ') }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <ul class="space-y-3 text-sm sm:text-base text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-[#FFD700] mt-1 mr-3 text-base flex-shrink-0"></i>
                            <span>Menyelenggarakan pembinaan kepribadian dan kemandirian secara terpadu.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-[#FFD700] mt-1 mr-3 text-base flex-shrink-0"></i>
                            <span>Memberikan pelayanan kesehatan dan psikososial yang humanis.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-[#FFD700] mt-1 mr-3 text-base flex-shrink-0"></i>
                            <span>Mengembangkan keterampilan vokasional untuk bekal hidup mandiri.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-[#FFD700] mt-1 mr-3 text-base flex-shrink-0"></i>
                            <span>Membangun kerjasama dengan berbagai pihak untuk mendukung reintegrasi sosial.</span>
                        </li>
                    </ul>
                @endif
            </div>

        </div>
    </div>
</section>
