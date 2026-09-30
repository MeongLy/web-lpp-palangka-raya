<!-- ===== KONTAK ===== -->
<section id="kontak" class="py-16 sm:py-20 bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-12 fade-in">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0a1638]">Hubungi Kami</h2>
            <div class="section-divider"></div>
        </div>

        <div class="grid lg:grid-cols-5 gap-6">

            <!-- Form -->
            <div class="lg:col-span-3 fade-in">
                <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold text-[#0a1638] mb-5">Kirim Pesan</h3>
                    <form action="#" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1.5 text-sm">Nama Lengkap</label>
                            <input type="text"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                                   placeholder="Nama Anda">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1.5 text-sm">Email</label>
                            <input type="email"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                                   placeholder="email@example.com">
                        </div>

                        <div class="mb-5">
                            <label class="block text-gray-700 font-medium mb-1.5 text-sm">Pesan</label>
                            <textarea rows="4"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                                      placeholder="Tulis pesan Anda..."></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-[#0a1638] text-white font-semibold py-3 rounded-lg hover:bg-[#0f1f4a] transition shadow-lg hover:shadow-xl text-sm">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Kontak & Maps -->
            <div class="lg:col-span-2 fade-in flex flex-col space-y-3">

                <!-- Alamat -->
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-[#0a1638] rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-[#FFD700] text-base"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0a1638] text-sm">Alamat</h4>
                            <p class="text-gray-600 text-sm mt-0.5">
                                {{ $pengaturan['alamat'] ?? 'Jl. Tjilik Riwut No.km. 5, Bukit Tunggal, Kec. Jekan Raya, Kota Palangka Raya, Kalimantan Tengah 74874' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-[#0a1638] rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-[#FFD700] text-base"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0a1638] text-sm">Telepon</h4>
                            <p class="text-gray-600 text-sm mt-0.5">{{ $pengaturan['telepon'] ?? '+62 812-3456-7890' }}</p>
                            <p class="text-gray-600 text-sm">{{ $pengaturan['telepon_2'] ?? '+62 853-1234-5678' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-[#0a1638] rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-[#FFD700] text-base"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0a1638] text-sm">Email</h4>
                            <p class="text-gray-600 text-sm mt-0.5 break-all">{{ $pengaturan['email'] ?? 'lapas.perempuan@kemenkumham.go.id' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Maps -->
                <div class="bg-white p-4 rounded-xl shadow-lg flex-1">
                    <h4 class="font-bold text-[#0a1638] text-sm mb-2">Lokasi Kami</h4>
                    <div class="w-full h-48 rounded-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.987654321!2d113.920245!3d-2.183333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfb6e6d3b0b5d9f%3A0x3b9f5c3a1c2b0a3d!2sJl.%20Tjilik%20Riwut%20No.km.%205%2C%20Bukit%20Tunggal%2C%20Kec.%20Jekan%20Raya%2C%20Kota%20Palangka%20Raya%2C%20Kalimantan%20Tengah%2074874!5e0!3m2!1sid!2sid!4v1700000000000"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
