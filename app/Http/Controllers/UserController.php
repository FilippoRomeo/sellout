<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use DB;

use App\StatesModel;
use App\MainCategoryModel;
use App\SubCategoryModel;
use App\AdvertisementModel;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $categories = DB::table('main_category_models')
            ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
            ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
            ->get();
        return view("users.user", ['categories' => $categories]);
    }

    public function fetch(Request $request)
    {
        if ($request->get("states")) {
            $query = $request->get("states");
            $data = DB::table("states_models")
                ->where("stateName", "like", "%" . $query . "%")
                ->get();
            $output = '<ul style="display:block !important;" class="dropdown-menu">';

            if ($data->count() > 0) {
                $i = 0;
                foreach ($data as $row) {
                    $i++;
                    $output .=
                        '<li class="searchState" id="search" name="searchState"
                        style="cursor:pointer;" 
                        value=' . $row->id . '>' . $row->stateName . '</li>' . '<hr>';
                    if ($i >= 7)  break;
                }
                $output .= '</ul>';
                echo $output;
            } else {
                $output .= '<li class="searchState"  name="searchState">Record not found!</li>';
                echo $output;
            }
        }
    }

    public function retrieve(Request $request)
    {
        $data = DB::table("main_category_models")->get();
        $output = '';
        if ($data->count() > 0) {
            foreach ($data as $row) {

                $output .=

                    '<option value=' . $row->id . '
                    style="cursor:pointer;" >' . $row->mainCategory . '</option>';
            }
            $output .= '';
            echo $output;
        }
    }

    public function postad(Request $request)
    {
        $categories = DB::table('main_category_models')
            ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
            ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
            ->get();
        return view("users.postad", ['categories' => $categories]);
    }

    public function categories(Request $request, $mainCategory, $id)
    {
        if ($id == 2) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            //get subcategory dropdown content
            $subCategoriesController = DB::table('main_category_models')
                ->select('*')
                ->join('sub_category_models', 'sub_category_models.mainCategoryId', '=', 'main_category_models.id')
                ->where(['main_category_models.id' => $id])
                ->get();
            //get state content
            $statesController = StatesModel::all();
            return view('users.publishPost.carsBikesAd', ['categories' => $categories, 'subCategoriesController' => $subCategoriesController, 'statesController' => $statesController]);
        } elseif ($id == 3) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            //get subcategory dropdown content
            $subCategoriesController = DB::table('main_category_models')
                ->select('*')
                ->join('sub_category_models', 'sub_category_models.mainCategoryId', '=', 'main_category_models.id')
                ->where(['main_category_models.id' => $id])
                ->get();
            //get state content
            $statesController = StatesModel::all();
            return view('users.publishPost.mobileTabletsAd', ['categories' => $categories, 'subCategoriesController' => $subCategoriesController, 'statesController' => $statesController]);
        } elseif ($id == 4) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            //get subcategory dropdown content
            $subCategoriesController = DB::table('main_category_models')
                ->select('*')
                ->join('sub_category_models', 'sub_category_models.mainCategoryId', '=', 'main_category_models.id')
                ->where(['main_category_models.id' => $id])
                ->get();
            //get state content
            $statesController = StatesModel::all();
            return view('users.publishPost.electronicsAppliancesAd', ['categories' => $categories, 'subCategoriesController' => $subCategoriesController, 'statesController' => $statesController]);
        } elseif ($id == 5) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            //get subcategory dropdown content
            $subCategoriesController = DB::table('main_category_models')
                ->select('*')
                ->join('sub_category_models', 'sub_category_models.mainCategoryId', '=', 'main_category_models.id')
                ->where(['main_category_models.id' => $id])
                ->get();
            //get state content
            $statesController = StatesModel::all();
            return view('users.publishPost.realEstateAd', ['categories' => $categories, 'subCategoriesController' => $subCategoriesController, 'statesController' => $statesController]);
        } elseif ($id == 6) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            //get subcategory dropdown content
            $subCategoriesController = DB::table('main_category_models')
                ->select('*')
                ->join('sub_category_models', 'sub_category_models.mainCategoryId', '=', 'main_category_models.id')
                ->where(['main_category_models.id' => $id])
                ->get();
            //get state content
            $statesController = StatesModel::all();
            return view('users.publishPost.servicesAd', ['categories' => $categories, 'subCategoriesController' => $subCategoriesController, 'statesController' => $statesController]);
        };
    }

    public function addPost(Request $request)
    {
        $this->validate($request, [
            'subCategoryId' =>  ['required'],
            'productName' =>  ['required'],
            'purchaseYear' =>  ['required'],
            'expSellPrice' =>  ['required'],
            'name' =>  ['required'],
            'mobile' => ['required'],
            'email' =>  ['required'],
            'state' =>  ['required'],
            'city' =>  ['required'],
            'photos.*' => [
                'required',
                'max:2048',
                'mimes:jpg,jpeg,png,gif'
            ],
            'description' => ['required']
        ]);

        $ads = new AdvertisementModel;
        $images = $request->file('photos');
        $count = 0;
        if ($request->file('photos')) {
            foreach ($images as $item) {
                if ($count <= 4) {
                    $var = date_create();
                    $date = date_format($var, 'Ymd');

                    $escapedName = preg_replace("([^a-z0-9]+[^a-z0-9^]*\.?)", '_', $item->getClientOriginalName());

                    $imageName = $date . '_' . $escapedName . '.jpg';
                    $item->move(public_path() . '/uploads/', $imageName);
                    $url = URL::to("/") . '/uploads/' . $imageName;
                    $arr[] = $url;
                    $count++;
                }
            }
            $image = implode(",", $arr);
            $ads->user_id = Auth::id();
            $ads->mainCategoryId = $request->input('mainCategoryId');
            $ads->subCategoryId = $request->input('subCategoryId');
            $ads->productName = $request->input('productName');
            $ads->purchaseYear = $request->input('purchaseYear');
            $ads->expSellPrice = $request->input('expSellPrice');
            $ads->name = $request->input('name');
            $ads->mobile = $request->input('mobile');
            $ads->email = $request->input('email');
            $ads->state = $request->input('state');
            $ads->city = $request->input('city');
            $ads->description = $request->input('description');
            $ads->photos = $image;

            $ads->save();
            return redirect('/')->with('info', 'Post added successfully');
        }
    }

    public function getAds()
    {
        $ads = DB::table("advertisement_models")->get();
        $output = '';
        if (count($ads) == 0) {
            $output .= '<p>Not Found</p>';
            echo $output;
        } else {
            foreach ($ads as $row) {
                $output .= '
                <div class="col-md-3" style="margin:0rem;">
                    <div class="card" style="text-align:center; margin:1rem width: 20rem;">
                        <img src=' . strtok($row->photos, ',') . ' style="  width: 100%; height: 180px;"/>
                        <div class="card-header" style="border:1px solid #ccc !important;">
                            <h4 class="card-title"><b>' . $row->productName . '</b></h4>
                        </div>
                        <div class="card-body" style="border:1px solid #ccc !important;"> 
                            <p class="card-text"><b>£' . $row->expSellPrice . '</b></p>
                            <p class="card-text"><b>' . $row->city . '</b></p>
                            <div class="card border-secondary" style="max-width: 10rem; border:1px solid #ccc !important; margin:auto; padding:0.4rem;">
                                <a class="card-link" href=' . $_SERVER['HTTP_REFERER'] . 'product/view/' . $row->id . '>
                                    <b>View</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
            };

            $output .= '';
            echo $output;
        }
    }

    public function viewAds(Request $request, $mainCategory, $id)
    {
        //   $data = array(
        //       'mainCategory' => $mainCategory,
        //       'id' => $id
        //   );
        //   echo '<pre>';
        //   print_r($data);

        if ($id == 2) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            $carsBike = DB::table('advertisement_models')
                ->where(['mainCategoryId' => $id])
                ->get();
            return view('users.categories.carsBikesAd', ['categories' => $categories, 'carsBike' => $carsBike]);
        } elseif ($id == 3) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            $mobileTablets = DB::table('advertisement_models')
                ->where(['mainCategoryId' => $id])
                ->get();
            return view('users.categories.mobileTabletsAd', ['categories' => $categories, 'mobileTablets' => $mobileTablets]);
        } elseif ($id == 4) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            $electronicsAppliance = DB::table('advertisement_models')
                ->where(['mainCategoryId' => $id])
                ->get();
            return view('users.categories.electronicsAppliancesAd', ['categories' => $categories, 'electronicsAppliance' => $electronicsAppliance]);
        } elseif ($id == 5) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            $realEstate = DB::table('advertisement_models')
                ->where(['mainCategoryId' => $id])
                ->get();
            return view('users.categories.RealEstateAd', ['categories' => $categories, 'realEstate' => $realEstate]);
        } elseif ($id == 6) {
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            $service = DB::table('advertisement_models')
                ->where(['mainCategoryId' => $id])
                ->get();
            return view('users.categories.ServicesAd', ['categories' => $categories, 'service' => $service]);
        };
    }

    public function searchProduct(Request $request)
    {
        if ($request->get('searchonproduct')) {
            $query = $request->get('searchonproduct');
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            $data = DB::table('advertisement_models')
                ->where('productName', 'like', '%' . $query . '%')
                ->get();
            return view('users.categories.searchonproduct', ['categories' => $categories, 'data' => $data]);
        } else {
            echo "No input in your query, please try again!";
        }
    }

    public function searchAdvertisement(Request $request)
    {
        if ($request->get('state') && $request->get('categories')) {
            $state = $request->get('state');
            $mainCategoryId = $request->get('categories');
            $data = DB::table('advertisement_models')
                ->where(['state' => $state, 'mainCategoryId' => $mainCategoryId])
                ->get();
            $categories = DB::table('main_category_models')
                ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
                ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
                ->get();
            return view('users.categories.searchonlocationcategories', ['categories' => $categories, 'data' => $data]);
        } else {
            echo "No input in your query, please try again!";
        }
    }

    public function viewProduct(Request $request, $id)
    {
        $categories = DB::table('main_category_models')
            ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
            ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
            ->get();
        $product = DB::table('advertisement_models')
            ->where(['id' => $id])
            ->get();
        return view('users.productView', ['categories' => $categories, 'product' => $product]);
    }

    //edit profile
    public function profile()
    {
        return view('profile.profile');
    }

    //show users post
    public function myAds()
    {
        $categories = DB::table('main_category_models')
            ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
            ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
            ->get();
        $product = DB::table('advertisement_models')
            ->select('*')
            ->where(['advertisement_models.user_id' => Auth::id()])
            ->get();
        return view("myAds.myAds", ['categories' => $categories, 'product' => $product]);
    }

    //edit post
    public function edit($id)
    {
        $product = DB::table('advertisement_models')
            ->where(['id' => $id])
            ->get();
        $categories = DB::table('main_category_models')
            ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
            ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
            ->get();

        $categories = DB::table('main_category_models')
            ->select('main_category_models.id', 'main_category_models.mainCategory', 'icons_models.icons')
            ->join('icons_models', 'icons_models.id', '=', 'main_category_models.id')
            ->get();
        //get subcategory dropdown content
        $subCategoriesController = DB::table('main_category_models')
            ->select('*')
            ->join('sub_category_models', 'sub_category_models.mainCategoryId', '=', 'main_category_models.id')
            ->where(['main_category_models.id' => $id])
            ->get();

        return view('users.managePost.editPost', ['categories' => $categories, 'product' => $product, 'categories' => $categories, 'subCategoriesController' => $subCategoriesController]);
    }

    public function update(Request $request, $id)
    {

        $ads = AdvertisementModel::find($id);
        $images = $request->file('photos');
        $count = 0;

        if ($request->file('photos')) {
            foreach ($images as $item) {
                if ($count <= 4) {
                    $var = date_create();
                    $date = date_format($var, 'Ymd');

                    $escapedName = preg_replace("([^a-z0-9]+[^a-z0-9^]*\.?)", '_', $item->getClientOriginalName());

                    $imageName = $date . '_' . $escapedName . '.jpg';
                    $item->move(public_path() . '/uploads/', $imageName);
                    $url = URL::to("/") . '/uploads/' . $imageName;
                    $arr[] = $url;
                    $count++;
                }
            }
            $image = implode(",", $arr);
        } else {
            $image = $ads->photos;
        }


        $ads->user_id = Auth::id();
        if ($request->mainCategoryId == null) {
            $ads->mainCategoryId = $ads->mainCategoryId;
        } else {
            $ads->mainCategoryId = $request->get('mainCategoryId');
        }
        if ($request->subCategoryId == null) {
            $ads->subCategoryId = $ads->subCategoryId;
        } else {
            $ads->subCategoryId = $request->get('subCategoryId');
        }
        $ads->productName = $request->get('productName');
        $ads->purchaseYear = $request->get('purchaseYear');
        $ads->expSellPrice = $request->get('expSellPrice');
        $ads->name = $request->get('name');
        $ads->mobile = $request->get('mobile');
        $ads->email = $request->get('email');
        if ($request->state == null) {
            $ads->state = $ads->state;
        } else {
            $ads->state = $request->get('state');
        }
        $ads->city = $request->get('city');
        $ads->description = $request->get('description');
        $ads->photos = $image;

        $ads->save();
        return redirect('/')->with('info', 'Post added successfully');
    }

    //delete post
    public function delete($id)
    {
        AdvertisementModel::where('id', $id)
            ->delete();
        return redirect('/')->with('info', 'Post deleted successfully');
    }
}
