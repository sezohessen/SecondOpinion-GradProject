<?php

namespace App\Http\Controllers\Dashboard;

use file;
use Exception;
use App\Models\City;
use App\Models\Part;
use App\Models\Image;
use App\Models\Seller;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\PartDatatable;
use App\DataTables\SellerDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SellerDatatable $seller)
    {
        $page_title = __("Sellers");
        $page_description =__( "View details");
        return  $seller->render("dashboard.Seller.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PartDatatable $part,Seller $seller)
    {
        $page_title         = __("Seller's Parts");
        $page_description   = __('View details');
        $seller             = Seller::findOrFail($part->request()->seller_id);
        $part->request()->all();
        return  $part->render("dashboard.Seller.show", compact('page_title', 'page_description','seller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        $page_title         = __("Edit Seller");
        $page_description   = __("Edit");
        $governorates       = Governorate::all();

        return view('dashboard.Seller.edit', compact('page_title', 'page_description','seller',
        'governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request,$id)
    {
        // $rules  =  Seller::rules($request);
        // $request->validate($rules);
        // $seller->update(Seller::credentials($request));
        $seller = Seller::find($id);
        $this->validate($request,[
            'desc'                     => 'required|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'bg'                       => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'avatar'                   => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'governorate_id'           => 'required|integer|exists:governorates,id',
            'city_id'                  => 'required|integer|exists:cities,id',
            'lat'                      => 'required',
            'long'                     => 'required',
            'street'                   => 'required|min:5|max:100',
            'facebook'                 => 'nullable',
            'instagram'                => 'nullable',
            'file'                     => 'nullable|max:10000|mimes:doc,dot,docm,docx,dotx,pdf,xlxs,xls,xlsm,xlsb,xltx',

        ]);

        $seller->desc               = $request->desc;
        $seller->desc_ar            = $request->desc_ar;
        $seller->governorate_id     = $request->governorate_id;
        $seller->city_id            = $request->city_id;
        $seller->lat                = $request->lat;
        $seller->long               = $request->long;
        $seller->street             = $request->street;
        $seller->facebook           = $request->facebook;
        $seller->instagram          = $request->instagram;
        // Store file
        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . rand(11111, 99999) . '.' . $extension;
            //Delete Old image
            $path = Storage::putFileAs(
                'files', $request->file, $fileName
            );
            if($file)
            {
                try {
                    $file_old = $seller->file;
                    unlink(storage_path('app\files\\' . $file_old ));

                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }

            }

            $seller->file = $fileName;
        }
        // Store avatar
        if($request->file('avatar')){
        $Image_id = add_Image($request->file('avatar'),$seller->avatar,Seller::avatarBase);
        $seller->avatar = $Image_id;
         }

        // Store background
        if($request->file('bg')){

            $Image_id = add_Image($request->file('bg'),$seller->bg,Seller::backgroundBase);
            $seller->bg = $Image_id;
        }
        $seller->save();

        session()->flash('updated',__("Changes has been Updated successfully"));
        return redirect()->route("dashboard.seller.index");
    }

//    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.seller.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$seller = Seller::find($id);
				$seller->delete();
			}
		} else {
			$seller = Seller::find(request('item'));
			$seller->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.seller.index");
    }
}
