@extends('layouts.app-custom')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border h-fit">
        <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">🚗 Pencatatan Parkir Masuk</h3>
        <form action="{{ route('petugas.masuk') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Nomor Polisi (Plat)</label>
                <input type="text" name="plat_nomor" placeholder="Contoh: B 1234 ABC" class="w-full border p-3 rounded-xl font-mono text-xl uppercase tracking-wider text-center focus:ring-2 focus:ring-pink-500 focus:outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Zona Kategori</label>
                <select name="parking_rate_id" class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none bg-white">
                    @foreach($rates as $r)
                        <option value="{{ $r->id }}">{{ $r->jenis_kendaraan }} - {{ $r->area_parkir }} (Sisa: {{ $r->sisa_slot }})</option>
                    @endforeach
                </select>
            </div>
            <button class="w-full py-3 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold rounded-xl shadow transition">
                🖨️ Submit & Cetak Karcis
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border">
        <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">💳 Kendaraan Masih Parkir (Kasir Keluar)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs font-semibold uppercase tracking-wider border-b">
                        <th class="p-3">Karcis</th>
                        <th class="p-3">Plat Nomor</th>
                        <th class="p-3">Jam Masuk</th>
                        <th class="p-3 text-center">Aksi Transaksi Keluar</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm text-gray-700">
                    @forelse($activeParkings as $ap)
                    <tr>
                        <td class="p-3 font-bold text-gray-900">{{ $ap->nomor_tiket }}</td>
                        <td class="p-3"><span class="bg-gray-100 font-mono px-2 py-1 rounded text-base font-bold">{{ $ap->plat_nomor }}</span></td>
                        <td class="p-3 text-xs">{{ \Carbon\Carbon::parse($ap->waktu_masuk)->format('H:i:s (d M)') }}</td>
                        <td class="p-3">
                            <form action="{{ route('petugas.keluar', $ap->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                @csrf
                                <select name="metode_pembayaran" class="text-xs border p-1 rounded">
                                    <option value="Tunai">Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                                <button type="submit" class="px-3 py-1 bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs rounded transition shadow-sm">
                                    🚪 Keluar
                                </button>
                                <button type="submit" name="tiket_hilang" value="1" class="px-2 py-1 bg-red-100 text-red-600 font-semibold text-xs rounded hover:bg-red-200 transition" onclick="return confirm('Proses denda tiket hilang?')">
                                    ⚠️ Hilang
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-8 text-center text-gray-400 italic">Tidak ada kendaraan aktif di dalam area parkir.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection