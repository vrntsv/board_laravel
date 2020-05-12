<?php

namespace App\Http\Controllers;
use App\Ads;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function renderAllAds()
    {
        $ad = new Ads();
        $allAds = $ad->getAllAds();
        return view('advertisementList', [
            'data' => $allAds,
            'current_page' => $allAds->currentPage(),
            'last_page' => $allAds->lastPage()
        ]);
    }

    public function renderAdCreationForm()
    {
        return view('createAdvertisement');
    }

    public function renderAdUpdateForm($id)
    {
        $AdvertisementModel = new Ads();
        $ad =  $AdvertisementModel->getAdById($id);
        if (auth()->user()->id == $ad[0]->user_id) {
            return view('updateAdvertisement', ['ad' => $ad]);
        } else {
            return redirect('/');
        }
    }


    public static function renderAdById($id)
    {
        $AdvertisementModel = new Ads();
        $ad =  $AdvertisementModel->getAdById($id);
        return view('advertisementInfo', ['ad' => $ad]);
    }


    public function submitAdForm(Request $request, $updateId=null)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'phone' => 'required',
            'email' => 'required|email',
            'end_date' => 'required|date_format:Y-m-d|after:today',
            'description' => 'required'
        ]);

        if (array_key_exists('saved_image', $_POST) and !array_key_exists('delete_image', $_POST)){
            $uploadFileName = $request->input('saved_image');
        } else {
            $uploadFileName = null;
        }
        if ($request->file('image')) {
            $file = $request->file('image');
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/storage/images/';
            $uploadFileName = $file->getClientOriginalName();
            $file->move($uploadDir, $uploadFileName);

        }

        $AdvertisementModel = new Ads();
        if ($request->input('addLocation') == 'False') {
            $latitude = null;
            $longitude = null;

        } else {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
        }
        if ($updateId){
            $AdvertisementModel->updateAd(
                $request->input('ad_id'),
                $request->input('title'),
                $request->input('description'),
                $request->input('phone'),
                $request->input('country'),
                $request->input('email'),
                $request->input('end_date'),
                $uploadFileName,
                $latitude,
                $longitude
            );
        } else {
            $AdvertisementModel->createAd(
                $request->input('user_id'),
                $request->input('title'),
                $request->input('description'),
                $request->input('phone'),
                $request->input('country'),
                $request->input('email'),
                $request->input('end_date'),
                $uploadFileName,
                $latitude,
                $longitude
            );
        }
        return redirect('/posts');
    }
}
