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
                    @if(session('info'))
                    <div class="alert alert-success" style="margin-top: 5px;">
                        {{session('info')}}
                    </div>
                    @endif
                </div>
                <div class="row" id="Advertisements">
                <div class="container">
                        <div class="row">
                            @if(count($product)>0)
                            @foreach($product as $row)
                            <div class="col-md-3">
                                <div class="productCard" style="text-align:center; margin:1rem width: 20rem;">
                                    <img src=<?php echo strtok($row->photos, ',') ?> style=" width:100%; height:182px;" />
                                    <div class="card-header" style="border:1px solid #ccc !important;">
                                        <h4 style="margin-bottom: 0px; text-align:center;">{{$row->productName}}</h4>
                                    </div>

                                    <div class="card-body" style="border:1px solid #ccc !important;">
                                        <h4 style="margin-bottom: 0px; text-align:center;">£{{$row->expSellPrice}}</h4>
                                        <h4 style="margin-bottom: 0px; text-align:center;">{{$row->city}}</h4>
                                        <div class="card border-secondary" style="max-width: 10rem; border:1px solid #ccc !important; margin:auto; padding:0.4rem;">
                                            <p style="margin-bottom: 0px; text-align:center;">
                                                <a href='{{url("/product/view/{$row->id}")}}' {{$row->productName}}>View</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p>No element for this category...</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection