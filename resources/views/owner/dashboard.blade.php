@extends('layouts.app-custom')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6 rounded-2xl text-white shadow-lg">
            <div class="text-sm font-semibold uppercase opacity-80">Total Omset Pendapatan Parkir</div>
            <div class="text-4xl font-black mt-2">Rp {{ number_format($totalOmset) }}</div>
        </div>
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-2xl text-white shadow-lg flex justify-between items-center">
            <div>
                <div class="text-sm font-semibold uppercase opacity-80">Volume Transaksi Kendaraan</div>
                <div class="text-4xl font-black mt-2">{{ $volumeTransaksi }} Transaksi</div>
            </div>
            <a href="{{ route('owner.export') }}" class="px-4 py-2 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 shadow transition">
                📥 Export Laporan (CSV)
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border">
        <h3 class="text-lg font-bold mb-4 text-gray-800">📋 Dokumen Transaksi Berjalan (Read-Only)</h3>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider border-b">
                    <th class="p-3">ID Tiket</th>
                    <th class="p-3">Plat Nomor</th>
                    <th class="p-3">Waktu Masuk</th>
                    <th class="p-3">Waktu Keluar</th>
                    <th class="p-3">Total Biaya</th>
                    <th class="p-3">Petugas</th>
                </tr>
            </thead>
            <tbody class="divide-y text-sm text-gray-700">
                @forelse($riwayat as $r)
                <tr>
                    <td class="p-3 font-semibold text-pink-600">{{ $r->nomor_tiket }}</td>
                    <td class="p-3"><span class="bg-gray-100 px-2 py-1 rounded font-mono">{{ $r->plat_nomor }}</span></td>
                    <td class="p-3">{{ $r->waktu_masuk }}</td>
                    <td class="p-3">{{ $r->waktu_keluar ?? 'Masih Parkir' }}</td>
                    <td class="p-3 font-bold">Rp {{ number_format($r->total_biaya) }}</td>
                    <td class="p-3">{{ $r->petugas->name ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-4 text-center text-gray-400">Belum ada transaksi keluar hari ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection