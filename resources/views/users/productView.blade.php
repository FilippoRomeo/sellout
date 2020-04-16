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
                        Posts
                    </strong>
                </div>
                <div class="card-body">
                    @if(isset($product))
                    @if(count($product)>0)
                    @foreach($product as $ad)
                    <?php
                    $img = [];
                    $img = explode(",", $ad->photos);
                    $user = auth()->user();
                    ?>
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
                            <div class="card wb-3" style="border-style: hidden;">
                                <?php
                                if (auth()->user()) {
                                    $user = auth()->user();
                                    $adid = $ad->user_id;
                                    $uid = $user->id;
                                } else {
                                    $adid = null;
                                    $uid = null;
                                }
                                ?>
                                @if(Gate::check('isAdmin') || Gate::check('update-post', $adid, $uid))
                                <div class="btn-group" role="group" aria-label="Basic example" style="text-align: center; margin:auto !important;">
                                    <a class="btn btn-success list-inline-item" href='{{url("product/edit/{$ad->id}")}}'>✏️Edit</a>
                                    <button class="btn btn-danger list-inline-item" data-target="#delete" data-toggle="modal">🗑️Delete</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border-secondary wb-3" style="margin: 0.5rem 2rem; max-width: 20rem; border:1px solid #ccc !important;">
                                <div class="card-header" style="text-align: center;"><b>Product Details</b></div>
                                <div class="card-body">
                                    <h6><b>Name:</b>
                                        <span title="xtra large"> {{$ad->productName}}</span>
                                    </h6>
                                    <hr>
                                    <h6><b>Year purchased:</b>
                                        <span title="xtra large"> {{$ad->purchaseYear}}</span>
                                    </h6>
                                    <hr>
                                    <h6><b>Price:</b>
                                        <span title="xtra large"> {{$ad->expSellPrice}}</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="card border-secondary wb-3" style="margin: 0.5rem 2rem; max-width: 20rem; border:1px solid #ccc !important;">
                                <div class="card-header" style="text-align: center;"><b>Seller Details</b></div>
                                <div class="card-body">
                                    <h6><b>Name:</b>
                                        <span title="xtra large"> {{$ad->name}}</span>
                                    </h6>
                                    <hr>
                                    <h6><b>Mobile:</b>
                                        <span title="xtra large"> {{$ad->mobile}}</span>
                                    </h6>
                                    <hr>
                                    <h6><b>Email:</b>
                                        <span title="xtra large"> {{$ad->email}}</span>
                                    </h6>
                                    <hr>
                                    <h6><b>City:</b>
                                        <span title="xtra large"> {{$ad->city}}</span>
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card border-secondary col-md-12" style="border:1px solid #ccc !important; max-width: 89%; margin: auto; padding: 0%;">
                            <div class="card-header" style="text-align: center; "><b>Description:</b></div>
                            <div class="card-body">
                                <span title="xtra large"> {{$ad->description}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Not found</p>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModellabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h3 class="modal-title" id="exampleModalLabel"><b>Delete Post</b></h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <form action='{{url("/product/delete/{$ad->id}")}}' method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h4>
                        Are you sure you want to delete this?
                    </h4>
                    <input type="hidden" name="category_id" id="cat_id" value="" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Yes, delete</button>
                    <button class="btn btn-success" type="button" data-dismiss="modal">No, cancel</button>
                </div>
            </form>
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