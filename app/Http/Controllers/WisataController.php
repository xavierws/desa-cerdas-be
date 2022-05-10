<?php

namespace App\Http\Controllers;

use App\Actions\SendResponse;
use App\Actions\StoreImage;
use App\Models\Wisata;
use App\Models\WisataCategory;
use App\Models\WisataImages;
use App\Models\WisataList;
use Illuminate\Http\Request;



class WisataController extends Controller
{
    public function pageStore(Request $request)
    {
        $wisata = Wisata::first();
        if (!$wisata) {
            $image_url = StoreImage::handle($request->base64_image, "wisata/", "");
            $wisata = Wisata::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'image_url' => $image_url,
            ]);
        } else {
            $image_url = $wisata->image_url;
            if ($request->base64_image) {
                StoreImage::delete($wisata->image_url);
                $image_url = StoreImage::handle($request->base64_image, "wisata/", "");
            }
            $wisata->name = $request['name'];
            $wisata->description = $request['description'];
            $wisata->image_url = $image_url;
            $wisata->save();
        }
        return SendResponse::handle($wisata, "success");
    }

    public function pageShow()
    {
        $wisata = Wisata::first();
        return SendResponse::handle($wisata, "success");
    }


    public function categoryStore(Request $request)
    {
        $category = WisataCategory::create([
            'name' => $request['name'],
        ]);
        return SendResponse::handle($category, "success");
    }

    public function categoryList()
    {
        $category = WisataCategory::all();
        return SendResponse::handle($category, "success");
    }
    public function categoryUpdate(Request $request)
    {
        $category = WisataCategory::find($request->id);
        if ($category) {
            $category->name = $request['name'];
            $category->save();
            return SendResponse::handle($category, "success");
        } else {
            return SendResponse::error("error");
        }
    }
    public function categoryDelete(Request $request)
    {
        $category = WisataCategory::find($request->id);
        if ($category) {
            $category->delete();
            return SendResponse::handle($category, "success");
        } else {
            return SendResponse::error("error");
        }
    }

    public function wisataListStore(Request $request)
    {
        $image_url = StoreImage::handle($request->base64_thumbnail, "wisata/list/", "");
        $wisataList = WisataList::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail_url' => $image_url,
            'map_url' => $request->map_url,
            'web_url' => $request->web_url,
            'phone' => $request->phone,
            'information' => $request->information,
            'wisata_category_id' => $request->wisata_category_id
        ]);
        return SendResponse::handle($wisataList, "success");
    }

    public function wisataList()
    {
        $wisataLists = WisataList::all();
        $data = [];
        foreach ($wisataLists as $wisataList) {
            $a = $wisataList->category;
            $data[] = ['wisata' => $wisataList];
        }
        return SendResponse::handle($data, "success");
    }
    public function wisataListUpdate(Request $request)
    {
        $wisataList = WisataList::find($request->id);
        if ($wisataList) {
            $thumbnail_url = $wisataList->thumbnail_url;
            if ($request->base64_thumbnail) {
                StoreImage::delete($wisataList->thumbnail_url);
                $thumbnail_url = StoreImage::handle($request->base64_thumbnail, "wisata/list/", "");
            }
            $wisataList->name = $request->name;
            $wisataList->description = $request->description;
            $wisataList->thumbnail_url = $thumbnail_url;
            $wisataList->map_url = $request->map_url;
            $wisataList->web_url = $request->web_url;
            $wisataList->phone = $request->phone;
            $wisataList->information = $request->information;
            $wisataList->wisata_category_id = $request->wisata_category_id;
            $wisataList->save();
            return SendResponse::handle($wisataList, "success");
        } else {
            return SendResponse::error("error");
        }
    }
    public function wisataListDelete(Request $request)
    {
        $wisataList = WisataList::find($request->id);
        if ($wisataList) {
            $wisataList->delete();
            return SendResponse::handle($wisataList, "success");
        } else {
            return SendResponse::error("error");
        }
    }

    public function wisataImagesStore(Request $request)
    {
        $image_url = StoreImage::handle($request->base64_images, "wisata/list/", "");
        $wisataImages = WisataImages::create([
            'image_url' => $image_url,
            'wisata_list_id' => $request->wisata_list_id,
        ]);
        return SendResponse::handle($wisataImages, "success");
    }

    public function wisataImagesList()
    {
        $wisataImages = WisataImages::all();
        return SendResponse::handle($wisataImages, "success");
    }
    public function wisataImagesUpdate(Request $request)
    {
        $wisataImages = WisataImages::find($request->id);
        if ($wisataImages) {

            StoreImage::delete($wisataImages->image_url);
            $images = StoreImage::handle($request->base64_images, "wisata/list/", "");

            $wisataImages->image_url = $images;
            $wisataImages->save();
            return SendResponse::handle($wisataImages, "success");
        } else {
            return SendResponse::error("error");
        }
    }
    public function wisataImagesDelete(Request $request)
    {
        $wisataImages = WisataImages::find($request->id);
        if ($wisataImages) {
            $wisataImages->delete();
            return SendResponse::handle($wisataImages, "success");
        } else {
            return SendResponse::error("error");
        }
    }
}
