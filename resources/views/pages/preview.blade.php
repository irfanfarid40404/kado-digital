@php
    $theme = $page->theme;
    $themeBg = match($theme) {
        'playful' => 'bg-[#FFF6E9] text-[#000000]',
        'elegant_night' => 'bg-[#0F1B2D] text-[#EDE3D0]',
        default => 'bg-[#FAF3E9] text-[#000000]',
    };

    $headerFont = match($theme) {
        'playful' => 'font-display-playful text-[#F4623A]',
        'elegant_night' => 'font-display-elegant text-[#D4B98C]',
        default => 'font-display-romantic text-[#6B1F2A]',
    };

    $cardBg = match($theme) {
        'playful' => 'bg-[#FFDCC2] text-[#000000]',
        'elegant_night' => 'bg-[#1C2E47] text-[#EDE3D0]',
        default => 'bg-[#F1DCD4] text-[#000000]',
    };
@endphp

<x-layouts.app title="Preview Halaman Surprise — {{ $page->recipient_name }}">
    <div class="min-h-screen {{ $themeBg }} relative pb-32">

        <!-- Repeating Watermark Overlay Neo-Brutalist -->
        <div class="fixed inset-0 pointer-events-none z-30 flex flex-wrap items-center justify-around opacity-15 select-none overflow-hidden rotate-[-25deg] scale-125">
            @for($i = 0; $i < 40; $i++)
                <div class="text-xl sm:text-3xl font-black uppercase tracking-widest px-8 py-6 text-black">
                    PREVIEW — BELUM DIPUBLIKASIKAN
                </div>
            @endfor
        </div>

        <!-- Banner Notification Top Neo-Brutalist -->
        <div class="bg-[#F2B705] border-b-4 border-black text-black py-3 px-4 text-center text-xs font-black tracking-wide flex items-center justify-center space-x-2 shadow-sm">
            <span>⚡️ TAMPILAN PREVIEW — Halaman belum aktif &amp; belum ber-URL publik.</span>
        </div>

        <!-- Content Preview Wrapper -->
        <div class="max-w-3xl mx-auto px-6 py-12">

            <!-- Hero Header -->
            <div class="text-center mb-12">
                <div class="inline-block px-5 py-1.5 rounded-full bg-white text-black text-xs font-black uppercase tracking-wider mb-4 neo-badge">
                    Untuk {{ $page->recipient_name }}
                </div>
                <h1 class="{{ $headerFont }} text-4xl sm:text-6xl font-black mb-4 leading-tight">
                    {{ $page->title }}
                </h1>
                <p class="text-sm font-bold opacity-80">
                    Preview tampilan surprise kado buatanmu
                </p>
            </div>

            <!-- Countdown Timer Preview Neo-Brutalist -->
            @if($page->countdown_date)
                <div class="mb-12 p-8 rounded-3xl neo-card text-center {{ $cardBg }}">
                    <div class="text-xs uppercase font-black tracking-widest mb-4 opacity-90">Menuju Momen Spesial</div>
                    <div class="grid grid-cols-4 gap-3 sm:gap-4 max-w-sm mx-auto">
                        <div class="p-3 rounded-2xl bg-white text-black neo-border-sm">
                            <span class="block text-2xl sm:text-3xl font-black">08</span>
                            <span class="text-[10px] font-black uppercase">Hari</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white text-black neo-border-sm">
                            <span class="block text-2xl sm:text-3xl font-black">14</span>
                            <span class="text-[10px] font-black uppercase">Jam</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white text-black neo-border-sm">
                            <span class="block text-2xl sm:text-3xl font-black">32</span>
                            <span class="text-[10px] font-black uppercase">Menit</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white text-black neo-border-sm">
                            <span class="block text-2xl sm:text-3xl font-black">45</span>
                            <span class="text-[10px] font-black uppercase">Detik</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Photos Gallery Preview Neo-Brutalist -->
            @if($page->photos->count() > 0)
                <div class="mb-12">
                    <h3 class="text-xs font-black uppercase tracking-widest text-center mb-6 opacity-80">Kenangan Indah</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($page->photos as $photo)
                            <div class="rounded-3xl overflow-hidden neo-card aspect-4/3 group">
                                <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Story Letter Preview Neo-Brutalist -->
            <div class="p-8 sm:p-12 rounded-3xl neo-card {{ $cardBg }} leading-relaxed whitespace-pre-line text-base font-serif italic mb-12">
                "{{ $page->story }}"
            </div>

            <!-- Audio Player Mockup Neo-Brutalist -->
            <div class="p-4 rounded-2xl bg-white text-black neo-card-sm flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-[#F2B705] text-black font-black flex items-center justify-center text-lg neo-border-sm">🎵</div>
                    <div>
                        <div class="text-xs font-black">Musik Latar</div>
                        <div class="text-[10px] font-bold opacity-75">Otomatis diputar saat pasanganmu membuka web</div>
                    </div>
                </div>
                <span class="text-xs px-3 py-1 rounded-full bg-black text-white font-black neo-border-sm">Auto-Play</span>
            </div>

        </div>

        <!-- Floating Bottom Action Bar Neo-Brutalist -->
        <div class="fixed bottom-0 inset-x-0 bg-white border-t-4 border-black py-4 px-6 z-40 neo-shadow">
            <div class="max-w-4xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
                <div>
                    <div class="text-xs font-black text-black/70">Suka Dengan Tampilan Halaman Ini?</div>
                    <div class="text-sm font-black text-black">Publikasikan &amp; Dapatkan Link + QR Code Unik</div>
                </div>
                <div class="flex items-center space-x-3 w-full sm:w-auto">
                    <a href="{{ route('create.theme', ['theme' => $page->theme]) }}" class="px-5 py-3 rounded-xl bg-white text-black font-black text-xs neo-btn">
                        Edit Lagi
                    </a>
                    <a href="{{ route('checkout', ['page' => $page->id]) }}" class="px-6 py-3 rounded-xl bg-[#F4623A] text-white font-black text-sm neo-btn flex-1 sm:flex-none text-center">
                        Pilih Paket &amp; Dipublikasikan 🚀
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
