<?php

namespace App\Http\Controllers;

use App\Models\ParkingTransaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OwnerController extends Controller {
    public function dashboard() {
        $totalOmset = ParkingTransaction::where('status', 'Keluar')->sum('total_biaya');
        $volumeTransaksi = ParkingTransaction::count();
        $riwayat = ParkingTransaction::with(['rate', 'petugas'])->latest()->get();
        $logs = ActivityLog::with('user')->latest()->take(10)->get();

        // Data Chart Sederhana (Harian minggu ini)
        $chartData = ParkingTransaction::where('status', 'Keluar')
            ->where('waktu_keluar', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(waktu_keluar) as date, SUM(total_biaya) as total')
            ->groupBy('date')
            ->pluck('total', 'date');

        return view('owner.dashboard', compact('totalOmset', 'volumeTransaksi', 'riwayat', 'logs', 'chartData'));
    }

    public function exportCSV() {
        $fileName = 'laporan-pendapatan-' . now()->format('Y-md') . '.csv';
        $tasks = ParkingTransaction::where('status', 'Keluar')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID Tiket', 'Plat Nomor', 'Waktu Masuk', 'Waktu Keluar', 'Total Biaya', 'Metode');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                fputcsv($file, array($task->nomor_tiket, $task->plat_nomor, $task->waktu_masuk, $task->waktu_keluar, $task->total_biaya, $task->metode_pembayaran));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}