@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Categories
                    </strong>
                </div>
                <div class="card-body cardcategories">
                    <ul class="userpgcategory fa-ul">
                        @if(isset($categories))
                        @if(count($categories)>0)
                        @foreach($categories as $category)
                        <li>
                            <a href='{{url("/post-classified-ads/".preg_replace("/\s+/","",$category->mainCategory)."/".$category->id)}}'>
                                {!!html_entity_decode($category->icons)!!}{{$category->mainCategory}}
                            </a>
                        </li>
                        @endforeach
                        @else

                        @endif
                        @endif

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Post
                    </strong>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-link">
                            <a class="nav-link" data-togle="tab" href="#home">Cars & Bikes</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="" id="home">
                            <h1 style="padding: 10px 10px;" id="selcatmsg"></h1>
                            <form class="form-horizontal" enctype="multipart/form-data" method="POST" style="padding-left: 20px;" action="{{ url('/addPost')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="hidden" name="mainCategoryId" value="{{Request::segment(3)}}" />
                                                <label><b>Select Subcategory</b></label>
                                                <select class="form-control" name="subCategoryId">
                                                    <option value="">Select</option>
                                                    @if(count($subCategoriesController)>0)
                                                    @foreach($subCategoriesController as $subcategory))
                                                    <option value="{{$subcategory->id}}">{{$subcategory->subCategory}}</option>
                                                    @endforeach
                                                    @else
                                                    @endif
                                                </select>

                                                @error('subCategoryId')
                                                <div class="error alert alert-danger">
                                                    {{ "The subcategory field is required." }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><b>Post Name</b></label>
                                                <input class="form-control" type="text" name="productName" placeholder="Post Name" require />
                                                @error('productName')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>
                                                    <b>Year of Purchase</b>
                                                </label>
                                                <input class="form-control" type="number" name="purchaseYear" placeholder="Year of Purchase" require />
                                                @error('purchaseYear')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding: 23px;"></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>
                                                    <b>Expected Selling Price</b>
                                                </label>
                                                <input class="form-control" type="number" name="expSellPrice" placeholder="Expected Selling Price" require />
                                                @error('expSellPrice')
                                                <div class="error alert alert-danger">
                                                    {{ "The price field is required." }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding:23px;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><b>Your Name</b></label>
                                                <input class="form-control" type="text" name="name" placeholder="Your Name" require />
                                                @error('name')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding: 23px;"></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><b>Your mobile</b></label>
                                                <input class="form-control" type="number" name="mobile" placeholder="Your mobile" require />
                                                @error('mobile')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding:23px;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><b>Your Email</b></label>
                                                <input class="form-control" type="text" name="email" placeholder="Your Email" require />
                                                @error('email')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding: 23px;"></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="hidden" name="state" value="{{Request::segment(3)}}">
                                                <label><b>Area or council</b></label>
                                                <select class="form-control" name="state" require>
                                                    <option value="">Select</option>
                                                    @if(count($statesController)>0)
                                                    @foreach($statesController as $state))
                                                    <option value={{$state->stateName}}>{{$state->stateName}}</option>
                                                    @endforeach
                                                    @else
                                                    @endif
                                                </select>
                                                @error('state')
                                                <div class="error alert alert-danger">
                                                    {{ "The council field is required." }}
                                                </div>
                                                @enderror

                                            </div>
                                        </div>
                                        <label style="padding:23px;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><b>City</b></label>
                                                <input class="form-control" type="text" name="city" placeholder="City" require />
                                                @error('city')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding: 23px;"></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><b>Photos of your vehicle, select up to four pictures</b></label>
                                                <input class="form-control" type="file" name="photos[]" multiple="true" />
                                                @error('photos')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding:23px;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>
                                                    <b>Description</b>
                                                </label>
                                                <textarea class="form-control" type="text" name="description" placeholder="Description" rows="4" cols="50" require></textarea>
                                                @error('description')
                                                <div class="error alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label style="padding: 23px;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="text-align: center;">
                                            <button type="submit" class="btn btn-primary">Post your ad</button>
                                            <button id="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection