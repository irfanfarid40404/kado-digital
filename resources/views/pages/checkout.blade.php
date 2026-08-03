<x-layouts.app title="Pilih Paket & Dipublikasikan — Surprise">
    <div class="min-h-screen bg-[#FFF6E9] text-[#000000] py-12 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">

            <!-- Navigation Top -->
            <div class="mb-8">
                <a href="{{ route('preview', ['page' => $page->id]) }}" class="inline-flex items-center text-sm font-black text-black hover:underline">
                    ← Kembali ke Preview
                </a>
            </div>

            <!-- Page Title -->
            <div class="text-center mb-10">
                <span class="bg-[#F2B705] text-black text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                    Langkah Akhir
                </span>
                <h1 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                    Pilih Paket Publikasi
                </h1>
                <p class="text-sm font-bold text-black/80 max-w-md mx-auto">
                    Bayar sekali untuk mengaktifkan Link Custom &amp; QR Code yang bisa di-scan langsung oleh pasanganmu.
                </p>
            </div>

            <!-- Package Selection Form Neo-Brutalist -->
            <form action="{{ route('checkout.process', ['page' => $page->id]) }}" method="POST" x-data="{ selectedPackage: 'premium' }">
                @csrf
                <input type="hidden" name="package" :value="selectedPackage">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

                    <!-- Basic Package -->
                    <div @click="selectedPackage = 'basic'"
                        :class="selectedPackage === 'basic' ? 'ring-4 ring-black bg-[#FFDCC2]' : 'bg-white'"
                        class="cursor-pointer rounded-3xl p-6 neo-card transition-all duration-200 flex flex-col justify-between relative">
                        <div>
                            <div class="text-xs uppercase font-black text-black/70 mb-2">Paket Simple</div>
                            <h3 class="font-black text-2xl text-black mb-1">Basic</h3>
                            <div class="text-3xl font-black text-black my-4">
                                Rp15.000 <span class="text-xs font-bold opacity-70">/sekali</span>
                            </div>
                            <ul class="text-xs font-bold space-y-2.5 text-black my-6">
                                <li class="flex items-center">✓ Teks Surat Romantis</li>
                                <li class="flex items-center">✓ Hingga 3 Foto Memori</li>
                                <li class="flex items-center">✓ Musik Latar Preset</li>
                                <li class="flex items-center">✓ Link Custom Unique</li>
                                <li class="flex items-center">✓ QR Code Generator</li>
                            </ul>
                        </div>
                        <div class="pt-4 border-t-2 border-black text-center">
                            <span :class="selectedPackage === 'basic' ? 'bg-black text-white' : 'bg-gray-100 text-black'"
                                class="inline-block w-full py-3 rounded-xl font-black text-xs neo-border-sm">
                                <span x-text="selectedPackage === 'basic' ? 'DIPILIH ✓' : 'PILIH BASIC'"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Premium Package (POPULAR) -->
                    <div @click="selectedPackage = 'premium'"
                        :class="selectedPackage === 'premium' ? 'ring-4 ring-black bg-[#F2B705]' : 'bg-white'"
                        class="cursor-pointer rounded-3xl p-6 neo-card transition-all duration-200 flex flex-col justify-between relative transform md:-translate-y-2">
                        <div class="absolute -top-4 inset-x-0 flex justify-center">
                            <span class="bg-[#F4623A] text-white text-[10px] font-black uppercase px-4 py-1 rounded-full neo-badge">
                                🔥 Paling Populer
                            </span>
                        </div>
                        <div>
                            <div class="text-xs uppercase font-black text-black mb-2">Rekomendasi Utama</div>
                            <h3 class="font-display-playful font-black text-3xl text-black mb-1">Premium</h3>
                            <div class="text-3xl font-black text-black my-4">
                                Rp35.000 <span class="text-xs font-bold opacity-70">/sekali</span>
                            </div>
                            <ul class="text-xs font-bold space-y-2.5 text-black my-6">
                                <li class="flex items-center">✓ Teks Surat Romantis</li>
                                <li class="flex items-center">✓ Hingga 8 Foto Memori</li>
                                <li class="flex items-center">✓ Musik Preset / Upload MP3</li>
                                <li class="flex items-center">✓ Timer Hitung Mundur Event</li>
                                <li class="flex items-center">✓ QR Code High-Resolution</li>
                                <li class="flex items-center">✓ Animasi Reveal GSAP</li>
                            </ul>
                        </div>
                        <div class="pt-4 border-t-2 border-black text-center">
                            <span :class="selectedPackage === 'premium' ? 'bg-black text-white' : 'bg-gray-100 text-black'"
                                class="inline-block w-full py-3 rounded-xl font-black text-xs neo-border-sm">
                                <span x-text="selectedPackage === 'premium' ? 'DIPILIH ✓' : 'PILIH PREMIUM'"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Exclusive Package -->
                    <div @click="selectedPackage = 'exclusive'"
                        :class="selectedPackage === 'exclusive' ? 'ring-4 ring-black bg-[#2E8B8B] text-white' : 'bg-white text-black'"
                        class="cursor-pointer rounded-3xl p-6 neo-card transition-all duration-200 flex flex-col justify-between relative">
                        <div>
                            <div class="text-xs uppercase font-black opacity-80 mb-2">Paket Lengkap</div>
                            <h3 class="font-black text-2xl mb-1">Eksklusif</h3>
                            <div class="text-3xl font-black my-4">
                                Rp75.000 <span class="text-xs font-bold opacity-70">/sekali</span>
                            </div>
                            <ul class="text-xs font-bold space-y-2.5 my-6">
                                <li class="flex items-center">✓ Teks Surat Romantis</li>
                                <li class="flex items-center">✓ Foto Tanpa Batas</li>
                                <li class="flex items-center">✓ Musik Preset &amp; Upload MP3</li>
                                <li class="flex items-center">✓ Countdown Timer &amp; Animasi</li>
                                <li class="flex items-center">✓ QR Code High-Res + Card</li>
                                <li class="flex items-center">✓ Akses Selamanya</li>
                            </ul>
                        </div>
                        <div class="pt-4 border-t-2 border-black text-center">
                            <span :class="selectedPackage === 'exclusive' ? 'bg-black text-white' : 'bg-gray-100 text-black'"
                                class="inline-block w-full py-3 rounded-xl font-black text-xs neo-border-sm">
                                <span x-text="selectedPackage === 'exclusive' ? 'DIPILIH ✓' : 'PILIH EKSKLUSIF'"></span>
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Submit Section Neo-Brutalist -->
                <div class="p-6 sm:p-8 rounded-3xl bg-white text-black neo-card flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <div class="text-xs font-black text-black/70 uppercase">Ringkasan Pembayaran:</div>
                        <div class="text-xl font-black text-black">
                            Paket <span x-text="selectedPackage.toUpperCase()" class="capitalize"></span> — 
                            <span x-text="selectedPackage === 'basic' ? 'Rp15.000' : (selectedPackage === 'premium' ? 'Rp35.000' : 'Rp75.000')"></span>
                        </div>
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-[#F4623A] text-white font-black text-base neo-btn">
                        Lanjut ke Pembayaran 🚀
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.app>
