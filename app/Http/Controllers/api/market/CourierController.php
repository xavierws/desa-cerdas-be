<?php

namespace App\Http\Controllers\api\market;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function store(Request $request)
    {
        $courier = Courier::query()->create([
            'name' => $request->input('name'),
            'nik' => $request->input('nik'),
        ]);

        return SendResponse::handle($courier, 'Data berhasil dibuat');
    }

    public function index()
    {
        $couriers = Courier::all();

        return SendResponse::handle($couriers, 'data berhasil diambil');
    }

    public function destroy()
    {

    }

    public function assign()
    {

    }
}
