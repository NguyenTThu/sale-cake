@extends('master')
@section('content')
<div class="space50">&nbsp;</div>
<div class="container beta-relative">
    <div class="pull-left">
        <h2>Edit</h2>
    </div>
</div>
<div class="space50">&nbsp;</div>

<div class="container">
    <img src="image/product/{{$product->image}}" alt="">
    <form role="form" action="/admin-edit" method="post" enctype="multipart/form-data">
        @csrf
        <div class=form-group>
            <label for="exampleInputEmail">Name</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail" placeholder="Enter name" value="{{$product->name}}">
        </div>
        <div class=form-group>
            <label for="1">Price</label>
            <input type="text" class="form-control" name="unit_price" id="1" placeholder="Enter unit price" value="{{$product->unit_price}}">
        </div>
        <div class=form-group>
            <label for="2">Description</label>
            <input type="text" class="form-control" name="description" id="2" placeholder="Enter description" value="{{$product->description}}">
        </div>
        <div class=form-group>
            <label for="3">Promotion</label>
            <input type="text" class="form-control" name="promotion_price" id="3" value="{{$product->promotion_price}}" placeholder="Enter promotion price">
        </div>
        <div class=form-group>
            <label for="4">Unit</label>
            <input type="text" class="form-control" name="unit" id="4" value="{{$product->unit}}" placeholder="Enter unit">
        </div>
        <div class=form-group>
            <label for="5">New</label>
            <input type="text" class="form-control" name="new" id="5" value="{{$product->new}}" placeholder="Enter new">
        </div>
        <div class=form-group>
            <label for="6">Type</label>
            <input type="text" class="form-control" name="type" id="6" value="{{$product->id_type}}" placeholder="Enter type">
        </div>
        <div class=form-group>
            <label for="exampleFormControlFile1">Image file</label>
            <input type="file" class="form-control" name="image" id="exampleFormControlFile1">
        </div>
        <input type="text" name="id" hidden value="{{$product->id}}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="space50">&nbsp;</div>
@endsection