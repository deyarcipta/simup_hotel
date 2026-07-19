<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\LogbookDetail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLogbookController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $logbooks = Logbook::with(['details.shift', 'details.user'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total omzet bulan ini dari logbook_details
        $totalOmzet = LogbookDetail::whereHas('logbook', function ($query) use ($bulan, $tahun) {
            $query->whereMonth('tanggal', $bulan)
                  ->whereYear('tanggal', $tahun);
        })->sum('total_uang');

        // List tahun untuk filter (dari logbook tertua sampai tahun depan)
        $tahunTertua = Logbook::orderBy('tanggal', 'asc')->first()?->tanggal?->year ?? Carbon::now()->year;
        $listTahun = range($tahunTertua, Carbon::now()->year + 1);

        return view('admin.logbook.index', compact('logbooks', 'bulan', 'tahun', 'totalOmzet', 'listTahun'));
    }

    public function show($id)
    {
        $logbook = Logbook::with(['details.shift', 'details.user'])->findOrFail($id);
        return view('admin.logbook.show', compact('logbook'));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $logbooks = Logbook::with(['details.shift', 'details.user'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('admin.logbook.pdf', compact('logbooks', 'bulan', 'tahun', 'namaBulan'))
            ->setPaper('A4', 'landscape');

        return $pdf->download("Laporan-Logbook-UP-{$namaBulan}-{$tahun}.pdf");
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $logbooks = Logbook::with(['details.shift', 'details.user'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');
        $fileName = "Laporan-Logbook-UP-{$namaBulan}-{$tahun}.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $jumlahShiftSetting = \App\Models\Pengaturan::first()->jumlah_shift ?? 2;

        $columns = [
            'Tanggal', 
            'Kas Awal', 
            'Kas Akhir', 
            'Shift 1 Pagi - Kiloan (Kg)', 
            'Shift 1 Pagi - Satuan', 
            'Shift 1 Pagi - Dry Cleaning', 
            'Shift 1 Pagi - Total',
        ];

        if ($jumlahShiftSetting >= 2) {
            $columns[] = 'Shift 2 Siang - Kiloan (Kg)';
            $columns[] = 'Shift 2 Siang - Satuan';
            $columns[] = 'Shift 2 Siang - Dry Cleaning';
            $columns[] = 'Shift 2 Siang - Total';
        }

        if ($jumlahShiftSetting == 3) {
            $columns[] = 'Shift 3 Malam - Kiloan (Kg)';
            $columns[] = 'Shift 3 Malam - Satuan';
            $columns[] = 'Shift 3 Malam - Dry Cleaning';
            $columns[] = 'Shift 3 Malam - Total';
        }

        $columns[] = 'Total Omzet Harian';
        $columns[] = 'Stok Detergen';
        $columns[] = 'Status Mesin';

        $callback = function() use($logbooks, $columns, $jumlahShiftSetting) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logbooks as $logbook) {
                $shift1 = $logbook->details->where('shift_id', 1)->first();
                $shift2 = $logbook->details->where('shift_id', 2)->first();
                $shift3 = $logbook->details->where('shift_id', 3)->first();

                $totalOmzet = ($shift1?->total_uang ?? 0);
                if ($jumlahShiftSetting >= 2) {
                    $totalOmzet += ($shift2?->total_uang ?? 0);
                }
                if ($jumlahShiftSetting == 3) {
                    $totalOmzet += ($shift3?->total_uang ?? 0);
                }

                $row = [
                    $logbook->tanggal->format('Y-m-d'),
                    $logbook->kas_awal,
                    $logbook->kas_akhir ?? '-',
                    $shift1?->jumlah_kiloan ?? 0,
                    $shift1?->jumlah_satuan ?? 0,
                    $shift1?->jumlah_dry_cleaning ?? 0,
                    $shift1?->total_uang ?? 0,
                ];

                if ($jumlahShiftSetting >= 2) {
                    $row[] = $shift2?->jumlah_kiloan ?? 0;
                    $row[] = $shift2?->jumlah_satuan ?? 0;
                    $row[] = $shift2?->jumlah_dry_cleaning ?? 0;
                    $row[] = $shift2?->total_uang ?? 0;
                }

                if ($jumlahShiftSetting == 3) {
                    $row[] = $shift3?->jumlah_kiloan ?? 0;
                    $row[] = $shift3?->jumlah_satuan ?? 0;
                    $row[] = $shift3?->jumlah_dry_cleaning ?? 0;
                    $row[] = $shift3?->total_uang ?? 0;
                }

                $row[] = $totalOmzet;
                $row[] = $logbook->stok_detergen ?? '-';
                $row[] = $logbook->status_mesin ?? '-';

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
