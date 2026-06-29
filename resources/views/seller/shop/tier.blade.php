@extends('layouts.seller')

@section('title', 'Kenaikan Level Toko')

@push('styles')
<style>
    /* Transisi Premium */
    .glass-panel {
        @apply bg-white/90 backdrop-blur-xl border border-slate-200 shadow-sm;
    }
    
    .card-hover-effect {
        transition: all 0.3s ease;
    }
    .card-hover-effect:hover {
        transform: translateY(-4px);
        @apply border-slate-300 shadow-lg;
    }

    .progress-bar-animated {
        background-size: 200% 200%;
        animation: gradientMove 3s ease infinite;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto pb-12 space-y-8">
    {{-- ========================================== --}}
    {{-- HEADER SECTION                             --}}
    {{-- ========================================== --}}
    <div class="glass-panel rounded-3xl p-8 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-[80px] -mr-20 -mt-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-[60px] -ml-20 -mb-20 pointer-events-none"></div>

        <div class="relative z-10 flex items-center gap-5">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 shadow-sm">
                <i class="mdi mdi-rocket-launch text-3xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight mb-1">Level Kemitraan Toko</h1>
                <p class="text-sm font-medium text-slate-500 max-w-xl">Tingkatkan kredibilitas, reputasi, dan jangkauan pasar Anda dengan menaikkan kasta (Tier) toko untuk membuka fitur eksklusif.</p>
            </div>
        </div>
        
        <div class="relative z-10 bg-slate-50 border border-slate-200 px-6 py-4 rounded-2xl flex items-center gap-4">
            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.6)]"></div>
            <div>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Program Eksklusif</div>
                <div class="text-sm font-bold text-slate-800">Tumbuh Bersama Pondasikita</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- ========================================== --}}
        {{-- KOLOM KIRI: STATUS TOKO SAAT INI             --}}
        {{-- ========================================== --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Card: Current Tier --}}
            <div class="glass-panel rounded-[2rem] p-8 relative overflow-hidden group">
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <h2 class="text-xs font-black text-slate-500 uppercase tracking-widest">Kasta Saat Ini</h2>
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400"><i class="mdi mdi-information-outline"></i></div>
                </div>
                
                <div class="text-center pb-6 relative z-10">
                    @if($toko->tier_toko == 'official_store')
                        <div class="inline-flex items-center justify-center w-28 h-28 rounded-3xl bg-purple-50 border border-purple-200 text-purple-600 mb-6 shadow-sm transform transition-transform group-hover:-translate-y-1 duration-500">
                            <i class="mdi mdi-check-decagram text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600 uppercase tracking-widest mb-3">Official Store</h3>
                        <div class="inline-block px-4 py-1.5 bg-purple-100 text-purple-700 text-[10px] font-black uppercase tracking-widest rounded-full border border-purple-200">Level Maksimal</div>
                    
                    @elseif($toko->tier_toko == 'power_merchant')
                        <div class="inline-flex items-center justify-center w-28 h-28 rounded-3xl bg-emerald-50 border border-emerald-200 text-emerald-600 mb-6 shadow-sm transform transition-transform group-hover:-translate-y-1 duration-500">
                            <i class="mdi mdi-lightning-bolt text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 uppercase tracking-widest mb-3">Power Merchant</h3>
                        <div class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-200">Mitra Prioritas</div>
                    
                    @else
                        <div class="inline-flex items-center justify-center w-28 h-28 rounded-3xl bg-slate-100 border border-slate-200 text-slate-500 mb-6 shadow-sm transform transition-transform group-hover:-translate-y-1 duration-500">
                            <i class="mdi mdi-storefront-outline text-6xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 uppercase tracking-widest mb-3">Regular Merchant</h3>
                        <div class="inline-block px-4 py-1.5 bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-slate-200">Toko Standar</div>
                    @endif
                </div>

                <div class="space-y-3 relative z-10 border-t border-slate-200 pt-6">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center"><i class="mdi mdi-star text-xl"></i></div>
                            <span class="text-sm font-bold text-slate-700">Rating Toko</span>
                        </div>
                        <span class="text-lg font-black text-slate-900">{{ number_format($rating, 1) }} <span class="text-xs font-medium text-slate-400">/ 5.0</span></span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center"><i class="mdi mdi-shopping text-xl"></i></div>
                            <span class="text-sm font-bold text-slate-700">Total Pesanan</span>
                        </div>
                        <span class="text-lg font-black text-slate-900">{{ number_format($totalPesanan) }} <span class="text-xs font-medium text-slate-400">Trx</span></span>
                    </div>
                </div>
            </div>

            {{-- Card: Status Pengajuan Terakhir --}}
            @if($pengajuan)
                <div class="glass-panel rounded-[2rem] p-6 relative overflow-hidden border-l-4 
                    {{ $pengajuan->status == 'pending' ? 'border-l-amber-500' : ($pengajuan->status == 'revision' ? 'border-l-blue-500' : 'border-l-rose-500') }}">
                    
                    <h2 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-5">Pengajuan Terakhir</h2>
                    
                    <div class="flex items-start gap-4 mb-4">
                        @if($pengajuan->status == 'pending')
                            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 border border-amber-200 flex items-center justify-center text-2xl shrink-0"><i class="mdi mdi-clock-outline"></i></div>
                            <div>
                                <div class="text-base font-black text-slate-900 mb-0.5">Sedang Ditinjau</div>
                                <div class="text-xs font-medium text-amber-600 mb-1">Dalam Antrean Verifikasi</div>
                                <div class="text-[10px] font-bold text-slate-400">{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y, H:i') }}</div>
                            </div>
                        @elseif($pengajuan->status == 'revision')
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 border border-blue-200 flex items-center justify-center text-2xl shrink-0"><i class="mdi mdi-file-document-edit-outline"></i></div>
                            <div>
                                <div class="text-base font-black text-slate-900 mb-0.5">Butuh Revisi</div>
                                <div class="text-xs font-medium text-blue-600 mb-1">Tindakan Diperlukan</div>
                                <div class="text-[10px] font-bold text-slate-400">{{ \Carbon\Carbon::parse($pengajuan->updated_at)->format('d M Y, H:i') }}</div>
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 border border-rose-200 flex items-center justify-center text-2xl shrink-0"><i class="mdi mdi-close-circle-outline"></i></div>
                            <div>
                                <div class="text-base font-black text-slate-900 mb-0.5">Pengajuan Ditolak</div>
                                <div class="text-xs font-medium text-rose-600 mb-1">Syarat Belum Terpenuhi</div>
                                <div class="text-[10px] font-bold text-slate-400">{{ \Carbon\Carbon::parse($pengajuan->updated_at)->format('d M Y, H:i') }}</div>
                            </div>
                        @endif
                    </div>

                    @if($pengajuan->alasan_admin)
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 mt-4 relative">
                            <span class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 flex items-center gap-1.5"><i class="mdi mdi-message-text-outline text-slate-400"></i> Catatan Admin:</span>
                            <p class="text-sm font-medium text-slate-700 m-0 leading-relaxed">{{ $pengajuan->alasan_admin }}</p>
                        </div>
                    @endif
                </div>
            @endif

        </div>

        {{-- ========================================== --}}
        {{-- KOLOM KANAN: SYARAT UPGRADE & FORM         --}}
        {{-- ========================================== --}}
        <div class="lg:col-span-8">
            <div class="glass-panel rounded-[2rem] p-6 md:p-10">
                
                @if($nextTier)
                    {{-- Header Target Upgrade --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-5 mb-10 pb-8 border-b border-slate-200">
                        @php
                            $targetColor = $nextTier == 'official_store' ? 'from-purple-500 to-indigo-600 shadow-purple-500/30' : 'from-emerald-500 to-teal-600 shadow-emerald-500/30';
                            $targetText = $nextTier == 'official_store' ? 'from-purple-600 to-indigo-600' : 'from-emerald-600 to-teal-600';
                        @endphp
                        <div class="w-16 h-16 shrink-0 rounded-2xl bg-gradient-to-br {{ $targetColor }} flex items-center justify-center shadow-md text-white">
                            <i class="mdi mdi-arrow-up-bold text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight mb-2">
                                Target: <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $targetText }} uppercase">{{ str_replace('_', ' ', $nextTier) }}</span>
                            </h2>
                            <p class="text-sm font-medium text-slate-500 m-0 leading-relaxed">Selesaikan seluruh persyaratan metrik dan administratif di bawah ini untuk membuka fitur eksklusif kasta berikutnya.</p>
                        </div>
                    </div>

                    {{-- Grid Syarat --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        @foreach($syarat as $key => $val)
                            @php
                                $isMet = (isset($val['current']) ? $val['current'] >= $val['min'] : ($key == 'legalitas' ? ($val['nib'] && $val['npwp']) : false));
                                $cardBg = $isMet ? 'bg-emerald-50 border-emerald-200' : 'bg-slate-50 border-slate-200';
                            @endphp
                            
                            <div class="p-6 rounded-[1.5rem] border {{ $cardBg }} card-hover-effect relative overflow-hidden">
                                
                                <div class="flex justify-between items-start mb-5 relative z-10">
                                    <div class="flex items-center gap-3">
                                        @if($key == 'rating') 
                                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center"><i class="mdi mdi-star text-amber-600 text-xl"></i></div>
                                            <h6 class="text-sm font-bold text-slate-800">Rating Minimal</h6>
                                        @elseif($key == 'pesanan') 
                                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center"><i class="mdi mdi-shopping text-blue-600 text-xl"></i></div>
                                            <h6 class="text-sm font-bold text-slate-800">Pesanan Selesai</h6>
                                        @elseif($key == 'legalitas') 
                                            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center"><i class="mdi mdi-file-document-check text-purple-600 text-xl"></i></div>
                                            <h6 class="text-sm font-bold text-slate-800">Dokumen Usaha</h6>
                                        @endif
                                    </div>
                                    @if($isMet)
                                        <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center border border-emerald-200"><i class="mdi mdi-check text-sm font-black"></i></div>
                                    @else
                                        <div class="w-7 h-7 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center border border-slate-300"><i class="mdi mdi-lock text-sm"></i></div>
                                    @endif
                                </div>

                                <div class="relative z-10">
                                    @if($key == 'rating' || $key == 'pesanan')
                                        <div class="flex items-baseline gap-2 mb-4">
                                            <span class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($val['current'], $key == 'rating' ? 1 : 0) }}</span>
                                            <span class="text-sm font-bold text-slate-500">/ {{ number_format($val['min'], $key == 'rating' ? 1 : 0) }}</span>
                                        </div>
                                        
                                        @php 
                                            $percent = min(($val['current'] / $val['min']) * 100, 100); 
                                            $barGradient = $percent >= 100 ? 'bg-emerald-500' : 'bg-gradient-to-r from-blue-500 to-indigo-500 progress-bar-animated';
                                        @endphp
                                        <div class="w-full bg-slate-200 rounded-full h-2 border border-slate-300 overflow-hidden shadow-inner">
                                            <div class="{{ $barGradient }} h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <span class="text-[11px] font-black tracking-wider {{ $percent >= 100 ? 'text-emerald-600' : 'text-slate-500' }}">{{ round($percent) }}% TERPENUHI</span>
                                        </div>
                                    
                                    @elseif($key == 'legalitas')
                                        <div class="space-y-3 mt-2">
                                            <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border {{ $val['nib'] ? 'border-emerald-200' : 'border-slate-200' }} transition-colors shadow-sm">
                                                <div class="w-8 h-8 rounded-lg {{ $val['nib'] ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center shrink-0">
                                                    <i class="mdi {{ $val['nib'] ? 'mdi-check font-bold' : 'mdi-close' }}"></i>
                                                </div>
                                                <div class="text-xs font-bold {{ $val['nib'] ? 'text-slate-800' : 'text-slate-500' }}">Dokumen NIB</div>
                                            </div>
                                            <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border {{ $val['npwp'] ? 'border-emerald-200' : 'border-slate-200' }} transition-colors shadow-sm">
                                                <div class="w-8 h-8 rounded-lg {{ $val['npwp'] ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center shrink-0">
                                                    <i class="mdi {{ $val['npwp'] ? 'mdi-check font-bold' : 'mdi-close' }}"></i>
                                                </div>
                                                <div class="text-xs font-bold {{ $val['npwp'] ? 'text-slate-800' : 'text-slate-500' }}">Dokumen NPWP/KTP</div>
                                            </div>
                                        </div>
                                        @if(!$isMet)
                                            <div class="mt-5">
                                                <a href="{{ route('seller.shop.profile') }}" class="inline-flex items-center justify-center w-full py-3 rounded-xl bg-slate-100 hover:bg-slate-200:bg-slate-700 text-xs font-black text-slate-700 transition-all border border-slate-300 gap-2">
                                                    <i class="mdi mdi-upload"></i> Lengkapi Dokumen
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form Pengajuan / Aksi --}}
                    @if($isEligible)
                        @if(!$pengajuan || in_array($pengajuan->status, ['approved', 'rejected']))
                            <form action="{{ route('seller.shop.tier.apply') }}" method="POST" class="bg-slate-50 p-6 md:p-8 rounded-[1.5rem] border border-slate-200 relative">
                                @csrf
                                <div class="absolute -top-3 left-8 bg-white border border-slate-200 px-4 py-1 rounded-full text-[10px] font-black text-emerald-600 uppercase tracking-widest shadow-sm">Syarat Terpenuhi</div>
                                
                                <div class="mb-6 mt-2">
                                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-3"><i class="mdi mdi-message-text-outline mr-1.5"></i>Pesan Untuk Tim Penilai (Opsional)</label>
                                    <textarea name="catatan" rows="3" 
                                        class="w-full bg-white border border-slate-300 text-slate-900 text-sm rounded-xl px-5 py-4 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder:text-slate-400:text-slate-600 shadow-sm"
                                        placeholder="Beritahu kami nilai tambah toko Anda atau alasan kelayakan upgrade..."></textarea>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black py-4 md:py-5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-3">
                                    <span class="text-sm tracking-widest uppercase">Ajukan Kenaikan Level Sekarang</span>
                                </button>
                            </form>
                        @else
                            <div class="flex items-center justify-center p-8 bg-slate-50 rounded-[1.5rem] border border-slate-200 border-t-4 border-t-amber-500 shadow-sm text-center">
                                <div>
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-100 text-amber-600 mb-4">
                                        <i class="mdi mdi-shield-search text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-black text-slate-900 mb-2">Pengajuan Dalam Antrean Validasi</h4>
                                    <p class="text-sm font-medium text-slate-500 max-w-md mx-auto leading-relaxed">Tim kurasi kami sedang memvalidasi data toko Anda. Proses ini memakan waktu maksimal 1x24 jam kerja.</p>
                                </div>
                            </div>
                        @endif
                    @else
                        {{-- Tombol Terkunci --}}
                        <div class="mt-8">
                            <button disabled class="w-full bg-slate-100 border-2 border-dashed border-slate-300 text-slate-400 font-black py-4 rounded-2xl cursor-not-allowed flex items-center justify-center gap-3">
                                <i class="mdi mdi-lock-outline text-xl"></i>
                                <span class="tracking-widest uppercase text-sm">Penuhi Semua Syarat Untuk Mengajukan</span>
                            </button>
                        </div>
                    @endif

                @else
                    {{-- ========================================== --}}
                    {{-- STATE: TIER MAKSIMAL (OFFICIAL STORE)      --}}
                    {{-- ========================================== --}}
                    <div class="text-center py-12 md:py-20 px-4">
                        <div class="relative w-32 h-32 mx-auto mb-8">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 blur-xl opacity-40 rounded-full"></div>
                            <div class="relative w-full h-full bg-white border border-slate-200 rounded-full flex items-center justify-center shadow-lg">
                                <i class="mdi mdi-crown text-6xl text-transparent bg-clip-text bg-gradient-to-br from-purple-600 to-indigo-600"></i>
                            </div>
                        </div>
                        
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-4">Anda Berada di Puncak!</h2>
                        <p class="text-base font-medium text-slate-600 max-w-xl mx-auto leading-relaxed">Toko Anda saat ini berada di kasta tertinggi <span class="text-purple-600 font-bold">(Official Store)</span>. Terima kasih atas dedikasi Anda.</p>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection