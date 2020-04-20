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
                            <a href='{{url("/viewAds/".preg_replace("/\s+/","",$category->mainCategory)."/".$category->id)}}'>
                                {!!html_entity_decode($category->icons)!!}{{$category->mainCategory}}
                            </a>
                        </li>
                        @endforeach

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
                        Edit info
                    </strong>
                </div>
                @if(isset($product))
                @if(count($product)>0)
                @foreach($product as $ad)

                <?php
                $img = [];
                $img = explode(",", $ad->photos);
                $imgs = $ad->photos;
                if (auth()->user()) {
                    $user = auth()->user();
                    $adid=$ad->user_id;
                    $uid=$user->id;
                } else {

                    $adid=null;
                    $uid=null;

                }

                ?>
                @if(Gate::check('isAdmin') || Gate::check('update-post', $adid, $uid))
                <form method="POST" action="{{$ad->id}}" class="card-body" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row featured" id="featured-image">
                                <img src="{{$img[0]}}" alt="" width="100%" height="300rem" style="margin: 0.5rem;" id="changeMe" />
                                <p>
                                    @if(isset($img[0]))
                                    <img src="{{$img[0]}}" alt="" width="100px" height="100px" style="margin: 0.5rem;" class="preview" />
                                    @endif
                                    @if(isset($img[1]))
                                    <img src="{{$img[1]}}" alt="" width="100px" height="100px" style="margin: 0.5rem;" class="preview" />
                                    @endif
                                    @if(isset($img[2]))
                                    <img src="{{$img[2]}}" alt="" width="100px" height="100px" style="margin: 0.5rem;" class="preview" />
                                    @endif
                                    @if(isset($img[3]))
                                    <img src="{{$img[3]}}" alt="" width="100px" height="100px" style="margin: 0.5rem;" class="preview" />
                                    @endif
                                </p>
                            </div>
                            <div class="card col-lg-12">
                                <div class="form-group">
                                    <label><b>Photos, select up to three pictures</b></label>
                                    <input class="form-control" type="file" name="photos[]" multiple="true" />
                                </div>
                            </div>
                            <label style="padding:23px;"></label>

                            <div class="card wb-3" style="border-style: hidden;">
                                <div class="btn-group" role="group" aria-label="Basic example" style="text-align: center; margin:auto !important;">
                                    <button class="btn btn-success list-inline-item" type="submit">✔️Update</button>
                                    <button class="btn btn-danger list-inline-item" type="reset">❌Reset</button>
                                    <a class="btn btn-primary list-inline-item" type="button" href="{{ URL::previous() }}">🔙Back</a>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-6">
                            <div class="card border-secondary wb-3" style="margin: 0.5rem 2rem; max-width: 20rem; border:1px solid #ccc !important;">
                                <div class="card-header" style="text-align: center;"><b>Product Details</b></div>
                                <div class="card-body">
                                    <h6><b>Name:</b>
                                        <input title="xtra large" value="{{$ad->productName}}" name="productName" type="text" style="width: 90%; margin:0.1rem" />
                                    </h6>
                                    <hr>
                                    <h6><b>Year purchased:</b>
                                        <input title="xtra large" value="{{$ad->purchaseYear}}" name="purchaseYear" type="number" style="width: 90%; margin:0.1rem" />
                                    </h6>
                                    <hr>
                                    <h6><b>Price:</b>
                                        <input title="xtra large" value="{{$ad->expSellPrice}}" name="expSellPrice" type="number" style="width: 90%; margin:0.1rem" />
                                    </h6>
                                </div>
                            </div>
                            <div class="card border-secondary wb-3" style="margin: 0.5rem 2rem; max-width: 20rem; border:1px solid #ccc !important;">
                                <div class="card-header" style="text-align: center;"><b>Seller Details</b></div>
                                <div class="card-body">
                                    <h6><b>Name:</b>
                                        <input title="xtra large" value="{{$ad->name}}" name="name" type="text" style="width: 90%; margin:0.1rem" />
                                    </h6>
                                    <hr>
                                    <h6><b>Mobile:</b>
                                        <input title="xtra large" value="{{$ad->mobile}}" name="mobile" type="number" style="width: 90%; margin:0.1rem" />
                                    </h6>
                                    <hr>
                                    <h6><b>Email:</b>
                                        <input title="xtra large" value="{{$ad->email}}" name="email" type="email" style="width: 90%; margin:0.1rem" />
                                    </h6>
                                    <hr>
                                    <h6><b>City:</b>
                                        <input title="xtra large" value="{{$ad->city}}" name="city" type="text" style="width: 90%; margin:0.1rem" />
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card border-secondary col-md-12" style="border:1px solid #ccc !important; max-width: 89%; margin: auto; padding: 0%;">
                            <div class="card-header" style="text-align: center; "><b>Description:</b></div>
                            <div class="card-body">
                                <textarea title="xtra large" rows="4" cols="92" name="description">{{$ad->description}}</textarea>
                            </div>
                        </div>
                    </div>

                </form>

                @else
                <div class="row">
                    <div class="col-lg-6">
                        <p style="margin: 5% !important">The items that you selected is not found, or you might don't have permission.</p>
                    </div>
                </div>
                @endif

                @endforeach


                @endif
                @endif

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script>
    $(".preview").on('click', function() {
        $('#changeMe').prop('src', this.src)
    });
</script>
@endsection