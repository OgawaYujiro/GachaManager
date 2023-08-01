<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Gacha;

class CsvDownloadController extends Controller
{
    public function DownloadCSV()
    {
        $gacha = Gacha::all();
        $csvHeader = ['id', 'name', 'content'];
        $csvData = $gacha->toArray();

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="gacha.csv"',
        ]);

        return $response;
    }
}