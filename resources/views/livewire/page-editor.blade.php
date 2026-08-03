@php
    $themeBg = match($theme) {
        'playful' => 'bg-[#FFF6E9] text-[#000000]',
        'elegant_night' => 'bg-[#0F1B2D] text-[#EDE3D0]',
        default => 'bg-[#FAF3E9] text-[#000000]',
    };

    $cardBg = match($theme) {
        'playful' => 'bg-[#FFDCC2] text-[#000000]',
        'elegant_night' => 'bg-[#1C2E47] text-[#EDE3D0]',
        default => 'bg-[#F1DCD4] text-[#000000]',
    };

    $headerFont = match($theme) {
        'playful' => 'font-display-playful text-[#F4623A]',
        'elegant_night' => 'font-display-elegant text-[#D4B98C]',
        default => 'font-display-romantic text-[#6B1F2A]',
    };

    $btnPrimary = match($theme) {
        'playful' => 'bg-[#F4623A] text-white',
        'elegant_night' => 'bg-[#D4B98C] text-black',
        default => 'bg-[#6B1F2A] text-white',
    };
@endphp

<div class="min-h-screen {{ $themeBg }} py-8 px-4 sm:px-6 transition-colors duration-300">
    <div class="max-w-3xl mx-auto">

        <!-- Top Header Navigation -->
        <div class="flex items-center justify-between mb-8 pb-4 border-b-2 border-black">
            <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-sm font-black hover:underline">
                <span>← Kembali ke Pilih Tema</span>
            </a>
            <div class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-white text-black neo-badge">
                Tema: {{ str_replace('_', ' ', strtoupper($theme)) }}
            </div>
        </div>

        <!-- Editor Card Neo-Brutalist -->
        <div class="rounded-3xl p-6 sm:p-10 neo-card {{ $cardBg }}">

            <!-- Progress Bar & Steps Indicator -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-3 text-xs font-black uppercase tracking-wider">
                    <span>Langkah {{ $currentStep }} dari 5</span>
                    <span class="bg-black text-white px-3 py-1 rounded-lg">
                        @if($currentStep === 1) 1. Info Dasar
                        @elseif($currentStep === 2) 2. Surat &amp; Cerita
                        @elseif($currentStep === 3) 3. Galeri Foto
                        @elseif($currentStep === 4) 4. Musik Latar
                        @elseif($currentStep === 5) 5. Hitung Mundur &amp; Review
                        @endif
                    </span>
                </div>
                <div class="h-3 rounded-full bg-white neo-border-sm overflow-hidden">
                    <div class="h-full transition-all duration-500 ease-out {{ $btnPrimary }}" style="width: {{ ($currentStep / 5) * 100 }}%"></div>
                </div>
            </div>

            <!-- Form Content per Step -->
            <form wire:submit.prevent="savePage">

                <!-- STEP 1: INFO DASAR -->
                @if($currentStep === 1)
                    <div class="space-y-6">
                        <div>
                            <h2 class="{{ $headerFont }} text-3xl font-black mb-2">Siapa Nama Pasanganmu?</h2>
                            <p class="text-sm font-bold opacity-90 mb-6">Nama ini akan menjadi sorotan utama di bagian pembuka surprise.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-black mb-2 uppercase tracking-wide">Nama Panggilan / Kesayangan</label>
                            <input type="text" wire:model="recipient_name" placeholder="Misal: Nadia / Mas Kevin / Sayang"
                                class="w-full px-4 py-3.5 rounded-2xl bg-white text-black font-bold neo-input">
                            @error('recipient_name') <span class="text-red-600 font-bold text-xs mt-1.5 block">⚠️ {{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-black mb-2 uppercase tracking-wide">Judul Pesan Surprise</label>
                            <input type="text" wire:model="title" placeholder="Misal: Selamat Ulang Tahun Nadia! ❤️"
                                class="w-full px-4 py-3.5 rounded-2xl bg-white text-black font-bold neo-input">
                            @error('title') <span class="text-red-600 font-bold text-xs mt-1.5 block">⚠️ {{ $message }}</span> @enderror
                        </div>
                    </div>

                <!-- STEP 2: SURAT & CERITA -->
                @elseif($currentStep === 2)
                    <div class="space-y-6">
                        <div>
                            <h2 class="{{ $headerFont }} text-3xl font-black mb-2">Tuliskan Surat &amp; Ceritamu</h2>
                            <p class="text-sm font-bold opacity-90 mb-6">Ungkapkan perasaan terpendammu. Teks akan tampil dengan layout puitis.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-black mb-2 uppercase tracking-wide">Pesan &amp; Kenangan Spesial</label>
                            <textarea wire:model="story" rows="8" placeholder="Terima kasih sudah selalu menemani perjalanan ini. Dari awal kita bertemu..."
                                class="w-full px-4 py-3.5 rounded-2xl bg-white text-black font-bold leading-relaxed neo-input"></textarea>
                            @error('story') <span class="text-red-600 font-bold text-xs mt-1.5 block">⚠️ {{ $message }}</span> @enderror
                            <p class="text-xs font-bold opacity-75 mt-2">💡 Tips: Tuliskan ucapan ulang tahun, janji manis, atau kenangan tak terlupakan.</p>
                        </div>
                    </div>

                <!-- STEP 3: GALERI FOTO -->
                @elseif($currentStep === 3)
                    <div class="space-y-6">
                        <div>
                            <h2 class="{{ $headerFont }} text-3xl font-black mb-2">Galeri Foto Kenangan</h2>
                            <p class="text-sm font-bold opacity-90 mb-6">Upload foto-foto kebersamaan kalian untuk galeri kenangan.</p>
                        </div>

                        <div class="neo-card-sm rounded-2xl p-6 text-center bg-white text-black">
                            <input type="file" wire:model="photos" multiple accept="image/*" id="photo-upload" class="hidden">
                            <label for="photo-upload" class="cursor-pointer inline-flex flex-col items-center">
                                <span class="text-3xl mb-2">📸</span>
                                <span class="font-black text-sm uppercase">Klik untuk Pilih Foto (Multiple)</span>
                                <span class="text-xs font-bold opacity-70 mt-1">Format JPG, PNG, WEBP (Max 10MB per foto)</span>
                            </label>
                        </div>

                        <div wire:loading wire:target="photos" class="text-xs font-black text-center animate-pulse">
                            ⏳ Mengunggah foto... mohon tunggu sebentar.
                        </div>

                        <!-- Photo Previews Grid Neo-Brutalist -->
                        @if(!empty($photos))
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
                                @foreach($photos as $index => $photo)
                                    <div class="relative group rounded-xl overflow-hidden aspect-square neo-card-sm">
                                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                                        <button type="button" wire:click="removePhoto({{ $index }})"
                                            class="absolute top-2 right-2 bg-red-600 text-white rounded-lg p-1.5 text-xs font-black neo-border-sm hover:bg-red-700">
                                            ✕
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                <!-- STEP 4: MUSIK LATAR -->
                @elseif($currentStep === 4)
                    <div class="space-y-6">
                        <div>
                            <h2 class="{{ $headerFont }} text-3xl font-black mb-2">Musik Latar Belakang</h2>
                            <p class="text-sm font-bold opacity-90 mb-6">Pilih musik romantis yang langsung menyapa saat pasanganmu membuka web ini.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <label class="p-4 rounded-2xl bg-white text-black neo-card-sm cursor-pointer flex flex-col justify-between hover:bg-yellow-100 transition-colors {{ $preset_music === 'piano' ? 'ring-4 ring-black bg-yellow-200' : '' }}">
                                <input type="radio" wire:model.live="preset_music" value="piano" class="hidden">
                                <div>
                                    <div class="font-black text-sm">🎹 Romantic Piano</div>
                                    <div class="text-xs font-bold opacity-75 mt-1">Lembut &amp; Puitis</div>
                                </div>
                                <span class="text-xs font-black mt-3 uppercase tracking-wider">Preset Default</span>
                            </label>

                            <label class="p-4 rounded-2xl bg-white text-black neo-card-sm cursor-pointer flex flex-col justify-between hover:bg-yellow-100 transition-colors {{ $preset_music === 'acoustic' ? 'ring-4 ring-black bg-yellow-200' : '' }}">
                                <input type="radio" wire:model.live="preset_music" value="acoustic" class="hidden">
                                <div>
                                    <div class="font-black text-sm">🎸 Acoustic Love</div>
                                    <div class="text-xs font-bold opacity-75 mt-1">Hangat &amp; Santai</div>
                                </div>
                                <span class="text-xs font-black mt-3 uppercase tracking-wider">Preset Acoustic</span>
                            </label>

                            <label class="p-4 rounded-2xl bg-white text-black neo-card-sm cursor-pointer flex flex-col justify-between hover:bg-yellow-100 transition-colors {{ $preset_music === 'lofi' ? 'ring-4 ring-black bg-yellow-200' : '' }}">
                                <input type="radio" wire:model.live="preset_music" value="lofi" class="hidden">
                                <div>
                                    <div class="font-black text-sm">☕ Sweet Lo-Fi</div>
                                    <div class="text-xs font-bold opacity-75 mt-1">Chill &amp; Modern</div>
                                </div>
                                <span class="text-xs font-black mt-3 uppercase tracking-wider">Preset Lo-Fi</span>
                            </label>
                        </div>

                        <!-- Option Upload Custom MP3 -->
                        <div class="pt-4 border-t-2 border-black">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" wire:model.live="preset_music" value="custom" class="w-5 h-5 accent-black">
                                <span class="font-black text-sm uppercase">Upload Lagu Sendiri (MP3)</span>
                            </label>

                            @if($preset_music === 'custom')
                                <div class="mt-4 p-4 rounded-2xl bg-white text-black neo-input">
                                    <input type="file" wire:model="custom_audio" accept="audio/*" class="w-full text-xs font-bold">
                                    @error('custom_audio') <span class="text-red-600 font-bold text-xs mt-1 block">⚠️ {{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                <!-- STEP 5: HITUNG MUNDUR & REVIEW -->
                @elseif($currentStep === 5)
                    <div class="space-y-6">
                        <div>
                            <h2 class="{{ $headerFont }} text-3xl font-black mb-2">Hitung Mundur &amp; Final Review</h2>
                            <p class="text-sm font-bold opacity-90 mb-6">Atur tanggal momen spesial (opsional) lalu periksa kembali datamu.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-black mb-2 uppercase tracking-wide">Tanggal &amp; Waktu Event (Opsional)</label>
                            <input type="datetime-local" wire:model="countdown_date"
                                class="w-full px-4 py-3.5 rounded-2xl bg-white text-black font-bold neo-input">
                            <p class="text-xs font-bold opacity-75 mt-1.5">Bisa dikosongkan jika tidak butuh timer hitung mundur.</p>
                        </div>

                        <div class="p-6 rounded-2xl bg-white text-black neo-card space-y-3">
                            <h4 class="font-black text-sm uppercase tracking-wider border-b-2 border-black pb-2">Ringkasan Data Surprise</h4>
                            <div class="grid grid-cols-2 gap-3 text-xs font-bold">
                                <div><span class="opacity-70">Pasangan:</span> <strong class="text-base font-black text-black">{{ $recipient_name }}</strong></div>
                                <div><span class="opacity-70">Jumlah Foto:</span> <strong class="text-base font-black text-black">{{ count($photos) }} foto</strong></div>
                                <div><span class="opacity-70">Musik:</span> <strong class="text-base font-black text-black">{{ ucfirst($preset_music) }}</strong></div>
                                <div><span class="opacity-70">Timer Event:</span> <strong class="text-base font-black text-black">{{ $countdown_date ? date('d M Y H:i', strtotime($countdown_date)) : 'Tidak Ada' }}</strong></div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Navigation Controls Neo-Brutalist -->
                <div class="flex items-center justify-between pt-8 mt-10 border-t-2 border-black">
                    @if($currentStep > 1)
                        <button type="button" wire:click="prevStep"
                            class="px-6 py-3 rounded-xl bg-white text-black font-black text-sm neo-btn">
                            ← Kembali
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if($currentStep < 5)
                        <button type="button" wire:click="nextStep"
                            class="px-8 py-3.5 rounded-xl font-black text-sm neo-btn {{ $btnPrimary }}">
                            Lanjut ke Step {{ $currentStep + 1 }} →
                        </button>
                    @else
                        <button type="submit"
                            class="px-8 py-4 rounded-xl font-black text-base neo-btn {{ $btnPrimary }}">
                            Preview &amp; Dipublikasikan ✨
                        </button>
                    @endif
                </div>

            </form>

        </div>

    </div>
</div>
