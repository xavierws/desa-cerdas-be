<?php

namespace App\Http\Controllers\api\facility;

use App\Actions\SendResponse;
use App\Actions\StoreImage;
use App\Http\Controllers\Controller;
use App\Http\Resources\FacilityCategoryCollection;
use App\Http\Resources\FacilityCollection;
use App\Http\Resources\FacilityResource;
use App\Models\Facility;
use App\Models\FacilityCategory;
use App\Models\FacilityImage;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FasumController extends Controller
{
    public function storeCategory(Request $request)
    {
        $category = FacilityCategory::create([
            'name' => $request->input('name')
        ]);

        return SendResponse::handle($category, 'Kategori berhasil dibuat');
    }

    public function storeCategoryImage(Request $request)
    {
        $url = StoreImage::handle(
            $request->input('base64_image'),
            'facility/category',
            $request->input('facility_category_id')
        );

        $facilityImage = FacilityImage::create([
            'url' => $url,
            'imageable_id' => $request->input('facility_category_id'),
            'imageable_type' => FacilityCategory::class
        ]);

        return SendResponse::handle($facilityImage, 'Gambar berhasil disimpan');
    }

    public function indexCategory()
    {
        $categories = FacilityCategory::all();

        return new FacilityCategoryCollection($categories);
    }

    public function updateCategory(Request $request)
    {
        $category = FacilityCategory::find($request->input('facility_category_id'));
        if (!$category) {
            throw ValidationException::withMessages([
                'category' => ['Facility Category tidak ditemukan']
            ]);
        }

        if ($request->has('base64_image')) {
            StoreImage::delete($category->image->url);
            $url = StoreImage::handle(
                $request->input('base64_image'),
                'facility/category',
                $request->input('facility_category_id')
            );
            $category->image->url = $url;
            $category->image->save();
        }

        $category->name = $request->input('name');
        $category->save();

        return SendResponse::handle($category, 'category berhasil diubah');
    }

    public function destroyCategory(Request $request)
    {
        $category = FacilityCategory::find($request->input('facility_category_id'));
        if (!$category) {
            throw ValidationException::withMessages([
                'category' => ['Facility Category tidak ditemukan']
            ]);
        }

        StoreImage::delete($category->image->url);
        $category->image->delete();
        $category->delete();

        return SendResponse::handle($category, 'category berhasil dihapus');
    }

    public function store(Request $request)
    {
        $facility = Facility::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'map_url' => $request->input('map_url'),
            'information' => $request->input('information'),
            'category_id' => $request->input('facility_category_id'),
        ]);

        $imageUrl = StoreImage::handle(
            $request->input('base64_image'),
            'facility/list',
            $facility->id
        );

        $image = FacilityImage::create([
            'url' => $imageUrl,
            'imageable_id' => $facility->id,
            'imageable_type' => Facility::class,
        ]);

        return SendResponse::handle($facility, 'fasum berhasil dibuat');
    }

    public function index()
    {
        $facilities = Facility::all();

        return new FacilityCollection($facilities);
    }

    public function show($facilityId)
    {
        $facility = Facility::findOrFail($facilityId);

        return SendResponse::handle(new FacilityResource($facility), 'data berhasil diambil');
    }

    public function update(Request $request)
    {

    }

}
