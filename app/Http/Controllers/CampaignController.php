<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Campaign::orderBy('created_at','DESC')->get();
    }

    public function store(Request $request)
    {
        $new_camp = new Campaign();
        $new_camp->name = $request->camp["name"];
        $new_camp->from = $request->camp['from'];
        $new_camp->to = $request->camp['to'];
        $new_camp->total = $request->camp['total'];
        $new_camp->daily_budget = $request->camp['daily_budget'];

        $req_imgs = $request->camp["images"];

        if ($req_imgs != "") {
            foreach ($req_imgs as $key => $req_img) {
                $strpos = strpos($req_img, ';');
                $sub = substr($req_img , 0 , $strpos);
                $ex = explode('/', $sub)[1];
                $name = $key.time().".".$ex;
                $img = Image::make($req_img)->resize(200,200);
                $upload_path = public_path()."/upload/";
                $img->save($upload_path.$name);

                $camp_images[]= $name;
            }
            $new_camp->images= json_encode($camp_images);
        }

        $new_camp->save();
        return $new_camp;
    }

    public function edit($id)
    {
        $edit_camp = Campaign::findOrFail($id);
        return $edit_camp;
    }

    public function update(Request $request , $id)
    {
        $up_camp = Campaign::findOrFail($id);
        if ($up_camp) {
            $up_camp->name = $request->camp["name"];
            $up_camp->from = $request->camp['from'];
            $up_camp->to = $request->camp['to'];
            $up_camp->total = $request->camp['total'];
            $up_camp->daily_budget = $request->camp['daily_budget'];
            // $up_camp->images = $request->camp['images'];
            if ($request->camp['images'] != '') {
                //remove old imgs
                $up_camp_imgs = json_decode($up_camp->images);
                $upload_path = public_path()."/upload/";
                foreach ($up_camp_imgs as $up_camp_img) {
                    if (file_exists($upload_path.$up_camp_img)) {
                        unlink($upload_path.$up_camp_img);
                    }
                }
            }
            $req_imgs = $request->camp['images'];
            foreach ($req_imgs as $key => $req_img) {
                $strpos = strpos($req_img, ';');
                $sub = substr($req_img , 0 , $strpos);
                $ex = explode('/', $sub)[1];
                $name = $key.time().".".$ex;
                $img = Image::make($req_img)->resize(200,200);
                $upload_path = public_path()."/upload/";
                $img->save($upload_path.$name);

                $camp_images[]= $name;
            }
            $up_camp->images= json_encode($camp_images);

            $up_camp->update();
            return $up_camp;
        }
        return 'no Campaign';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del_camp = Campaign::findOrFail($id);
        if ($del_camp) {
            $camp_imgs = json_decode($del_camp->images) ;
            $img_path = public_path()."/upload/";

            foreach ($camp_imgs as $camp_img) {
                if (file_exists($img_path.$camp_img)) {
                    unlink($img_path.$camp_img);
                }
            }
            $del_camp->delete();
            return 'deleted Successfully';
        }
        return 'no Campaigns';
    }
}
