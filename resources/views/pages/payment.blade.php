<!-- // DUMMY PAYMENT — replace with real Midtrans/Xendit integration before production -->
<x-layouts.app title="Simulasi Pembayaran — Surprise">
    <div class="min-h-screen bg-[#FFF6E9] text-black py-10 px-4 sm:px-6">
        <div class="max-w-2xl mx-auto">

            <!-- Simulated Gateway Header Neo-Brutalist -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 neo-card mb-6">
                <div class="flex items-center justify-between border-b-2 border-black pb-6 mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-[#F4623A] text-white flex items-center justify-center font-black text-2xl neo-border-sm">
                            S
                        </div>
                        <div>
                            <div class="font-black text-black text-base">Surprise Payment Simulator</div>
                            <div class="text-xs font-bold text-black/60">Kode Reff: {{ $order->dummy_reference_code }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-black uppercase text-black/60">Total Tagihan</div>
                        <div class="text-2xl sm:text-3xl font-black text-[#6B1F2A]">
                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Order Details Card Neo-Brutalist -->
                <div class="bg-[#FFDCC2] rounded-2xl p-4 mb-6 text-xs font-bold space-y-2 neo-border-sm">
                    <div class="flex justify-between">
                        <span class="opacity-75">Penerima Surprise:</span>
                        <span class="font-black text-black">{{ $page->recipient_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="opacity-75">Judul Pesan:</span>
                        <span class="font-black text-black">{{ $page->title }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="opacity-75">Paket Terpilih:</span>
                        <span class="font-black uppercase bg-black text-white px-2 py-0.5 rounded text-[10px]">{{ $order->package }}</span>
                    </div>
                </div>

                <!-- Expiry Notification Neo-Brutalist -->
                <div class="bg-[#F2B705] rounded-xl p-3 text-black text-xs font-black flex items-center justify-between mb-8 neo-border-sm">
                    <span>⏱ Waktu pembayaran tersisa:</span>
                    <span class="font-mono font-black text-sm bg-white px-2 py-1 rounded neo-border-sm">14:59</span>
                </div>

                <!-- Payment Method Tabs Neo-Brutalist -->
                <div x-data="{ tab: 'qris' }">
                    <div class="flex rounded-xl bg-gray-100 p-1.5 mb-6 text-xs font-black neo-border-sm">
                        <button @click="tab = 'qris'" :class="tab === 'qris' ? 'bg-[#F4623A] text-white neo-border-sm' : 'text-black'" class="flex-1 py-2.5 rounded-lg transition-all">
                            QRIS / E-Wallet
                        </button>
                        <button @click="tab = 'va'" :class="tab === 'va' ? 'bg-[#F4623A] text-white neo-border-sm' : 'text-black'" class="flex-1 py-2.5 rounded-lg transition-all">
                            Virtual Account (Bank)
                        </button>
                    </div>

                    <!-- Tab QRIS -->
                    <div x-show="tab === 'qris'" class="text-center py-4 space-y-4">
                        <p class="text-xs font-bold text-black/80">Scan QRIS menggunakan GoPay, OVO, DANA, ShopeePay, atau Mobile Banking:</p>
                        
                        <div class="w-52 h-52 mx-auto bg-white p-3 rounded-2xl neo-card flex flex-col items-center justify-center">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(170)->generate('DUMMY-PAYMENT-' . $order->id) !!}
                        </div>

                        <p class="text-[11px] font-black uppercase text-black/60">QR Code Simulasi Prototype</p>
                    </div>

                    <!-- Tab VA -->
                    <div x-show="tab === 'va'" class="space-y-4 py-4" x-cloak>
                        <p class="text-xs font-bold text-black/80">Transfer ke Nomor Virtual Account di bawah ini:</p>
                        
                        <div class="p-4 rounded-2xl bg-white text-black neo-card flex items-center justify-between">
                            <div>
                                <div class="text-[10px] uppercase font-black opacity-60">BCA Virtual Account</div>
                                <div class="font-mono font-black text-lg text-black tracking-wider">8801 9283 1029 3847</div>
                            </div>
                            <button onclick="navigator.clipboard.writeText('8801928310293847'); alert('Nomor VA berhasil disalin!');"
                                class="px-4 py-2 rounded-xl bg-[#F2B705] text-black text-xs font-black neo-btn">
                                Salin
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Simulation Trigger Buttons Neo-Brutalist -->
                <div class="mt-8 pt-6 border-t-2 border-black space-y-3">
                    <div class="text-xs font-black text-black text-center uppercase tracking-wider mb-2">
                        ⚡️ SIMULASI AKSI PEMBAYARAN (PROTOTYPE ONLY)
                    </div>

                    <form action="{{ route('payment.simulate', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="result" value="success">
                        <button type="submit"
                            class="w-full py-4 rounded-2xl bg-emerald-500 text-white font-black text-sm neo-btn flex items-center justify-center space-x-2">
                            <span>✅ SIMULASIKAN PEMBAYARAN BERHASIL</span>
                        </button>
                    </form>

                    <form action="{{ route('payment.simulate', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="result" value="failed">
                        <button type="submit"
                            class="w-full py-3 rounded-2xl bg-red-500 text-white font-black text-xs neo-btn">
                            ❌ SIMULASIKAN PEMBAYARAN GAGAL
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</x-layouts.app>
