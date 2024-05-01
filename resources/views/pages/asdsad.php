<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectListController;
use App\Http\Controllers\TaskManagerController;
use App\Models\Data;


class CalendarController extends Controller
{
    public function index()
    {
        // Mendapatkan tahun saat ini (misalnya tahun saat ini dari tanggal sekarang)
        $year = date('Y'); // Menggunakan format 'Y' untuk mendapatkan tahun dengan empat digit

        // Mendapatkan bulan saat ini (misalnya bulan saat ini dari tanggal sekarang)
        $month = date('n'); // Menggunakan format 'n' untuk mendapatkan nomor bulan tanpa leading zero

        // Ambil semua data dari tabel 'data'
        $data = Data::all();

        // Buat array kosong untuk menyimpan data berdasarkan tanggal
        $calendarData = [];

        // Iterasi melalui setiap data
        foreach ($data as $item) {
            // Ambil tanggal start_date
            $startDate = $item->start_date;
            // Ambil nilai toyName
            $toyName = $item->toyName;

            // Ubah format tanggal menjadi format yang sesuai untuk digunakan sebagai kunci array
            $formattedDate = date('Y-m-d', strtotime($startDate));

            // Tambahkan data ke array calendarData
            $calendarData[$formattedDate] = $toyName;
        }

        // Mendefinisikan array nama bulan untuk digunakan dalam tampilan Blade
        $monthName = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        // Kirim data ke view dan tampilkan menggunakan blade template
        return view("pages.calendar2", ['calendarData' => $calendarData, 'year' => $year, 'month' => $month, 'monthName' => $monthName]);
    }
}
