<x-layouts.app title="Surprise Siap Dikirim! — {{ $page->recipient_name }}">
    <div class="min-h-screen bg-[#FFF6E9] text-black py-12 px-4 sm:px-6">
        <div class="max-w-2xl mx-auto text-center" x-data="{ copied: false }">

            <!-- Celebration Icon Neo-Brutalist -->
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-[#F4623A] text-white flex items-center justify-center neo-card animate-bounce text-3xl font-black">
                🎉
            </div>

            <!-- Title & Congratulations Neo-Brutalist -->
            <h1 class="font-display-playful text-3xl sm:text-5xl font-black text-black mb-3">
                Halaman Surprise Berhasil Dipublikasikan!
            </h1>
            <p class="text-sm font-bold text-black/80 max-w-md mx-auto mb-8">
                Pesan &amp; kenangan indahmu untuk <strong>{{ $page->recipient_name }}</strong> sudah siap dibuka dan dinikmati.
            </p>

            <!-- Card Result Neo-Brutalist -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 neo-card space-y-6 text-left mb-8">

                <!-- Link Display Box -->
                <div>
                    <label class="block text-xs font-black text-black uppercase tracking-wider mb-2">Link Halaman Surprise Unik</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" readonly value="{{ $publicUrl }}" id="public-url-input"
                            class="flex-1 bg-[#FFF6E9] rounded-xl px-4 py-3 text-xs sm:text-sm font-mono font-bold text-black neo-input">
                        <button @click="navigator.clipboard.writeText('{{ $publicUrl }}'); copied = true; setTimeout(() => copied = false, 3000);"
                            class="px-5 py-3 bg-[#F2B705] text-black font-black text-xs rounded-xl neo-btn">
                            <span x-text="copied ? 'TERSALIN! ✓' : 'SALIN LINK'"></span>
                        </button>
                    </div>
                </div>

                <!-- QR Code Display Box Neo-Brutalist -->
                @if($page->qrCode)
                    <div class="pt-6 border-t-2 border-black flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="w-40 h-40 p-3 bg-white rounded-2xl neo-card flex items-center justify-center">
                            <img src="{{ asset('storage/' . $page->qrCode->file_path) }}" alt="QR Code" class="w-full h-full object-contain">
                        </div>
                        <div class="flex-1 text-left space-y-3">
                            <h4 class="font-black text-base text-black">QR Code Siap Cetak 📱</h4>
                            <p class="text-xs font-bold text-black/80 leading-relaxed">
                                Kamu bisa mengunduh QR Code ini untuk dicetak di kartu ucapan, buket bunga, atau kado fisik.
                            </p>
                            <a href="{{ asset('storage/' . $page->qrCode->file_path) }}" download="QR-Surprise-{{ $page->recipient_name }}.svg"
                                class="inline-block px-5 py-2.5 bg-[#FFDCC2] text-black text-xs font-black rounded-xl neo-btn">
                                ⬇ Download QR Code (SVG/PNG)
                            </a>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Action Buttons Neo-Brutalist -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ $waShareUrl }}" target="_blank"
                    class="w-full sm:w-auto px-8 py-4 bg-emerald-500 text-white font-black text-sm rounded-2xl neo-btn flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-0.999 3.648 3.742-.981z"/></svg>
                    <span>Kirim via WhatsApp 📲</span>
                </a>

                <a href="{{ $publicUrl }}" target="_blank"
                    class="w-full sm:w-auto px-8 py-4 bg-[#F4623A] text-white font-black text-sm rounded-2xl neo-btn">
                    Buka Halaman Surprise →
                </a>
            </div>

        </div>
    </div>
</x-layouts.app>
