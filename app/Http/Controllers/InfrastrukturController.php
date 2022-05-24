<?php

namespace App\Http\Controllers;

use App\Actions\SendResponse;
use App\Actions\StoreImage;
use App\Models\InfrastrukturCategory;
use App\Models\InfrastrukturImages;
use App\Models\InfrastrukturList;
use Exception;
use Illuminate\Http\Request;



class InfrastrukturController extends Controller
{


    public function infrastrukturStore(Request $request)
    {
        $category = InfrastrukturCategory::create([
            'name' => $request['name'],
        ]);
        return SendResponse::handle($category, "success");
    }

    public function infrastrukturCategory()
    {
        $category = InfrastrukturCategory::all();
        return SendResponse::handle($category, "success");
    }
    public function infrastrukturUpdate(Request $request)
    {
        $category = InfrastrukturCategory::find($request->id);
        if ($category) {
            $category->name = $request['name'];
            $category->save();
            return SendResponse::handle($category, "success");
        } else {
            return SendResponse::error("error");
        }
    }
    public function infrastrukturDelete(Request $request)
    {
        $category = InfrastrukturCategory::find($request->id);
        if ($category) {
            $category->delete();
            return SendResponse::handle($category, "success");
        } else {
            return SendResponse::error("error");
        }
    }

    public function infrastrukturListStore(Request $request)
    {
        $image_url = StoreImage::handle($request->base64_thumbnail, "Infrastruktur/list/", "");
        try {
            $InfrastrukturList = InfrastrukturList::create([
                'name' => $request->name,
                'description' => $request->description,
                'thumbnail_url' => $image_url,
                'map_url' => $request->map_url,
                'information' => $request->information,
                'infrastruktur_category_id' => $request->infrastruktur_category_id
            ]);
            return SendResponse::handle($InfrastrukturList, "success");
        } catch (Exception $e) {
            return SendResponse::error($e);
        }
    }

    public function infrastrukturList(Request $request)
    {
        $InfrastrukturLists = InfrastrukturList::where('infrastruktur_category_id', $request->category_id)->get();
        $data = [];
        foreach ($InfrastrukturLists as $InfrastrukturList) {
            $a = $InfrastrukturList->category;
            $data[] = ['infrastruktur' => $InfrastrukturList];
        }
        return SendResponse::handle($data, "success");
    }
    public function infrastrukturListUpdate(Request $request)
    {
        $InfrastrukturList = InfrastrukturList::find($request->id);
        if ($InfrastrukturList) {
            $thumbnail_url = $InfrastrukturList->thumbnail_url;
            if ($request->base64_thumbnail) {
                StoreImage::delete($InfrastrukturList->thumbnail_url);
                $thumbnail_url = StoreImage::handle($request->base64_thumbnail, "Infrastruktur/list/", "");
            }
            $InfrastrukturList->name = $request->name;
            $InfrastrukturList->description = $request->description;
            $InfrastrukturList->thumbnail_url = $thumbnail_url;
            $InfrastrukturList->map_url = $request->map_url;
            $InfrastrukturList->information = $request->information;
            $InfrastrukturList->infrastruktur_category_id = $request->infrastruktur_category_id;
            $InfrastrukturList->save();
            return SendResponse::handle($InfrastrukturList, "success");
        } else {
            return SendResponse::error("error");
        }
    }
    public function infrastrukturListDelete(Request $request)
    {
        $InfrastrukturList = InfrastrukturList::find($request->id);
        if ($InfrastrukturList) {
            $InfrastrukturList->delete();
            return SendResponse::handle($InfrastrukturList, "success");
        } else {
            return SendResponse::error("error");
        }
    }

    public function infrastrukturImagesStore(Request $request)
    {
        $image_url = StoreImage::handle($request->base64_images, "Infrastruktur/list/", "");
        $InfrastrukturImages = InfrastrukturImages::create([
            'image_url' => $image_url,
            'infrastruktur_list_id' => $request->infrastruktur_list_id,
        ]);
        return SendResponse::handle($InfrastrukturImages, "success");
    }

    public function infrastrukturImagesList($id)
    {
        $InfrastrukturImages = InfrastrukturImages::where("infrastruktur_list_id", $id)->get();
        return SendResponse::handle($InfrastrukturImages, "success");
    }
    public function infrastrukturImagesUpdate(Request $request)
    {
        $InfrastrukturImages = InfrastrukturImages::find($request->id);
        if ($InfrastrukturImages) {

            StoreImage::delete($InfrastrukturImages->image_url);
            $images = StoreImage::handle($request->base64_images, "Infrastruktur/list/", "");

            $InfrastrukturImages->image_url = $images;
            $InfrastrukturImages->save();
            return SendResponse::handle($InfrastrukturImages, "success");
        } else {
            return SendResponse::error("error");
        }
    }
    public function infrastrukturImagesDelete(Request $request)
    {
        $InfrastrukturImages = InfrastrukturImages::find($request->id);
        if ($InfrastrukturImages) {
            $InfrastrukturImages->delete();
            return SendResponse::handle($InfrastrukturImages, "success");
        } else {
            return SendResponse::error("error");
        }
    }
}
