@php
    $theme = $page->theme ?? 'romantic_classic';
    $audioSrc = $page->audio ? asset('storage/' . $page->audio->path) : null;
    $photos = $page->photos;
    
    // Build list of tokens for orbit
    $tokens = [];
    
    // Photo tokens
    foreach ($photos as $idx => $photo) {
        $tokens[] = [
            'type' => 'photo',
            'title' => 'Foto ' . ($idx + 1),
            'sub' => 'Kenangan Indah',
            'icon' => 'camera',
            'url' => asset('storage/' . $photo->path),
            'caption' => $photo->caption ?? 'Kenangan manis bersama',
        ];
    }
    
    // Letter token
    $tokens[] = [
        'type' => 'letter',
        'title' => 'Surat Cinta',
        'sub' => 'Kutulis dengan tulus',
        'icon' => 'mail',
        'content' => $page->story,
    ];

    // Spotify / Music token
    $tokens[] = [
        'type' => 'spotify',
        'title' => 'Spotify',
        'sub' => 'Lagu Favorit Kita',
        'icon' => 'music',
        'audio' => $audioSrc,
    ];

    // YouTube token
    $tokens[] = [
        'type' => 'youtube',
        'title' => 'YouTube',
        'sub' => 'Video Kenangan Spesial',
        'icon' => 'video',
        'embed' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
    ];

    // Bouquet token
    $tokens[] = [
        'type' => 'bouquet',
        'title' => ($theme === 'playful' ? 'Kado Kejutan' : ($theme === 'elegant_night' ? 'Hadiah Emas' : 'Buket Mawar')),
        'sub' => 'Hadiah Penutup Spesial',
        'icon' => ($theme === 'playful' ? 'gift' : ($theme === 'elegant_night' ? 'sparkles' : 'flower-2')),
        'rose_img' => asset('images/red-rose.svg'),
    ];

    $totalTokens = count($tokens);
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ $page->title }} — Untuk {{ $page->recipient_name }}</title>
    <meta name="description" content="Halaman kado digital spesial untuk {{ $page->recipient_name }}">
    
    @if($theme === 'playful')
        <meta name="theme-color" content="#FFF6E9">
    @elseif($theme === 'elegant_night')
        <meta name="theme-color" content="#0F1B2D">
    @else
        <meta name="theme-color" content="#2b1419">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Fraunces:ital,opsz,wght@1,9..144,400;1,9..144,600&family=Fredoka:wght@500;600;700&family=Playfair+Display:ital,wght@0,500;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-display-romantic: 'Fraunces', 'Cormorant Garamond', serif;
            --font-display-playful: 'Fredoka', sans-serif;
            --font-display-elegant: 'Playfair Display', serif;
            --font-body: 'Plus Jakarta Sans', system-ui, sans-serif;
            --font-mono: 'IBM Plex Mono', monospace;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; width: 100%; overflow: hidden; font-family: var(--font-body); }

        /* THEME BACKGROUNDS */
        .bg-romantic { background-color: #2b1419; color: #fff8ea; }
        .bg-playful { background-color: #FFF6E9; color: #3A2A1E; }
        .bg-elegant { background-color: #0F1B2D; color: #EDE3D0; }

        /* TAHAP 1: SLIDING PUZZLE SCREEN */
        .puzzle-screen {
            position: fixed; inset: 0; z-index: 2000;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 24px 16px; transition: opacity 0.6s ease, visibility 0.6s ease, transform 0.6s ease;
        }
        .puzzle-screen.fade-out { opacity: 0; visibility: hidden; transform: scale(0.95); pointer-events: none; }

        .puzzle-title { font-size: clamp(20px, 5vw, 28px); font-weight: 700; text-align: center; margin-bottom: 6px; }
        .puzzle-subtitle { font-size: 13px; font-weight: 500; text-align: center; margin-bottom: 20px; opacity: 0.85; }

        .puzzle-board {
            width: clamp(260px, 78vw, 320px); height: clamp(260px, 78vw, 320px);
            border-radius: 24px; padding: 10px;
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;
        }
        .puzzle-tile {
            border-radius: 16px; overflow: hidden; cursor: pointer; position: relative;
            transition: transform 0.15s ease; display: flex; align-items: center; justify-content: center;
        }
        .puzzle-tile:active { transform: scale(0.95); }
        .puzzle-tile.empty { background: transparent; border: 2px dashed rgba(0,0,0,0.15); box-shadow: none; cursor: default; }

        .tile-graphic {
            width: 200%; height: 200%; position: absolute; border-radius: 50%; opacity: 0.85; filter: blur(1px);
        }

        .puzzle-actions { display: flex; flex-direction: column; align-items: center; gap: 10px; margin-top: 20px; }
        .btn-hint-pill {
            display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px; border-radius: 999px;
            font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
        }
        .btn-skip-pill {
            padding: 10px 22px; border-radius: 999px; font-size: 12px; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
        }

        /* TAHAP 2 & 4: FULL WALL TRANSITIONS */
        .full-wall-screen {
            position: fixed; inset: 0; z-index: 1500;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        .full-wall-screen.fade-out { opacity: 0; visibility: hidden; pointer-events: none; }
        .flower-wall-pattern { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.95; }
        .wall-loader-card {
            position: relative; z-index: 10; padding: 16px 28px; border-radius: 999px;
            display: flex; flex-direction: column; align-items: center; gap: 8px; text-align: center; backdrop-filter: blur(8px);
        }

        /* TAHAP 3: COVER UNLOCK SCREEN */
        .intro-cover-screen {
            position: fixed; inset: 0; z-index: 1000;
            display: flex; flex-direction: column; align-items: center; justify-content: space-between;
            padding: 40px 20px; transition: opacity 0.6s ease, visibility 0.6s ease, transform 0.6s ease;
            cursor: pointer; user-select: none;
        }
        .intro-cover-screen.fade-out { opacity: 0; visibility: hidden; transform: scale(1.04); pointer-events: none; }

        .floral-heart-outline-container {
            position: relative; width: clamp(280px, 82vw, 420px); height: clamp(250px, 72vw, 360px);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        .floral-heart-outline-svg { position: absolute; inset: 0; width: 100%; height: 100%; filter: drop-shadow(0 8px 20px rgba(0,0,0,0.5)); }

        @keyframes flower-sway-1 { 0%, 100% { transform: rotate(0deg) scale(1); } 50% { transform: rotate(5deg) scale(1.05); } }
        @keyframes flower-sway-2 { 0%, 100% { transform: rotate(0deg) scale(1); } 50% { transform: rotate(-5deg) scale(1.04); } }
        .sway-flower-a { animation: flower-sway-1 3.5s ease-in-out infinite alternate; transform-origin: center; }
        .sway-flower-b { animation: flower-sway-2 4.2s ease-in-out infinite alternate; transform-origin: center; }

        .floral-heart-text { position: relative; z-index: 10; text-align: center; padding: 0 16px; }
        .floral-heart-text .recipient-title {
            font-family: var(--font-display-romantic); font-style: italic; font-size: clamp(28px, 6.5vw, 42px);
            color: #fff8ea; text-shadow: 0 2px 12px rgba(0,0,0,0.9); line-height: 1.25;
        }
        .floral-heart-text .sender-subtitle {
            font-family: var(--font-mono); font-size: 10px; font-weight: 600;
            letter-spacing: 0.24em; text-transform: uppercase; color: #d9c5a3;
            margin-top: 6px; text-shadow: 0 1px 6px rgba(0,0,0,0.9);
        }

        .tap-prompt-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 20px; border-radius: 999px; font-size: 11px; font-weight: 700;
            border: 2px solid #000; box-shadow: 3px 3px 0px #000; animation: pulse-tap 2s infinite ease-in-out;
        }
        @keyframes pulse-tap { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.06); } }

        /* TAHAP 5: MAIN WORLD SCREEN */
        .main-world-screen { position: relative; width: 100%; height: 100dvh; overflow: hidden; }

        .orbit-header-container {
            position: absolute; left: 50%; top: 24px; transform: translateX(-50%);
            text-align: center; z-index: 45; width: 90%; max-width: 420px;
        }
        .orbit-header-container .mono-header {
            font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.24em; text-transform: uppercase; opacity: 0.9;
        }
        .orbit-header-container h1 {
            font-size: clamp(22px, 5.5vw, 30px); font-weight: 700; margin-top: 4px; line-height: 1.2;
        }

        /* PERFECTLY CENTERED CORE & ORBIT RING */
        .crystal-glow-halo {
            position: absolute; left: 50%; top: 46%; transform: translate(-50%, -50%);
            width: clamp(260px, 42vw, 480px); height: clamp(260px, 42vw, 480px);
            border-radius: 50%; pointer-events: none; z-index: 10;
            background: radial-gradient(circle, rgba(255, 244, 229, 0.55) 0%, rgba(232, 201, 178, 0.35) 30%, transparent 70%);
            animation: halo-breathe 4s ease-in-out infinite;
        }
        @keyframes halo-breathe { 0%, 100% { opacity: 0.7; transform: translate(-50%, -50%) scale(1); } 50% { opacity: 1; transform: translate(-50%, -50%) scale(1.06); } }

        .crystal-heart-wrapper {
            position: absolute; left: 50%; top: 46%; transform: translate(-50%, -50%); z-index: 40;
            display: flex; align-items: center; justify-content: center;
        }
        .crystal-heart-svg {
            width: clamp(180px, 26vw, 280px); height: clamp(180px, 26vw, 280px);
            filter: drop-shadow(0 10px 30px rgba(0,0,0,0.4));
            animation: core-float 5s ease-in-out infinite;
        }
        @keyframes core-float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        .orbit-ellipse-ring {
            position: absolute; left: 50%; top: 46%; transform: translate(-50%, -50%) rotate(-6deg);
            width: min(90vw, 560px); height: min(50vw, 290px);
            border-radius: 50%; pointer-events: none; z-index: 25;
        }

        .constellation-svg { position: absolute; inset: 0; width: 100%; height: 100%; z-index: 20; pointer-events: none; }
        .constellation-line { stroke-width: 1.2; stroke-dasharray: 4 4; opacity: 0.45; }

        /* ROTATING TOKENS & LABELS */
        .token {
            position: absolute; display: flex; flex-direction: column; align-items: center; gap: 5px;
            cursor: pointer; outline: none; z-index: 50;
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .token:hover { transform: scale(1.15) !important; z-index: 70; }
        
        .token-thumb-frame {
            width: 68px; height: 68px; border-radius: 20px; overflow: hidden;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.35); display: flex; align-items: center; justify-content: center;
        }
        .token-thumb-frame img { width: 100%; height: 100%; object-fit: cover; }

        .token-dark-pill {
            display: inline-flex; align-items: center; gap: 5px; height: 24px; padding: 0 10px;
            border-radius: 999px; font-family: var(--font-mono); font-size: 10px; font-weight: 600;
            letter-spacing: 0.04em; white-space: nowrap;
        }

        .orbit-bottom-hint {
            position: absolute; left: 50%; bottom: 24px; transform: translateX(-50%);
            z-index: 60; pointer-events: none; width: 90%; max-width: 380px; text-align: center;
        }
        .orbit-hint-pill-dark {
            padding: 8px 18px; border-radius: 999px; text-align: center;
            font-size: 11px; font-weight: 600; box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        /* MODALS */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 200;
            background: rgba(12, 6, 11, 0.88); backdrop-filter: blur(8px);
            display: flex; align-items: center; justify-content: center; padding: 16px;
            opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
        }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .modal-card {
            width: 90%; max-width: 420px; max-height: 85vh; overflow-y: auto;
            border: 4px solid #000; box-shadow: 8px 8px 0px #000;
            border-radius: 26px; padding: 22px; position: relative;
            transform: scale(0.9) translateY(20px); transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .modal-overlay.active .modal-card { transform: scale(1) translateY(0); }
        .modal-close-btn {
            position: absolute; top: 16px; right: 16px; width: 34px; height: 34px;
            border-radius: 50%; background: #F4623A; color: #fff; font-weight: 900;
            border: 2px solid #000; box-shadow: 2px 2px 0px #000; cursor: pointer;
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }

        .spinning-vinyl { animation: vinyl-spin 4s linear infinite; }
        @keyframes vinyl-spin { to { transform: rotate(360deg); } }

        @keyframes bounce-gentle { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .playful-bouncing-core { animation: bounce-gentle 3s ease-in-out infinite; }

        @keyframes diamond-spin { 0% { transform: rotate(0deg) scale(1); } 50% { transform: rotate(180deg) scale(1.06); } 100% { transform: rotate(360deg) scale(1); } }
        .elegant-gold-diamond { animation: diamond-spin 12s linear infinite; filter: drop-shadow(0 0 25px rgba(212, 185, 140, 0.5)); }
    </style>
</head>
<body class="{{ $theme === 'playful' ? 'bg-playful' : ($theme === 'elegant_night' ? 'bg-elegant' : 'bg-romantic') }}" x-data="surpriseApp()" x-init="init()">

    <!-- AUDIO PLAYER -->
    @if($audioSrc)
        <audio id="bg-audio" loop preload="auto">
            <source src="{{ $audioSrc }}" type="audio/mpeg">
        </audio>
    @endif

    <!-- TAHAP 1: SLIDING PUZZLE SCREEN -->
    <div class="puzzle-screen" :class="{ 'fade-out': puzzleSolved }" x-show="!puzzleSolved"
        style="{{ $theme === 'playful' ? 'background: linear-gradient(168deg, #FFF6E9 0%, #FFDCC2 100%); color: #3A2A1E;' : ($theme === 'elegant_night' ? 'background: linear-gradient(168deg, #0F1B2D 0%, #1C2E47 100%); color: #EDE3D0;' : 'background: linear-gradient(168deg, #fce8e6 0%, #f7d6d0 50%, #f3c2bb 100%); color: #4a2a30;') }}">
        <h2 class="puzzle-title" style="{{ $theme === 'playful' ? 'font-family: var(--font-display-playful); color: #F4623A;' : ($theme === 'elegant_night' ? 'font-family: var(--font-display-elegant); color: #D4B98C;' : 'font-family: var(--font-display-romantic); color: #4a2a30;') }}">
            Susun potongannya untuk membuka
        </h2>
        <p class="puzzle-subtitle">Geser potongan ke tempat yang kosong</p>

        <div class="puzzle-board" style="{{ $theme === 'playful' ? 'background: #fff; border: 2px solid #000; box-shadow: 6px 6px 0px #000;' : ($theme === 'elegant_night' ? 'background: #1C2E47; border: 2px solid #D4B98C;' : 'background: #fff8ea; border: 1px solid rgba(230,180,185,0.6);') }}">
            <template x-for="(tile, index) in puzzleTiles" :key="index">
                <div class="puzzle-tile" :class="{ 'empty': tile === null }" @click="moveTile(index)">
                    <template x-if="tile !== null">
                        <div class="w-full h-full relative overflow-hidden flex items-center justify-center">
                            <div class="tile-graphic" :style="getTileGraphicStyle(tile)"></div>
                            <span class="text-xs font-black text-white z-10 opacity-70" x-text="tile"></span>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <div class="puzzle-actions">
            <div class="btn-hint-pill" style="{{ $theme === 'playful' ? 'background: #F2B705; color: #000; border: 2px solid #000;' : ($theme === 'elegant_night' ? 'background: #D4B98C; color: #000;' : 'background: rgba(255,248,234,0.9); color: #7a4a52;') }}">
                <i data-lucide="{{ $theme === 'playful' ? 'gift' : ($theme === 'elegant_night' ? 'sparkles' : 'heart') }}" class="w-3.5 h-3.5 inline-block"></i>
                <span>GAMBAR UTUH</span>
            </div>
            <button @click="solvePuzzle()" class="btn-skip-pill" style="{{ $theme === 'playful' ? 'background: #F4623A; color: #fff; border: 2px solid #000; box-shadow: 4px 4px 0px #000;' : ($theme === 'elegant_night' ? 'background: #D4B98C; color: #000;' : 'background: #fff8ea; color: #4a2a30;') }}">
                Aku menyerah, buka langsung
            </button>
        </div>
    </div>

    <!-- TAHAP 2: FULL WALL TRANSITION 1 -->
    <div class="full-wall-screen" :class="{ 'fade-out': wall1Finished }" x-show="wall1Active && !wall1Finished" x-cloak
        style="{{ $theme === 'playful' ? 'background: #FFF6E9;' : ($theme === 'elegant_night' ? 'background: #0F1B2D;' : 'background: #2b1419;') }}">
        <svg class="flower-wall-pattern" viewBox="0 0 800 500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <rect width="800" height="500" fill="{{ $theme === 'playful' ? '#FFF6E9' : ($theme === 'elegant_night' ? '#0F1B2D' : '#2b1419') }}"/>
            @for($gx = 50; $gx <= 850; $gx += 150)
                @for($gy = 50; $gy <= 550; $gy += 140)
                    <g class="sway-flower-a">
                        <circle cx="{{ $gx }}" cy="{{ $gy }}" r="65" fill="{{ $theme === 'playful' ? '#FFDCC2' : ($theme === 'elegant_night' ? '#1C2E47' : '#a81c37') }}"/>
                        <circle cx="{{ $gx }}" cy="{{ $gy }}" r="40" fill="{{ $theme === 'playful' ? '#F4623A' : ($theme === 'elegant_night' ? '#D4B98C' : '#e63956') }}"/>
                    </g>
                @endfor
            @endfor
        </svg>

        <div class="wall-loader-card" style="{{ $theme === 'playful' ? 'background: #FFF6E9; border: 3px solid #000; box-shadow: 6px 6px 0px #000; color: #000;' : ($theme === 'elegant_night' ? 'background: #1C2E47; border: 2px solid #D4B98C; color: #EDE3D0;' : 'background: rgba(27,12,17,0.88); border: 3px solid #000; color: #fff;') }}">
            <p class="text-xs font-black uppercase tracking-wider">
                Sebentar, kejutan sedang mekar... ✨
            </p>
            <div class="w-44 h-3.5 rounded-full bg-white border-2 border-black overflow-hidden p-0.5">
                <div class="h-full rounded-full transition-all duration-200" style="{{ $theme === 'playful' ? 'background: #F4623A;' : ($theme === 'elegant_night' ? 'background: #D4B98C;' : 'background: #e63956;') }}" :style="'width: ' + wall1Progress + '%'"></div>
            </div>
            <span class="text-xs font-mono font-black" x-text="wall1Progress + '%'"></span>
        </div>
    </div>

    <!-- TAHAP 3: COVER UNLOCK SCREEN (NEATLY STRUCTURED FLEX) -->
    <div class="intro-cover-screen" :class="{ 'fade-out': coverUnlocked }" x-show="wall1Finished && !coverUnlocked" @click="triggerCoverUnlock()" x-cloak
        style="{{ $theme === 'playful' ? 'background: radial-gradient(circle at 50% 40%, #FFF6E9 0%, #FFDCC2 100%); color: #000;' : ($theme === 'elegant_night' ? 'background: radial-gradient(circle at 50% 40%, #1C2E47 0%, #0F1B2D 100%); color: #EDE3D0;' : 'background: radial-gradient(circle at 50% 40%, #3a1a22 0%, #2b1419 60%, #1a0a0e 100%); color: #fff8ea;') }}">

        <div></div>

        <!-- CONCEPT 1: ROMANTIC CLASSIC FLORAL HEART ARCH -->
        @if($theme === 'romantic_classic')
            <div class="floral-heart-outline-container">
                <svg class="floral-heart-outline-svg" viewBox="0 0 400 360" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g class="individual-flowers">
                        <g class="sway-flower-a"><circle cx="200" cy="80" r="18" fill="#e63956" stroke="#800f2f" stroke-width="2"/><circle cx="200" cy="80" r="8" fill="#fff8ea"/></g>
                        <g class="sway-flower-b"><circle cx="170" cy="55" r="16" fill="#fff8ea" stroke="#d9c5a3" stroke-width="2"/><circle cx="170" cy="55" r="7" fill="#800f2f"/></g>
                        <g class="sway-flower-a"><circle cx="230" cy="55" r="16" fill="#fff8ea" stroke="#d9c5a3" stroke-width="2"/><circle cx="230" cy="55" r="7" fill="#800f2f"/></g>
                        <g class="sway-flower-b"><circle cx="140" cy="30" r="22" fill="#e63956" stroke="#800f2f" stroke-width="2"/><circle cx="140" cy="30" r="10" fill="#ff758f"/></g>
                        <g class="sway-flower-a"><circle cx="260" cy="30" r="22" fill="#e63956" stroke="#800f2f" stroke-width="2"/><circle cx="260" cy="30" r="10" fill="#ff758f"/></g>
                        <g class="sway-flower-b"><circle cx="200" cy="335" r="23" fill="#e63956" stroke="#800f2f" stroke-width="2"/><circle cx="200" cy="335" r="10" fill="#fff8ea"/></g>
                    </g>
                </svg>

                <div class="floral-heart-text">
                    <div class="recipient-title">untuk {{ $page->recipient_name }}</div>
                    <div class="sender-subtitle">DARI ORANG TERSAYANG ❤️</div>
                </div>
            </div>

        <!-- CONCEPT 2: PLAYFUL CERIA BOUNCING GIFT COVER -->
        @elseif($theme === 'playful')
            <div class="flex flex-col items-center justify-center space-y-5 max-w-sm text-center px-6">
                <div class="w-24 h-24 rounded-3xl bg-[#F4623A] text-white flex items-center justify-center border-3 border-black shadow-[6px_6px_0px_#000] playful-bouncing-core">
                    <i data-lucide="gift" class="w-12 h-12"></i>
                </div>

                <h1 class="font-black text-2xl text-[#F4623A] leading-tight" style="font-family: var(--font-display-playful);">
                    Kejutan Manis Untuk<br><span class="text-black">{{ $page->recipient_name }}! 🎉</span>
                </h1>

                <p class="text-xs font-bold text-black/80">
                    Sebuah kado digital ceria penuh warna yang dibuat khusus untuk merayakan harimu!
                </p>
            </div>

        <!-- CONCEPT 3: ELEGAN MALAM MIDNIGHT GOLD COVER -->
        @else
            <div class="flex flex-col items-center justify-center space-y-5 max-w-sm text-center px-6">
                <div class="w-24 h-24 rounded-3xl bg-[#1C2E47] text-[#D4B98C] flex items-center justify-center border-2 border-[#D4B98C] shadow-[0_0_25px_rgba(212,185,140,0.4)] elegant-gold-diamond">
                    <i data-lucide="sparkles" class="w-12 h-12"></i>
                </div>

                <h1 class="font-medium text-2xl text-[#D4B98C]" style="font-family: var(--font-display-elegant);">
                    Spesial Untuk {{ $page->recipient_name }}
                </h1>

                <p class="text-xs font-mono tracking-widest text-[#EDE3D0]/80 uppercase">
                    EKSKLUSIF &amp; ANGGUN
                </p>
            </div>
        @endif

        <div class="tap-prompt-badge" style="{{ $theme === 'playful' ? 'background: #F2B705; color: #000; border: 2px solid #000;' : ($theme === 'elegant_night' ? 'background: #D4B98C; color: #000;' : 'background: #F4623A; color: #fff;') }}">
            <span>Ketuk / Tap Layar Untuk Membuka Kado</span>
        </div>
    </div>

    <!-- TAHAP 4: FULL WALL TRANSITION 2 -->
    <div class="full-wall-screen" :class="{ 'fade-out': wall2Finished }" x-show="wall2Active && !wall2Finished" x-cloak
        style="{{ $theme === 'playful' ? 'background: #FFF6E9;' : ($theme === 'elegant_night' ? 'background: #0F1B2D;' : 'background: #2b1419;') }}">
        <svg class="flower-wall-pattern" viewBox="0 0 800 500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <rect width="800" height="500" fill="{{ $theme === 'playful' ? '#FFF6E9' : ($theme === 'elegant_night' ? '#0F1B2D' : '#2b1419') }}"/>
            @for($gx = 50; $gx <= 850; $gx += 150)
                @for($gy = 50; $gy <= 550; $gy += 140)
                    <g class="sway-flower-a">
                        <circle cx="{{ $gx }}" cy="{{ $gy }}" r="65" fill="{{ $theme === 'playful' ? '#FFDCC2' : ($theme === 'elegant_night' ? '#1C2E47' : '#a81c37') }}"/>
                        <circle cx="{{ $gx }}" cy="{{ $gy }}" r="40" fill="{{ $theme === 'playful' ? '#F4623A' : ($theme === 'elegant_night' ? '#D4B98C' : '#e63956') }}"/>
                    </g>
                @endfor
            @endfor
        </svg>

        <div class="wall-loader-card" style="{{ $theme === 'playful' ? 'background: #FFF6E9; border: 3px solid #000; box-shadow: 6px 6px 0px #000; color: #000;' : ($theme === 'elegant_night' ? 'background: #1C2E47; border: 2px solid #D4B98C; color: #EDE3D0;' : 'background: rgba(27,12,17,0.88); border: 3px solid #000; color: #fff;') }}">
            <p class="text-xs font-black uppercase tracking-wider">
                Membuka Dunia Kado Spesial... ✨
            </p>
            <div class="w-44 h-3.5 rounded-full bg-white border-2 border-black overflow-hidden p-0.5">
                <div class="h-full rounded-full transition-all duration-200" style="{{ $theme === 'playful' ? 'background: #F4623A;' : ($theme === 'elegant_night' ? 'background: #D4B98C;' : 'background: #e63956;') }}" :style="'width: ' + wall2Progress + '%'"></div>
            </div>
            <span class="text-xs font-mono font-black" x-text="wall2Progress + '%'"></span>
        </div>
    </div>

    <!-- TAHAP 5: MAIN WORLD SCREEN (NEAT & ALIGNED CENTERING) -->
    <div class="main-world-screen" x-show="wall2Finished" x-cloak
        style="{{ $theme === 'playful' ? 'background: radial-gradient(circle at 50% 40%, #FFF6E9 0%, #FFDCC2 60%, #F2B705 100%);' : ($theme === 'elegant_night' ? 'background: radial-gradient(ellipse at 50% 30%, #1C2E47 0%, #0F1B2D 70%, #080F1a 100%);' : 'background: radial-gradient(ellipse at 50% 30%, #3d1b28 0%, #1e0b16 50%, #0c0409 100%);') }}">

        <!-- Background Starlight -->
        @for($s = 0; $s < 50; $s++)
            <span class="galaxy-star" style="left:{{ rand(2,98) }}%;top:{{ rand(2,98) }}%;width:{{ rand(2,3) }}px;height:{{ rand(2,3) }}px;animation-delay:{{ rand(0,40)/10 }}s"></span>
        @endfor

        <!-- Header Info Box -->
        <div class="orbit-header-container">
            <div class="mono-header" style="{{ $theme === 'playful' ? 'color: #3A2A1E;' : ($theme === 'elegant_night' ? 'color: #D4B98C;' : 'color: #d9c5a3;') }}">
                KHUSUS UNTUK {{ strtoupper($page->recipient_name) }}
            </div>
            <h1 style="{{ $theme === 'playful' ? 'font-family: var(--font-display-playful); color: #F4623A;' : ($theme === 'elegant_night' ? 'font-family: var(--font-display-elegant); color: #D4B98C;' : 'font-family: var(--font-display-romantic); color: #fff8ea;') }}">
                Dunia kecil kita
            </h1>
        </div>

        <!-- Center Glowing Aura -->
        <div class="crystal-glow-halo"></div>

        <!-- Elliptical Ring Orbit Path Line -->
        <div class="orbit-ellipse-ring" style="{{ $theme === 'playful' ? 'border: 2px dashed rgba(0,0,0,0.3);' : ($theme === 'elegant_night' ? 'border: 1.5px stroke rgba(212,185,140,0.4);' : 'border: 1.5px stroke rgba(255,248,234,0.35);') }}"></div>

        <!-- SVG Constellation Lines -->
        <svg class="constellation-svg">
            <template x-for="(pos, idx) in tokenPositions" :key="idx">
                <line class="constellation-line" :x1="centerPos.x" :y1="centerPos.y" :x2="pos.x" :y2="pos.y" stroke="{{ $theme === 'playful' ? 'rgba(0,0,0,0.25)' : ($theme === 'elegant_night' ? 'rgba(212,185,140,0.4)' : 'rgba(232,201,178,0.35)') }}" />
            </template>
        </svg>

        <!-- PRECISELY ALIGNED CENTER CORE -->
        <div class="crystal-heart-wrapper">
            @if($theme === 'playful')
                <div class="w-32 h-32 rounded-full bg-[#F2B705] border-3 border-black shadow-[6px_6px_0px_#000] flex items-center justify-center playful-bouncing-core text-black">
                    <i data-lucide="star" class="w-14 h-14 stroke-[2.5]"></i>
                </div>
            @elseif($theme === 'elegant_night')
                <div class="w-32 h-32 rounded-3xl bg-[#1C2E47] border-2 border-[#D4B98C] shadow-[0_0_30px_rgba(212,185,140,0.5)] flex items-center justify-center elegant-gold-diamond text-[#D4B98C]">
                    <i data-lucide="gem" class="w-14 h-14"></i>
                </div>
            @else
                <svg class="crystal-heart-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <radialGradient id="crystalGrad" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#fff8ea" stop-opacity="0.95"/>
                            <stop offset="35%" stop-color="#f8d7da" stop-opacity="0.85"/>
                            <stop offset="70%" stop-color="#e699a6" stop-opacity="0.6"/>
                            <stop offset="100%" stop-color="#b85b6c" stop-opacity="0.2"/>
                        </radialGradient>
                    </defs>
                    <path d="M100 175 C50 130, 10 100, 10 70 C10 40, 36 20, 60 20 C76 20, 90 30, 100 44 C110 30, 124 20, 140 20 C164 20, 190 40, 190 70 C190 100, 150 130, 100 175Z" fill="url(#crystalGrad)" stroke="rgba(255,248,234,0.6)" stroke-width="2"/>
                    <circle cx="100" cy="90" r="14" fill="#fff8ea" filter="drop-shadow(0 0 10px #ffb3c1)"/>
                    <circle cx="100" cy="90" r="6" fill="#f4623a"/>
                </svg>
            @endif
        </div>

        <!-- ROTATING ORBITAL TOKENS -->
        <template x-for="(token, index) in tokens" :key="index">
            <button class="token" @click="openModal(token)" :style="getTokenDynamicStyle(index)">
                <div class="token-thumb-frame" style="{{ $theme === 'playful' ? 'border: 2px solid #000; box-shadow: 3px 3px 0px #000; background: #fff;' : ($theme === 'elegant_night' ? 'border: 1.5px solid #D4B98C; background: #1C2E47;' : 'border: 1.5px solid rgba(255,248,234,0.85); background: rgba(42,24,34,0.9);') }}">
                    <template x-if="token.type === 'photo'">
                        <img :src="token.url" alt="Foto">
                    </template>
                    <template x-if="token.type === 'letter'">
                        <div class="w-full h-full flex items-center justify-center" style="{{ $theme === 'playful' ? 'background: #FFDCC2; color: #000;' : ($theme === 'elegant_night' ? 'background: #1C2E47; color: #D4B98C;' : 'background: #f6ecda; color: #4a2a30;') }}">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                    </template>
                    <template x-if="token.type === 'spotify'">
                        <div class="w-full h-full flex items-center justify-center" style="{{ $theme === 'playful' ? 'background: #F4623A; color: #fff;' : ($theme === 'elegant_night' ? 'background: #7A2E3D; color: #D4B98C;' : 'background: #f1a7b4; color: #1b0b16;') }}">
                            <i data-lucide="music" class="w-6 h-6"></i>
                        </div>
                    </template>
                    <template x-if="token.type === 'youtube'">
                        <div class="w-full h-full flex items-center justify-center" style="{{ $theme === 'playful' ? 'background: #2E8B8B; color: #fff;' : ($theme === 'elegant_night' ? 'background: #0F1B2D; color: #EDE3D0;' : 'background: #3a1d28; color: #fff;') }}">
                            <i data-lucide="video" class="w-6 h-6"></i>
                        </div>
                    </template>
                    <template x-if="token.type === 'bouquet'">
                        <div class="w-full h-full p-2 flex items-center justify-center" style="{{ $theme === 'playful' ? 'background: #F2B705;' : ($theme === 'elegant_night' ? 'background: #1C2E47;' : 'background: #ffdcc2;') }}">
                            @if($theme === 'romantic_classic')
                                <img src="{{ asset('images/red-rose.svg') }}" class="w-full h-full object-contain">
                            @else
                                <i data-lucide="{{ $theme === 'playful' ? 'gift' : 'sparkles' }}" class="w-6 h-6"></i>
                            @endif
                        </div>
                    </template>
                </div>

                <div class="token-dark-pill" style="{{ $theme === 'playful' ? 'background: #F2B705; color: #000; border: 1.5px solid #000; box-shadow: 2px 2px 0px #000;' : ($theme === 'elegant_night' ? 'background: #1C2E47; color: #D4B98C; border: 1px solid #D4B98C;' : 'background: linear-gradient(180deg, rgba(42,24,34,0.88), rgba(20,10,16,0.95)); color: #fff8ea;') }}">
                    <template x-if="token.type === 'photo'"><i data-lucide="camera" class="w-3.5 h-3.5"></i></template>
                    <template x-if="token.type === 'letter'"><i data-lucide="mail" class="w-3.5 h-3.5"></i></template>
                    <template x-if="token.type === 'spotify'"><i data-lucide="music" class="w-3.5 h-3.5"></i></template>
                    <template x-if="token.type === 'youtube'"><i data-lucide="video" class="w-3.5 h-3.5"></i></template>
                    <template x-if="token.type === 'bouquet'">
                        @if($theme === 'romantic_classic')
                            <img src="{{ asset('images/red-rose.svg') }}" class="w-3.5 h-3.5 inline-block">
                        @else
                            <i data-lucide="{{ $theme === 'playful' ? 'gift' : 'sparkles' }}" class="w-3.5 h-3.5"></i>
                        @endif
                    </template>
                    <span x-text="token.title"></span>
                </div>
            </button>
        </template>

        <!-- Bottom Translucent Hint Pill -->
        <div class="orbit-bottom-hint">
            <div class="orbit-hint-pill-dark" style="{{ $theme === 'playful' ? 'background: #F4623A; color: #fff; border: 2px solid #000; box-shadow: 3px 3px 0px #000;' : ($theme === 'elegant_night' ? 'background: #1C2E47; color: #EDE3D0; border: 1px solid #D4B98C;' : 'background: rgba(20,10,16,0.85); color: #fff8ea;') }}">
                <span>{{ $page->recipient_name }} sayang, pencet tiap kenangan yang mengelilingi hati itu yaa</span>
            </div>
        </div>

    </div>

    <!-- MODAL OVERLAY SLIDE -->
    <div class="modal-overlay" :class="{ 'active': activeModal !== null }" @click.self="closeModal()">
        <div class="modal-card" x-show="activeModal !== null">
            <button class="modal-close-btn" @click="closeModal()">✕</button>

            <!-- PHOTO MODAL -->
            <template x-if="activeModal && activeModal.type === 'photo'">
                <div class="text-center space-y-4">
                    <div class="rounded-2xl overflow-hidden neo-border-sm aspect-4/3">
                        <img :src="activeModal.url" class="w-full h-full object-cover">
                    </div>
                    <span class="inline-block px-3 py-1 bg-[#F2B705] text-black text-xs font-black uppercase rounded-full neo-badge" x-text="activeModal.title"></span>
                    <p class="text-sm font-bold text-black/80" x-text="activeModal.caption"></p>
                </div>
            </template>

            <!-- LETTER MODAL -->
            <template x-if="activeModal && activeModal.type === 'letter'">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b-2 border-black pb-3">
                        <span class="text-xs font-black uppercase tracking-wider text-[#F4623A]">Surat Rahasia</span>
                        <span class="text-xs font-mono font-bold">Untuk: {{ $page->recipient_name }}</span>
                    </div>

                    <div class="font-serif italic text-base leading-relaxed whitespace-pre-line text-black p-4 bg-[#FFDCC2] rounded-2xl neo-border-sm">
                        "<span x-text="activeModal.content"></span>"
                    </div>

                    <div class="text-right">
                        <span class="font-display font-black text-sm text-[#F4623A]">Kutulis dengan tulus</span>
                    </div>
                </div>
            </template>

            <!-- SPOTIFY / MUSIC MODAL -->
            <template x-if="activeModal && activeModal.type === 'spotify'">
                <div class="text-center space-y-5">
                    <span class="inline-block px-3 py-1 bg-[#1DB954] text-black text-xs font-black uppercase rounded-full neo-badge">
                        Spotify Music Player
                    </span>

                    <div class="w-32 h-32 mx-auto rounded-full bg-black border-4 border-black neo-shadow flex items-center justify-center relative overflow-hidden"
                        :class="{ 'spinning-vinyl': isPlaying }">
                        <div class="w-10 h-10 rounded-full bg-[#F2B705] border-2 border-black"></div>
                    </div>

                    <div>
                        <h3 class="font-black text-xl text-black">Musik Latar Belakang</h3>
                        <p class="text-xs font-bold text-black/70 mt-1" x-text="isPlaying ? 'Sedang Memutar Musik...' : 'Tekan Tombol Untuk Memutar'"></p>
                    </div>

                    <button @click="toggleAudio()" class="w-full py-3.5 rounded-2xl bg-[#F4623A] text-white font-black text-sm neo-btn">
                        <span x-text="isPlaying ? 'Jeda Musik' : 'Putar Musik'"></span>
                    </button>
                </div>
            </template>

            <!-- YOUTUBE MODAL -->
            <template x-if="activeModal && activeModal.type === 'youtube'">
                <div class="space-y-4 text-center">
                    <span class="inline-block px-3 py-1 bg-[#FF0000] text-white text-xs font-black uppercase rounded-full neo-badge">
                        YouTube Video Kenangan
                    </span>

                    <div class="aspect-video rounded-2xl overflow-hidden neo-border-sm bg-black">
                        <iframe class="w-full h-full" :src="activeModal.embed" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                    <p class="text-xs font-bold text-black/80">Video kenangan spesial untuk melengkapi momen manismu.</p>
                </div>
            </template>

            <!-- BOUQUET FINALE MODAL -->
            <template x-if="activeModal && activeModal.type === 'bouquet'">
                <div class="text-center space-y-5">
                    <div class="w-28 h-28 bg-[#FFDCC2] rounded-3xl neo-card mx-auto p-4 flex items-center justify-center">
                        @if($theme === 'romantic_classic')
                            <img src="{{ asset('images/red-rose.svg') }}" class="w-full h-full object-contain">
                        @else
                            <i data-lucide="{{ $theme === 'playful' ? 'gift' : 'sparkles' }}" class="w-14 h-14 text-[#F4623A]"></i>
                        @endif
                    </div>

                    <span class="inline-block px-4 py-1 bg-[#F2B705] text-black text-xs font-black uppercase rounded-full neo-badge">
                        Hadiah Finale
                    </span>

                    <h3 class="font-display text-2xl font-black text-black">Semoga Kamu Suka Hadiah Ini!</h3>

                    <p class="text-xs font-bold text-black/80 leading-relaxed">
                        Kado digital ini khusus dibuat untuk merayakan cinta &amp; momen indah bersamamu.
                    </p>

                    <button @click="closeModal()" class="w-full py-3.5 rounded-2xl bg-[#F4623A] text-white font-black text-sm neo-btn">
                        Tutup &amp; Simpan Kenangan
                    </button>
                </div>
            </template>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('surpriseApp', () => ({
                puzzleTiles: [1, 2, 3, null],
                puzzleSolved: false,
                wall1Active: false,
                wall1Progress: 0,
                wall1Finished: false,
                coverUnlocked: false,
                wall2Active: false,
                wall2Progress: 0,
                wall2Finished: false,
                tokens: @json($tokens),
                activeModal: null,
                isPlaying: false,
                orbitAngle: 0,
                tokenPositions: [],
                centerPos: { x: 0, y: 0 },

                init() {
                    this.updateCenter();
                    window.addEventListener('resize', () => this.updateCenter());

                    this.$nextTick(() => {
                        if (window.lucide) {
                            lucide.createIcons();
                        }
                    });

                    const animateOrbit = () => {
                        this.orbitAngle += 0.003;
                        this.computePositions();
                        requestAnimationFrame(animateOrbit);
                    };
                    requestAnimationFrame(animateOrbit);
                },

                moveTile(index) {
                    const emptyIndex = this.puzzleTiles.indexOf(null);
                    const validMoves = [
                        emptyIndex - 1, emptyIndex + 1,
                        emptyIndex - 2, emptyIndex + 2
                    ];

                    if (validMoves.includes(index)) {
                        const temp = this.puzzleTiles[index];
                        this.puzzleTiles[index] = null;
                        this.puzzleTiles[emptyIndex] = temp;
                        this.puzzleTiles = [...this.puzzleTiles];

                        if (JSON.stringify(this.puzzleTiles) === JSON.stringify([1, 2, 3, null])) {
                            setTimeout(() => this.solvePuzzle(), 300);
                        }
                    }
                },

                getTileGraphicStyle(tile) {
                    const offsets = {
                        1: 'top:0;left:0',
                        2: 'top:0;right:0',
                        3: 'bottom:0;left:0',
                    };
                    return offsets[tile] || '';
                },

                solvePuzzle() {
                    this.puzzleSolved = true;
                    this.startWall1Transition();
                },

                startWall1Transition() {
                    this.wall1Active = true;
                    this.playAudio();

                    const interval = setInterval(() => {
                        this.wall1Progress += 10;
                        if (this.wall1Progress >= 100) {
                            clearInterval(interval);
                            setTimeout(() => {
                                this.wall1Finished = true;
                            }, 400);
                        }
                    }, 180);
                },

                triggerCoverUnlock() {
                    this.coverUnlocked = true;
                    this.startWall2Transition();
                },

                startWall2Transition() {
                    this.wall2Active = true;
                    const interval = setInterval(() => {
                        this.wall2Progress += 10;
                        if (this.wall2Progress >= 100) {
                            clearInterval(interval);
                            setTimeout(() => {
                                this.wall2Finished = true;
                                this.$nextTick(() => {
                                    if (window.lucide) lucide.createIcons();
                                });
                            }, 400);
                        }
                    }, 180);
                },

                updateCenter() {
                    this.centerPos = {
                        x: window.innerWidth / 2,
                        y: window.innerHeight * 0.46
                    };
                },

                computePositions() {
                    const cx = this.centerPos.x;
                    const cy = this.centerPos.y;
                    const rx = Math.min(window.innerWidth * 0.38, 250);
                    const ry = Math.min(window.innerHeight * 0.22, 135);
                    const total = this.tokens.length;

                    this.tokenPositions = this.tokens.map((_, idx) => {
                        const startAngle = -Math.PI / 2;
                        const angle = startAngle + this.orbitAngle + (2 * Math.PI * idx) / total;
                        const x = cx + rx * Math.cos(angle);
                        const y = cy + ry * Math.sin(angle);
                        return { x, y };
                    });
                },

                getTokenDynamicStyle(idx) {
                    if (!this.tokenPositions[idx]) return '';
                    const pos = this.tokenPositions[idx];
                    const x = pos.x - 34;
                    const y = pos.y - 42;
                    return `left:${x}px;top:${y}px`;
                },

                openModal(token) {
                    this.activeModal = token;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },

                closeModal() {
                    this.activeModal = null;
                },

                playAudio() {
                    const audio = document.getElementById('bg-audio');
                    if (audio) {
                        audio.play().then(() => { this.isPlaying = true; }).catch(() => { this.isPlaying = false; });
                    }
                },

                toggleAudio() {
                    const audio = document.getElementById('bg-audio');
                    if (!audio) return;
                    if (this.isPlaying) {
                        audio.pause();
                        this.isPlaying = false;
                    } else {
                        audio.play();
                        this.isPlaying = true;
                    }
                }
            }));
        });
    </script>
</body>
</html>
