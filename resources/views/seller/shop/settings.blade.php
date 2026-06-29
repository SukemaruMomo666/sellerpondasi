@extends('layouts.seller')

@section('title', 'Pengaturan Toko Lanjutan')

@push('styles')
<style>
    .tab-content { display: none; opacity: 0; transform: translateY(10px); transition: all 0.3s ease-out; }
    .tab-content.active { display: block; opacity: 1; transform: translateY(0); }
    
    /* Animasi Toggle ala iOS */
    .ios-toggle:checked + div { background-color: #2563eb; }
    .ios-toggle:checked + div:after { transform: translateX(100%); border-color: white; }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-slate-50/50 p-4 md:p-6 lg:p-8 font-sans text-slate-900 pb-32">

    {{-- SETUP SWEETALERT TOAST --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000,
            customClass: { popup: 'rounded-2xl shadow-lg border border-slate-100' }
        });
        
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                Toast.fire({icon: 'success', title: '{{ session('success') }}'});
            @endif
            @if(session('error'))
                Swal.fire({title: 'Gagal!', text: '{{ session('error') }}', icon: 'error', customClass: { popup: 'rounded-3xl' }});
            @endif
        });
    </script>

    {{-- HEADER --}}
    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm flex-shrink-0">
            <i class="mdi mdi-cog-outline text-2xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Pengaturan Toko</h1>
            <p class="text-sm font-medium text-slate-500 mt-0.5">Kelola operasional, privasi, notifikasi, dan keamanan akun Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- NAVIGASI TAB VERTIKAL (KIRI) --}}
        <div class="lg:col-span-3">
            <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-3 shadow-sm sticky top-24">
                <nav class="flex flex-col gap-1">
                    <button type="button" onclick="switchTab('general')" id="btn-general" class="tab-btn flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-blue-700 bg-blue-50 transition-colors text-left">
                        <i class="mdi mdi-store-cog text-lg"></i> Operasional Toko
                    </button>
                    <button type="button" onclick="switchTab('privasi')" id="btn-privasi" class="tab-btn flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors text-left">
                        <i class="mdi mdi-eye-off-outline text-lg"></i> Privasi & Kebijakan
                    </button>
                    <button type="button" onclick="switchTab('notification')" id="btn-notification" class="tab-btn flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors text-left">
                        <i class="mdi mdi-bell-outline text-lg"></i> Notifikasi
                    </button>
                    <a href="{{ route('seller.shop.security') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors text-left">
                        <i class="mdi mdi-shield-lock-outline text-lg"></i> Keamanan Akun
                    </a>
                </nav>
            </div>
        </div>

        {{-- AREA KONTEN (KANAN) --}}
        <div class="lg:col-span-9">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-3xl mb-6 shadow-sm flex items-start gap-3">
                    <i class="mdi mdi-alert-circle text-xl mt-0.5"></i>
                    <div>
                        <h5 class="font-bold text-sm mb-1">Gagal Menyimpan!</h5>
                        <ul class="list-disc list-inside text-xs font-medium space-y-0.5">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('seller.shop.settings.update') }}" method="POST" id="formGeneral">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_type" value="general">

                {{-- KONTEN TAB: OPERASIONAL TOKO --}}
                <div id="tab-general" class="tab-content active space-y-6">
                    
                    {{-- Mode Libur Pintar --}}
                    <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm transition-all hover:shadow-md">
                        <div class="flex justify-between items-start gap-4 mb-6">
                            <div>
                                <h3 class="text-base font-black text-slate-900 mb-1 flex items-center gap-2">
                                    <i class="mdi mdi-beach text-amber-500 text-xl"></i> Mode Libur Cerdas
                                </h3>
                                <p class="text-sm font-medium text-slate-500 leading-relaxed max-w-xl">
                                    Toko akan disembunyikan sementara. Anda dapat menjadwalkan kapan libur dimulai dan berakhir.
                                </p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-1">
                                <input type="checkbox" name="status_libur" id="status_libur_toggle" class="sr-only peer ios-toggle" {{ ($toko->status_libur ?? 0) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                            </label>
                        </div>

                        <div id="jadwal_libur_container" class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-slate-100 {{ ($toko->status_libur ?? 0) ? '' : 'hidden' }}">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Mulai Libur</label>
                                <input type="date" name="libur_mulai" value="{{ $jadwal_libur['mulai'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-amber-500 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Selesai Libur</label>
                                <input type="date" name="libur_selesai" value="{{ $jadwal_libur['selesai'] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium rounded-xl px-4 py-2.5 focus:bg-white focus:ring-2 focus:ring-amber-500 outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    {{-- Jam Operasional Harian --}}
                    <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm transition-all hover:shadow-md">
                        <h3 class="text-base font-black text-slate-900 mb-1 flex items-center gap-2">
                            <i class="mdi mdi-clock-outline text-emerald-500 text-xl"></i> Jam Operasional Toko
                        </h3>
                        <p class="text-sm font-medium text-slate-500 mb-6">Atur jam buka dan tutup harian. Di luar jam ini, pesan otomatis akan terkirim.</p>
                        
                        <div class="space-y-3">
                            @foreach(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'] as $hari)
                                @php $jam = $jam_operasional[$hari] ?? ['buka' => '08:00', 'tutup' => '17:00', 'aktif' => true]; @endphp
                                <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                                    <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                        <input type="checkbox" name="aktif_{{ $hari }}" class="sr-only peer ios-toggle" {{ $jam['aktif'] ? 'checked' : '' }}>
                                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all"></div>
                                    </label>
                                    <div class="w-20 font-bold text-sm text-slate-700 capitalize">{{ $hari }}</div>
                                    <div class="flex-1 flex items-center gap-2">
                                        <input type="time" name="jam_{{ $hari }}_buka" value="{{ $jam['buka'] }}" class="w-full max-w-[120px] bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium rounded-lg px-3 py-1.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                        <span class="text-slate-400 font-bold">-</span>
                                        <input type="time" name="jam_{{ $hari }}_tutup" value="{{ $jam['tutup'] }}" class="w-full max-w-[120px] bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium rounded-lg px-3 py-1.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Balasan Chat --}}
                    <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm transition-all hover:shadow-md">
                        <h3 class="text-base font-black text-slate-900 mb-1 flex items-center gap-2">
                            <i class="mdi mdi-robot-outline text-indigo-500 text-xl"></i> Balasan Chat Cerdas
                        </h3>
                        <p class="text-sm font-medium text-slate-500 mb-4">Pesan ini akan otomatis terkirim. Gunakan <code class="bg-indigo-50 text-indigo-600 px-1.5 py-0.5 rounded text-xs font-bold">[Nama Pembeli]</code> untuk memanggil nama pembeli secara dinamis.</p>
                        <textarea name="pesan_otomatis" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-indigo-600 outline-none transition-all min-h-[120px] resize-none" placeholder="Cth: Halo [Nama Pembeli]! Selamat datang di toko kami...">{{ $toko->pesan_otomatis ?? '' }}</textarea>
                    </div>
                </div>

                {{-- KONTEN TAB: PRIVASI --}}
                <div id="tab-privasi" class="tab-content space-y-6">
                    <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm transition-all hover:shadow-md">
                        <h3 class="text-base font-black text-slate-900 mb-6 pb-4 border-b border-slate-100 flex items-center gap-2">
                            <i class="mdi mdi-eye-off-outline text-slate-500 text-xl"></i> Pengaturan Privasi & Tampilan
                        </h3>

                        <div class="space-y-6">
                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <h6 class="text-sm font-bold text-slate-800">Sembunyikan Produk Habis</h6>
                                    <p class="text-xs font-medium text-slate-500">Otomatis menyembunyikan produk dari etalase jika stok 0.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="privasi_sembunyikan_habis" class="sr-only peer ios-toggle" {{ ($privasi['sembunyikan_habis'] ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <h6 class="text-sm font-bold text-slate-800">Sembunyikan Status "Terakhir Aktif"</h6>
                                    <p class="text-xs font-medium text-slate-500">Pembeli tidak akan bisa melihat kapan terakhir kali Anda online.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="privasi_sembunyikan_last_active" class="sr-only peer ios-toggle" {{ ($privasi['sembunyikan_last_active'] ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KONTEN TAB: NOTIFIKASI --}}
                <div id="tab-notification" class="tab-content space-y-6">
                    <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm transition-all hover:shadow-md">
                        <h3 class="text-base font-black text-slate-900 mb-6 pb-4 border-b border-slate-100 flex items-center gap-2">
                            <i class="mdi mdi-bell-ring-outline text-blue-500 text-xl"></i> Preferensi Pemberitahuan
                        </h3>

                        <div class="space-y-6">
                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <h6 class="text-sm font-bold text-slate-800">Email Pesanan Baru</h6>
                                    <p class="text-xs font-medium text-slate-500">Kirim pemberitahuan email segera setelah ada pesanan masuk.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="notif_email_pesanan" class="sr-only peer ios-toggle" {{ ($notif['email_pesanan'] ?? true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <h6 class="text-sm font-bold text-slate-800">Notifikasi Pop-up Chat</h6>
                                    <p class="text-xs font-medium text-slate-500">Munculkan pop-up saat pembeli mengirimkan chat baru.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="notif_push_chat" class="sr-only peer ios-toggle" {{ ($notif['push_chat'] ?? true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            
                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <h6 class="text-sm font-bold text-slate-800">Peringatan Sistem & Keamanan</h6>
                                    <p class="text-xs font-medium text-slate-500">Peringatan penting saat login perangkat baru atau perubahan kata sandi.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="notif_system_alert" class="sr-only peer ios-toggle" {{ ($notif['system_alert'] ?? true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <h6 class="text-sm font-bold text-slate-800">Email Info & Promo Platform</h6>
                                    <p class="text-xs font-medium text-slate-500">Terima pembaruan berkala dari Pondasikita.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="notif_email_promo" class="sr-only peer ios-toggle" {{ ($notif['email_promo'] ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STICKY ACTION BAR --}}
                <div id="sticky-action-bar" class="fixed bottom-0 left-0 lg:left-[260px] right-0 bg-white/80 backdrop-blur-md border-t border-slate-200 px-6 py-4 flex items-center justify-between z-40 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)] transition-all">
                    <div class="hidden sm:block">
                        <p class="text-xs font-bold text-slate-500 m-0"><i class="mdi mdi-check-decagram text-blue-500"></i> Sistem menyimpan data secara terenkripsi.</p>
                    </div>
                    <div class="flex gap-3 w-full sm:w-auto">
                        <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md shadow-blue-600/30 transition-all btn-save-loader hover:-translate-y-0.5">
                            <i class="mdi mdi-content-save"></i> Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Tab switching logic
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.className = 'tab-btn flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors text-left';
        });

        document.getElementById('tab-' + tabId).classList.add('active');
        const activeBtn = document.getElementById('btn-' + tabId);
        activeBtn.className = 'tab-btn flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-blue-700 bg-blue-50 transition-colors text-left shadow-sm';

        localStorage.setItem('activeSettingsTab', tabId);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedTab = localStorage.getItem('activeSettingsTab');
        if (savedTab && document.getElementById('tab-' + savedTab)) {
            switchTab(savedTab);
        }
        
        // Logika Toggle Mode Libur
        const liburToggle = document.getElementById('status_libur_toggle');
        const liburContainer = document.getElementById('jadwal_libur_container');
        if(liburToggle && liburContainer) {
            liburToggle.addEventListener('change', function() {
                if(this.checked) {
                    liburContainer.classList.remove('hidden');
                } else {
                    liburContainer.classList.add('hidden');
                }
            });
        }
    });

    // Loading State
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const btn = this.querySelector('.btn-save-loader');
            if(btn) {
                btn.innerHTML = '<i class="mdi mdi-loading mdi-spin text-lg leading-none"></i> Menyimpan...';
                btn.disabled = true;
                btn.classList.add('opacity-70', 'cursor-not-allowed');
            }
        });
    });
</script>
@endpush
