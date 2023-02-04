<?php

namespace App\Http\Controllers\api\profile;

use App\Actions\SendResponse;
use App\Actions\StoreImage;
use App\Http\Controllers\Controller;
use App\Models\VillageInformation;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function store(Request $request)
    {
        $imageUrl = StoreImage::handle(
            $request->input('base64_image'),
            'information/village/',
            '1'
        );

        $info = VillageInformation::create([
            'vision' => $request->input('visi'),
            'mission' => $request->input('misi'),
            'image' => $imageUrl,
            'url' => $request->input('url'),
        ]);

        return SendResponse::handle($info, 'Informasi berhasil dimasukkan');
    }

    public function show($id)
    {
        $info = VillageInformation::find($id);

        return SendResponse::handle($info, 'Informasi berhsasil diambil');
    }

    public function update(Request $request)
    {
        $info = VillageInformation::find($request->input('id'));

        if ($request->has('base64_image')) {
            StoreImage::delete($info->image);
            $imageUrl = StoreImage::handle(
                $request->input('base64_image'),
                'facility/village/',
                '1'
            );
            $info->image = $imageUrl;
        }

        $info->vision = $request->input('visi');
        $info->mission = $request->input('misi');
        $info->url = $request->input('url');
        $info->save();

        return SendResponse::handle($info, 'informasi berhasil diubah');
    }
}
