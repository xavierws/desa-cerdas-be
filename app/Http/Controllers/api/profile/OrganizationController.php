<?php

namespace App\Http\Controllers\api\profile;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Models\OrganizationOfficial;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function store(Request $request)
    {
        $organization = Organization::create([
            'name' => $request->input('name'),
            'type_id' => $request->input('type') === 'paten'? 1:2
        ]);

        $officials = $request->input('officials');

        foreach ($officials as $official) {
            $orgOfficial = OrganizationOfficial::create([
                'occupation' => $official['occupation'],
                'name' => $official['name'],
                'organization_id' => $organization->id,
            ]);
        }

        return SendResponse::handle(new OrganizationResource($organization), 'Organisasi berhasil dibuat');
    }

//    public function storeOfficial(Request $request)
//    {
//        $officials = $request->input('officials');
//        $orgOfficials = [];
//
//        foreach ($officials as $official) {
//            $orgOfficial = OrganizationOfficial::create([
//                'occupation' => $official['occupation'],
//                'name' => $official['name'],
//                'organization_id' => $request->input('org_id'),
//            ]);
//
//            $orgOfficials[] = $orgOfficial;
//        }
//
//        return SendResponse::handle($orgOfficials, 'Anggota Organisasi berhasil dimasukkan');
//    }

    public function index(Request $request)
    {
//        $organizations = Organization::all();
        $orgPaten = Organization::where('type_id', 1)->get();
        $orgNonPaten = Organization::where('type_id', 2)->get();

        return SendResponse::handle([
            'paten' => $orgPaten,
            'non_paten' => $orgNonPaten,
        ], 'data berhasil diambil');
    }

    public function show($orgId)
    {
        $org = Organization::with('officials')->find($orgId);

        return SendResponse::handle(new OrganizationResource($org), 'data berhasil diambil');
    }

    public function update(Request $request)
    {
        $org = Organization::with('officials')->find($request->input('org_id'));

        $org->officials->delete();

        $org->name = $request->input('name');
        $org->save();

        $orgOfficials = [];
        foreach ($request->input('officialls') as $official) {
            $orgofficial = OrganizationOfficial::create([
                'occupation' => $official['occupation'],
                'name' => $official['name'],
                'organization_id' => $org->id,
            ]);

            $orgOfficials[] = $orgofficial;
        }

        return SendResponse::handle(json_encode([
            'name' => $org->name,
            'officials' => $orgOfficials,
        ]), 'data organisasi berhasil diubah');
    }
}
