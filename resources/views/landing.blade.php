<x-layouts.app title="Surprise — Kado Digital & Halaman Romantis Spesial">
    <div class="min-h-screen bg-[#FFF6E9] text-[#000000]">

        <!-- Header / Navbar -->
        <header class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between sticky top-0 bg-[#FFF6E9]/90 backdrop-blur-md z-50 border-b-3 border-black">
            <div class="flex items-center space-x-3">
                <div class="w-11 h-11 rounded-xl bg-[#F4623A] text-white flex items-center justify-center font-black text-2xl neo-card-sm transform -rotate-3">
                    S⚡️
                </div>
                <span class="font-display-playful text-3xl font-black tracking-tight text-black">Surprise!</span>
            </div>
            
            <nav class="hidden md:flex items-center space-x-6 text-sm font-black">
                <a href="#pengalaman" class="hover:text-[#F4623A] transition-colors">Pengalaman</a>
                <a href="#cara-kerja" class="hover:text-[#F4623A] transition-colors">Cara Kerja</a>
                <a href="#pilihan-tema" class="hover:text-[#F4623A] transition-colors">Tema</a>
                <a href="#harga" class="hover:text-[#F4623A] transition-colors">Harga</a>
                <a href="#faq" class="hover:text-[#F4623A] transition-colors">FAQ</a>
            </nav>

            <a href="#pilihan-tema" class="px-6 py-2.5 rounded-xl bg-[#F2B705] text-black font-extrabold text-sm neo-btn">
                Buat Kado Sekarang 🚀
            </a>
        </header>

        <!-- Hero Section -->
        <section class="max-w-5xl mx-auto px-6 pt-12 pb-20 text-center relative">
            
            <!-- Neo-Brutalism Badge -->
            <div class="inline-flex items-center space-x-2 px-5 py-2 rounded-full bg-[#FFDCC2] text-black text-xs font-black tracking-wider uppercase mb-6 neo-badge transform rotate-1">
                <span>🌹 Kado Digital Personal yang Mekar Saat Dibuka</span>
            </div>

            <h1 class="font-display-playful text-4xl sm:text-6xl font-black text-black leading-tight mb-6 tracking-tight">
                Kado Digital Yang<br>
                <span class="inline-block bg-[#F4623A] text-white px-5 py-2 rounded-2xl neo-border mt-2 transform -rotate-1">
                    Mekar Saat Dibuka 🌸
                </span>
            </h1>

            <p class="max-w-2xl mx-auto text-base sm:text-lg font-bold text-black/80 leading-relaxed mb-10">
                Tulis pesanmu, pilih tema visualnya, dan biarkan dia membukanya pelan-pelan — dari <mark class="bg-[#F2B705] px-1.5 py-0.5 neo-border-sm">kunci rahasia</mark>, intro mekar, foto memori, musik favorit, hingga surat pribadi.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                <a href="#pilihan-tema" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-[#F4623A] text-white font-black text-lg neo-btn">
                    Buat Kado Sekarang — Mulai Rp15rb ✨
                </a>
                <a href="/s/untuk-helo-ovoj" target="_blank" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white text-black font-extrabold text-lg neo-btn">
                    Lihat Demo Interaktif 👁️
                </a>
            </div>

            <p class="text-xs font-black text-black/60 uppercase tracking-widest mb-8">
                Tanpa login · Preview gratis sebelum bayar · Penerima cukup buka link
            </p>

            <!-- 3-Step Pill Horizontal -->
            <div class="max-w-3xl mx-auto bg-white rounded-2xl p-4 neo-card grid grid-cols-3 gap-2 text-center text-xs font-black">
                <div class="p-3 rounded-xl bg-[#FFDCC2] neo-border-sm flex flex-col sm:flex-row items-center justify-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-black text-white flex items-center justify-center text-xs">1</span>
                    <span>Pilih Tema</span>
                </div>
                <div class="p-3 rounded-xl bg-[#F2B705] neo-border-sm flex flex-col sm:flex-row items-center justify-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-black text-white flex items-center justify-center text-xs">2</span>
                    <span>Isi Konten</span>
                </div>
                <div class="p-3 rounded-xl bg-[#2E8B8B] text-white neo-border-sm flex flex-col sm:flex-row items-center justify-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-white text-black flex items-center justify-center text-xs">3</span>
                    <span>Kirim Link &amp; QR</span>
                </div>
            </div>

        </section>

        <!-- Divider -->
        <div class="border-t-3 border-black"></div>

        <!-- Section 2: Pengalaman Penerima (Scene Interactive Showcase) -->
        <section id="pengalaman" class="bg-[#FFDCC2] py-20 neo-border-b">
            <div class="max-w-5xl mx-auto px-6" x-data="{ activeScene: 1 }">
                
                <div class="text-center mb-12">
                    <span class="bg-black text-white text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                        Alur Buka Kado
                    </span>
                    <h2 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                        Dibuka Pelan-Pelan, Bukan Cuma Dibaca.
                    </h2>
                    <p class="text-black/80 font-bold max-w-xl mx-auto text-sm sm:text-base">
                        Setiap kado punya urutan rasa: ada gerbang rahasia, momen intro pembuka, isi cerita personal, lalu kejutan penutup.
                    </p>
                </div>

                <!-- Scene Switcher Cards (Neo-Brutalism Grid) -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <button @click="activeScene = 1"
                        :class="activeScene === 1 ? 'bg-[#F4623A] text-white neo-shadow-lg scale-105' : 'bg-white text-black neo-shadow-sm'"
                        class="p-5 rounded-2xl neo-border text-left transition-all duration-200">
                        <div class="text-xs font-black uppercase tracking-widest opacity-80 mb-1">Scene 01</div>
                        <div class="font-black text-lg">🔑 Kunci Rahasia</div>
                        <p class="text-xs font-semibold mt-2 opacity-90">PIN atau tebakan rahasia pembuka kado.</p>
                    </button>

                    <button @click="activeScene = 2"
                        :class="activeScene === 2 ? 'bg-[#F2B705] text-black neo-shadow-lg scale-105' : 'bg-white text-black neo-shadow-sm'"
                        class="p-5 rounded-2xl neo-border text-left transition-all duration-200">
                        <div class="text-xs font-black uppercase tracking-widest opacity-80 mb-1">Scene 02</div>
                        <div class="font-black text-lg">🌸 Intro Mekar</div>
                        <p class="text-xs font-semibold mt-2 opacity-90">Animasi bunga &amp; musik langsung menyambut.</p>
                    </button>

                    <button @click="activeScene = 3"
                        :class="activeScene === 3 ? 'bg-[#2E8B8B] text-white neo-shadow-lg scale-105' : 'bg-white text-black neo-shadow-sm'"
                        class="p-5 rounded-2xl neo-border text-left transition-all duration-200">
                        <div class="text-xs font-black uppercase tracking-widest opacity-80 mb-1">Scene 03</div>
                        <div class="font-black text-lg">📖 Cerita &amp; Foto</div>
                        <p class="text-xs font-semibold mt-2 opacity-90">Surat ungkapan hati &amp; galeri kenangan.</p>
                    </button>

                    <button @click="activeScene = 4"
                        :class="activeScene === 4 ? 'bg-[#6B1F2A] text-white neo-shadow-lg scale-105' : 'bg-white text-black neo-shadow-sm'"
                        class="p-5 rounded-2xl neo-border text-left transition-all duration-200">
                        <div class="text-xs font-black uppercase tracking-widest opacity-80 mb-1">Scene 04</div>
                        <div class="font-black text-lg">🎁 Buket Finale</div>
                        <p class="text-xs font-semibold mt-2 opacity-90">Countdown event &amp; pesan penutup spesial.</p>
                    </button>
                </div>

                <!-- Active Scene Preview Display Card -->
                <div class="bg-white rounded-3xl p-8 neo-card text-center max-w-2xl mx-auto">
                    <template x-if="activeScene === 1">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-[#F4623A] text-white rounded-2xl neo-card-sm mx-auto flex items-center justify-center text-3xl font-black">🔐</div>
                            <h3 class="font-display-playful text-2xl font-black text-black">Gerbang Pembuka Personal</h3>
                            <p class="text-sm font-bold text-black/80">Pasanganmu harus memasukkan tanggal jadian atau kata sandi khusus yang hanya kalian berdua yang tahu sebelum isi kado terbuka!</p>
                        </div>
                    </template>

                    <template x-if="activeScene === 2">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-[#F2B705] text-black rounded-2xl neo-card-sm mx-auto flex items-center justify-center text-3xl font-black">🌺</div>
                            <h3 class="font-display-playful text-2xl font-black text-black">Momen Intro Yang Menyentuh</h3>
                            <p class="text-sm font-bold text-black/80">Begitu kunci terbuka, musik favorit langsung berputar diiringi animasi mekar dan salam pembuka yang hangat.</p>
                        </div>
                    </template>

                    <template x-if="activeScene === 3">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-[#2E8B8B] text-white rounded-2xl neo-card-sm mx-auto flex items-center justify-center text-3xl font-black">💌</div>
                            <h3 class="font-display-playful text-2xl font-black text-black">Surat &amp; Galeri Memori</h3>
                            <p class="text-sm font-bold text-black/80">Susunan surat romantis dengan bingkai khas Neo-Brutalist dan foto-foto momen manis perjalanan cinta kalian.</p>
                        </div>
                    </template>

                    <template x-if="activeScene === 4">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-[#6B1F2A] text-white rounded-2xl neo-card-sm mx-auto flex items-center justify-center text-3xl font-black">🎉</div>
                            <h3 class="font-display-playful text-2xl font-black text-black">Penutup &amp; Hitung Mundur</h3>
                            <p class="text-sm font-bold text-black/80">Timer digital hitung mundur menuju ulang tahun/anniversary lengkap dengan ucapan penutup yang membekas.</p>
                        </div>
                    </template>
                </div>

            </div>
        </section>

        <!-- Section 3: Bayangkan Reaksinya (3 Benefit Postcard Cards) -->
        <section class="py-20 bg-[#FFF6E9]">
            <div class="max-w-5xl mx-auto px-6">
                <div class="text-center mb-14">
                    <span class="bg-[#F4623A] text-white text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                        Bayangkan Reaksinya
                    </span>
                    <h2 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                        Bukan Cuma Chat Biasa. Ini Momen Yang Ditunggu.
                    </h2>
                    <p class="text-black/80 font-bold max-w-xl mx-auto text-sm sm:text-base">
                        Memberi hadiah digital yang terasa dipikirkan baik-baik dan punya sentuhan seni tersendiri.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- Card 1 -->
                    <div class="bg-white rounded-3xl p-8 neo-card neo-tape transform hover:-translate-y-2 transition-transform">
                        <div class="font-display-playful text-4xl font-black text-[#F4623A] mb-3">01</div>
                        <h3 class="font-black text-xl text-black mb-3">Detik Dia Paham Ini Khusus Untuknya</h3>
                        <p class="text-sm font-bold text-black/75 leading-relaxed">
                            Dari tebakan rahasia sampai lagu yang cuma kalian berdua yang paham maknanya — bukan sekadar ucapan tempel yang bisa dikirim ke siapa saja.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-[#F2B705] rounded-3xl p-8 neo-card neo-tape transform hover:-translate-y-2 transition-transform md:rotate-1">
                        <div class="font-display-playful text-4xl font-black text-black mb-3">02</div>
                        <h3 class="font-black text-xl text-black mb-3">Hal-Hal Kecil Jadi Terasa Kelihatan</h3>
                        <p class="text-sm font-bold text-black/90 leading-relaxed">
                            Detail yang biasanya cuma lewat di pesan singkat kini dikemas dalam halaman web visual yang cantik dan berkesan mahal.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-[#2E8B8B] text-white rounded-3xl p-8 neo-card neo-tape transform hover:-translate-y-2 transition-transform md:-rotate-1">
                        <div class="font-display-playful text-4xl font-black text-white mb-3">03</div>
                        <h3 class="font-black text-xl text-white mb-3">Dia Berhenti Sebentar, Bukan Cuma Lewat</h3>
                        <p class="text-sm font-bold text-white/90 leading-relaxed">
                            Alur pembukaan bertahap membuat dia menikmati setiap slide kenangan. Kesannya akan teringat jauh lebih lama!
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="border-t-3 border-black"></div>

        <!-- Section 4: Cara Kerja 4 Steps -->
        <section id="cara-kerja" class="bg-[#F2B705] py-20 neo-border-b">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-14">
                    <span class="bg-black text-white text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                        Langkah Mudah
                    </span>
                    <h2 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                        Dari Ide Kecil Jadi Link Hadiah Aktif
                    </h2>
                    <p class="text-black font-bold max-w-xl mx-auto text-sm sm:text-base">
                        Proses pembuatan tanpa ribet. Tidak perlu instal aplikasi atau pusing desain!
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <div class="bg-white rounded-3xl p-6 neo-card relative">
                        <div class="w-12 h-12 rounded-xl bg-[#F4623A] text-white font-black text-xl flex items-center justify-center neo-card-sm mb-4">1</div>
                        <h3 class="font-black text-lg text-black mb-2">Pilih Tema Suasana</h3>
                        <p class="text-xs font-bold text-black/80 leading-relaxed">Pilih karakter visual: Romantis Klasik, Playful Ceria, atau Elegan Malam.</p>
                    </div>

                    <div class="bg-white rounded-3xl p-6 neo-card relative">
                        <div class="w-12 h-12 rounded-xl bg-[#F2B705] text-black font-black text-xl flex items-center justify-center neo-card-sm mb-4">2</div>
                        <h3 class="font-black text-lg text-black mb-2">Isi Konten &amp; Preview</h3>
                        <p class="text-xs font-bold text-black/80 leading-relaxed">Tulis nama, surat cinta, upload foto memori &amp; pilih lagu latar kesukaan.</p>
                    </div>

                    <div class="bg-white rounded-3xl p-6 neo-card relative">
                        <div class="w-12 h-12 rounded-xl bg-[#2E8B8B] text-white font-black text-xl flex items-center justify-center neo-card-sm mb-4">3</div>
                        <h3 class="font-black text-lg text-black mb-2">Pilih Paket Publikasi</h3>
                        <p class="text-xs font-bold text-black/80 leading-relaxed">Bayar sekali pakai QRIS / E-Wallet (mulai Rp15rb) tanpa berlangganan.</p>
                    </div>

                    <div class="bg-white rounded-3xl p-6 neo-card relative">
                        <div class="w-12 h-12 rounded-xl bg-[#6B1F2A] text-white font-black text-xl flex items-center justify-center neo-card-sm mb-4">4</div>
                        <h3 class="font-black text-lg text-black mb-2">Kirim Link &amp; QR Code</h3>
                        <p class="text-xs font-bold text-black/80 leading-relaxed">Bagikan link via WhatsApp atau cetak QR Code unik di kado fisikmu!</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Section 5: Pilih Tema Visual -->
        <section id="pilihan-tema" class="max-w-6xl mx-auto px-6 py-20">
            <div class="text-center mb-14">
                <span class="bg-[#2E8B8B] text-white text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                    Karakter Visual
                </span>
                <h2 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                    Pilih Tema Favorit Pasanganmu
                </h2>
                <p class="text-black/80 font-bold max-w-xl mx-auto text-sm sm:text-base">
                    Klik tema di bawah ini untuk langsung mulai menyusun hadiah!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Tema 1: Romantis Klasik -->
                <div class="bg-[#FAF3E9] rounded-3xl p-6 neo-card flex flex-col justify-between relative transform hover:-translate-y-2 transition-transform">
                    <div class="absolute -top-3.5 right-6 px-4 py-1 bg-[#6B1F2A] text-[#FAF3E9] text-xs font-black rounded-full neo-badge">
                        🔥 Favorit
                    </div>
                    <div>
                        <div class="h-44 rounded-2xl bg-[#F1DCD4] neo-border-sm p-5 flex flex-col justify-between mb-6 relative">
                            <div class="text-[#6B1F2A] text-xs uppercase tracking-widest font-black">Tema 01</div>
                            <div>
                                <h3 class="font-display-romantic italic text-3xl font-black text-[#6B1F2A]">Romantis Klasik</h3>
                                <p class="text-xs font-bold text-black/70 mt-1">Burgundy, Cream &amp; Gold Accent</p>
                            </div>
                            <div class="absolute bottom-3 right-3 text-3xl">🌹</div>
                        </div>
                        <p class="text-sm font-bold text-black/80 mb-6 leading-relaxed">
                            Nuansa puitis &amp; hangat dengan font serif <em>Fraunces</em> dan ornamen burgundy. Cocok untuk anniversary &amp; momen romantis mendalam.
                        </p>
                    </div>
                    <a href="{{ route('create.theme', ['theme' => 'romantic_classic']) }}" class="w-full text-center py-3.5 px-4 rounded-xl bg-[#6B1F2A] text-[#FAF3E9] font-black text-sm neo-btn">
                        Pilih Romantis Klasik →
                    </a>
                </div>

                <!-- Tema 2: Playful / Ceria -->
                <div class="bg-[#FFDCC2] rounded-3xl p-6 neo-card flex flex-col justify-between relative transform hover:-translate-y-2 transition-transform">
                    <div>
                        <div class="h-44 rounded-2xl bg-[#FFF6E9] neo-border-sm p-5 flex flex-col justify-between mb-6 relative">
                            <div class="text-[#F4623A] text-xs uppercase tracking-widest font-black">Tema 02</div>
                            <div>
                                <h3 class="font-display-playful text-3xl font-black text-[#F4623A]">Playful &amp; Ceria</h3>
                                <p class="text-xs font-bold text-black/70 mt-1">Coral, Mustard &amp; Peach Warm</p>
                            </div>
                            <div class="absolute bottom-3 right-3 text-3xl">🎈</div>
                        </div>
                        <p class="text-sm font-bold text-black/80 mb-6 leading-relaxed">
                            Ceria &amp; penuh warna dengan font membulat <em>Fredoka</em>. Pilihan terbaik untuk surprise ulang tahun atau momen santai.
                        </p>
                    </div>
                    <a href="{{ route('create.theme', ['theme' => 'playful']) }}" class="w-full text-center py-3.5 px-4 rounded-xl bg-[#F4623A] text-white font-black text-sm neo-btn">
                        Pilih Playful &amp; Ceria →
                    </a>
                </div>

                <!-- Tema 3: Elegan Malam -->
                <div class="bg-[#0F1B2D] text-[#EDE3D0] rounded-3xl p-6 neo-card flex flex-col justify-between relative transform hover:-translate-y-2 transition-transform">
                    <div>
                        <div class="h-44 rounded-2xl bg-[#1C2E47] neo-border-sm p-5 flex flex-col justify-between mb-6 relative">
                            <div class="text-[#D4B98C] text-xs uppercase tracking-widest font-black">Tema 03</div>
                            <div>
                                <h3 class="font-display-elegant text-3xl font-black text-[#D4B98C]">Elegan Malam</h3>
                                <p class="text-xs font-bold text-[#EDE3D0]/70 mt-1">Navy Deep &amp; Champagne Gold</p>
                            </div>
                            <div class="absolute bottom-3 right-3 text-3xl">✨</div>
                        </div>
                        <p class="text-sm font-bold text-[#EDE3D0]/90 mb-6 leading-relaxed">
                            Mewah, intim, &amp; eksklusif dengan font <em>Playfair Display</em> di atas latar biru malam. Cocok untuk kejutan berkesan mahal.
                        </p>
                    </div>
                    <a href="{{ route('create.theme', ['theme' => 'elegant_night']) }}" class="w-full text-center py-3.5 px-4 rounded-xl bg-[#D4B98C] text-black font-black text-sm neo-btn">
                        Pilih Elegan Malam →
                    </a>
                </div>

            </div>
        </section>

        <!-- Divider -->
        <div class="border-t-3 border-black"></div>

        <!-- Section 6: Harga / Pricing -->
        <section id="harga" class="bg-[#FFDCC2] py-20 neo-border-b">
            <div class="max-w-5xl mx-auto px-6">
                <div class="text-center mb-14">
                    <span class="bg-black text-white text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                        Pilihan Paket
                    </span>
                    <h2 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                        Bayar Sekali, Tanpa Berlangganan
                    </h2>
                    <p class="text-black/80 font-bold max-w-xl mx-auto text-sm sm:text-base">
                        Satu pembayaran instan untuk satu halaman kado unik yang aktif seketika.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- Basic -->
                    <div class="bg-white rounded-3xl p-8 neo-card flex flex-col justify-between">
                        <div>
                            <div class="text-xs font-black uppercase text-black/60 mb-2">Paket Simple</div>
                            <h3 class="font-black text-2xl text-black">Basic</h3>
                            <div class="text-4xl font-black text-black my-4">
                                Rp15.000 <span class="text-xs font-bold opacity-70">/sekali</span>
                            </div>
                            <ul class="text-xs font-bold space-y-3 text-black my-6">
                                <li class="flex items-center">✓ Teks Surat Romantis</li>
                                <li class="flex items-center">✓ Hingga 3 Foto Memori</li>
                                <li class="flex items-center">✓ Musik Latar Preset</li>
                                <li class="flex items-center">✓ Link Custom Unique</li>
                                <li class="flex items-center">✓ QR Code Generator</li>
                            </ul>
                        </div>
                        <a href="#pilihan-tema" class="w-full text-center py-3.5 px-4 rounded-xl bg-black text-white font-black text-sm neo-btn">
                            Pilih Paket Basic
                        </a>
                    </div>

                    <!-- Premium Popular -->
                    <div class="bg-[#F2B705] rounded-3xl p-8 neo-card flex flex-col justify-between relative transform md:-translate-y-4">
                        <div class="absolute -top-4 inset-x-0 flex justify-center">
                            <span class="bg-[#F4623A] text-white text-[10px] font-black uppercase px-4 py-1 rounded-full neo-badge">
                                🔥 Paling Populer
                            </span>
                        </div>
                        <div>
                            <div class="text-xs font-black uppercase text-black mb-2">Rekomendasi Utama</div>
                            <h3 class="font-display-playful font-black text-3xl text-black">Premium</h3>
                            <div class="text-4xl font-black text-black my-4">
                                Rp35.000 <span class="text-xs font-bold opacity-70">/sekali</span>
                            </div>
                            <ul class="text-xs font-bold space-y-3 text-black my-6">
                                <li class="flex items-center">✓ Teks Surat Romantis</li>
                                <li class="flex items-center">✓ Hingga 8 Foto Memori</li>
                                <li class="flex items-center">✓ Musik Preset / Upload MP3</li>
                                <li class="flex items-center">✓ Timer Hitung Mundur Event</li>
                                <li class="flex items-center">✓ QR Code High-Resolution</li>
                                <li class="flex items-center">✓ Kunci Rahasia Pembuka</li>
                            </ul>
                        </div>
                        <a href="#pilihan-tema" class="w-full text-center py-3.5 px-4 rounded-xl bg-[#F4623A] text-white font-black text-sm neo-btn">
                            Pilih Paket Premium 🚀
                        </a>
                    </div>

                    <!-- Exclusive -->
                    <div class="bg-[#2E8B8B] text-white rounded-3xl p-8 neo-card flex flex-col justify-between">
                        <div>
                            <div class="text-xs font-black uppercase text-white/70 mb-2">Paket Lengkap</div>
                            <h3 class="font-black text-2xl text-white">Eksklusif</h3>
                            <div class="text-4xl font-black text-white my-4">
                                Rp75.000 <span class="text-xs font-bold opacity-70">/sekali</span>
                            </div>
                            <ul class="text-xs font-bold space-y-3 text-white my-6">
                                <li class="flex items-center">✓ Teks Surat Romantis</li>
                                <li class="flex items-center">✓ Foto Tanpa Batas</li>
                                <li class="flex items-center">✓ Musik Preset &amp; Upload MP3</li>
                                <li class="flex items-center">✓ Countdown Timer &amp; Animasi</li>
                                <li class="flex items-center">✓ QR Code High-Res + Card</li>
                                <li class="flex items-center">✓ Akses Selamanya</li>
                            </ul>
                        </div>
                        <a href="#pilihan-tema" class="w-full text-center py-3.5 px-4 rounded-xl bg-white text-black font-black text-sm neo-btn">
                            Pilih Paket Eksklusif
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <!-- Section 7: FAQ (Accordion) -->
        <section id="faq" class="max-w-4xl mx-auto px-6 py-20">
            <div class="text-center mb-12">
                <span class="bg-[#F2B705] text-black text-xs font-black uppercase px-4 py-1.5 rounded-full neo-badge inline-block mb-3">
                    Pertanyaan Umum
                </span>
                <h2 class="font-display-playful text-3xl sm:text-4xl font-black text-black mb-3">
                    Ada Pertanyaan? Kami Punya Jawabannya!
                </h2>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                
                <div class="bg-white rounded-2xl neo-card overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full p-5 text-left font-black text-base flex justify-between items-center">
                        <span>Apakah penerima perlu menginstall aplikasi?</span>
                        <span class="text-xl" x-text="openFaq === 1 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-5 pb-5 text-sm font-bold text-black/80 border-t-2 border-black pt-4">
                        Tidak perlu sama sekali! Penerima cukup mengklik link atau memindai QR Code menggunakan kamera HP. Halaman akan terbuka otomatis di browser seluler (Safari/Chrome/dll).
                    </div>
                </div>

                <div class="bg-white rounded-2xl neo-card overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full p-5 text-left font-black text-base flex justify-between items-center">
                        <span>Berapa lama link halaman surprise ini akan aktif?</span>
                        <span class="text-xl" x-text="openFaq === 2 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-5 pb-5 text-sm font-bold text-black/80 border-t-2 border-black pt-4">
                        Halaman aktif minimal 1 tahun untuk paket Basic &amp; Premium, serta aktif selamanya untuk paket Eksklusif.
                    </div>
                </div>

                <div class="bg-white rounded-2xl neo-card overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full p-5 text-left font-black text-base flex justify-between items-center">
                        <span>Metode pembayaran apa saja yang didukung?</span>
                        <span class="text-xl" x-text="openFaq === 3 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-5 pb-5 text-sm font-bold text-black/80 border-t-2 border-black pt-4">
                        Kami mendukung QRIS (GoPay, OVO, DANA, ShopeePay, LinkAja), serta Virtual Account Bank (BCA, Mandiri, BNI, BRI, Permata).
                    </div>
                </div>

                <div class="bg-white rounded-2xl neo-card overflow-hidden">
                    <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full p-5 text-left font-black text-base flex justify-between items-center">
                        <span>Apakah saya bisa melihat preview dulu sebelum membayar?</span>
                        <span class="text-xl" x-text="openFaq === 4 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-5 pb-5 text-sm font-bold text-black/80 border-t-2 border-black pt-4">
                        Ya! Kamu bisa membuat dan melihat pratinjau halaman secara gratis dengan watermark sebelum memutuskan untuk membeli paket publikasi.
                    </div>
                </div>

            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-black text-white py-12 border-t-4 border-black">
            <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-[#F4623A] text-white flex items-center justify-center font-black text-xl neo-border-sm">
                        S⚡️
                    </div>
                    <span class="font-display-playful text-2xl font-black">Surprise!</span>
                </div>

                <div class="text-xs font-bold text-white/70 text-center md:text-left">
                    &copy; 2026 <strong>Surprise.</strong> Platform Kado Digital Neo-Brutalist Indonesia.
                </div>

                <div class="flex space-x-4 text-xs font-black">
                    <a href="#pilihan-tema" class="hover:text-[#F2B705]">Buat Kado</a>
                    <span>•</span>
                    <a href="#cara-kerja" class="hover:text-[#F2B705]">Cara Kerja</a>
                    <span>•</span>
                    <a href="#harga" class="hover:text-[#F2B705]">Harga</a>
                </div>
            </div>
        </footer>

    </div>
</x-layouts.app>
