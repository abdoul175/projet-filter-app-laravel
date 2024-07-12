<?php

namespace App\Http\Controllers;

use App\Models\Prime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImportRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class FileController extends Controller
{
    public function index() {
        $primes = Prime::all();

        return view('primes.index', compact('primes'));
    }

    public function import(ImportRequest $request) {
        $request->validated();

        $file = $request->file('file');

        fastexcel()->import($file, function ($row) {
            if($row['RETARD'] > 0) {
                if(strlen($row['CONTACT']) === 8) {
                    $allowedCarac = ['7', '9'];
                    $contact = "".$row['CONTACT'];
                    $firstCarac = $contact[0];

                    if(in_array($firstCarac, $allowedCarac)) {
                        $data = [
                            'id_' => $row['ID'],
                            'police' => $row['POLICE'],
                            'nom' => $row['NOM'],
                            'retard' => $row['RETARD'],
                            'contact' => "228". $row['CONTACT'],
                        ];

                        return Prime::create($data);
                    }
                }
            }
        });

        return redirect('/')->with('success', 'Les données ont été importées avec succès.');
    }

    public function export(Request $request) {
        $request->validate([
            'name' => ['string']
        ]);

        $name = $request->input('name');

        $filename = $name . '.xlsx';

        $data = Prime::select('id_', 'police', 'nom', 'retard', 'contact')->get();

        DB::statement('DELETE FROM primes');

        return (new FastExcel($data))->download($filename);
    }
}
