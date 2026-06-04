@extends('layouts.app-custom')

@section('content')
<div class="space-y-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <h3 class="text-lg font-bold mb-4 text-gray-800">➕ Daftarkan Akun Baru</h3>
            <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-3">
                @csrf
                <input type="text" name="name" placeholder="Nama Lengkap" class="w-full border p-2 rounded-lg" required>
                <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded-lg" required>
                <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded-lg" required>
                <select name="role" class="w-full border p-2 rounded-lg">
                    <option value="petugas">Petugas Lapangan</option>
                    <option value="admin">Super Admin</option>
                </select>
                <button class="w-full py-2 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-lg transition">Simpan Akun</button>
            </form>
        </div>
        <div class="md:col-span-2">
            <h3 class="text-lg font-bold mb-4 text-gray-800">👥 Daftar Pengguna Aktif</h3>
            <ul class="divide-y max-h-56 overflow-y-auto pr-2">
                @foreach($users as $user)
                <li class="py-2 flex justify-between items-center text-sm">
                    <div><strong>{{ $user->name }}</strong> <span class="text-xs text-gray-400">({{ $user->email }})</span></div>
                    <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700':'bg-orange-100 text-orange-700' }}">{{ $user->role }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border">
        <h3 class="text-lg font-bold mb-4 text-gray-800">⚙️ Konfigurasi Tarif & Kapasitas Gedung</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($rates as $rate)
            <div class="border p-4 rounded-xl bg-gray-50">
                <h4 class="font-bold text-pink-700 text-base mb-2">Kategori: {{ $rate->jenis_kendaraan }} ({{ $rate->area_parkir }})</h4>
                <form action="{{ route('admin.rate.update', $rate->id) }}" method="POST" class="space-y-2 text-sm">
                    @csrf @method('PUT')
                    <div class="flex justify-between items-center">
                        <label>Tarif Flat Awal:</label>
                        <input type="number" name="tarif_flat" value="{{ $rate->tarif_flat }}" class="border p-1 w-32 rounded text-right">
                    </div>
                    <div class="flex justify-between items-center">
                        <label>Progresif / Jam:</label>
                        <input type="number" name="tarif_progresif" value="{{ $rate->tarif_progresif }}" class="border p-1 w-32 rounded text-right">
                    </div>
                    <div class="flex justify-between items-center">
                        <label>Denda Tiket Hilang:</label>
                        <input type="number" name="denda_hilang" value="{{ $rate->denda_hilang }}" class="border p-1 w-32 rounded text-right">
                    </div>
                    <div class="flex justify-between items-center">
                        <label>Max Kapasitas Slot:</label>
                        <input type="number" name="kapasitas_maksimal" value="{{ $rate->kapasitas_maksimal }}" class="border p-1 w-32 rounded text-right">
                    </div>
                    <button class="w-full mt-2 py-1 bg-gray-800 text-white font-semibold rounded hover:bg-gray-900 transition text-xs">Simpan Perubahan Tarif</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection