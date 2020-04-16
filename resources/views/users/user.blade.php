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
                <div class="row" id="Advertisements"></div>
            </div>
        </div>
    </div>
</div>
@endsection