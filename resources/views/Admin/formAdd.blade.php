@extends('master')
@section('content')
<div class="space50">&nbsp;</div>
<div class="container beta-relative">
    <div class="pull-left">
        <h2>Thêm sản phẩm</h2>
    </div>
</div>
<div class="container">
    <form role="form" action="/adminadd" method="post" enctype="multipart/form-data">
    @csrf
        <div class=form-group>
            <label for="exampleInputEmail">Name</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail" placeholder="Enter name">
        </div>
        <div class=form-group>
            <label for="1">Price</label>
            <input type="text" class="form-control" name="unit_price" id="1" placeholder="Enter unit price">
        </div>
        <div class=form-group>
            <label for="2">Description</label>
            <input type="text" class="form-control" name="description" id="2" placeholder="Enter description">
        </div>
        <div class=form-group>
            <label for="3">Promotion</label>
            <input type="text" class="form-control" name="promotion_price" id="3" placeholder="Enter promotion price">
        </div>
        <div class=form-group>
            <label for="4">Unit</label>
            <input type="text" class="form-control" name="unit" id="4" placeholder="Enter unit">
        </div>
        <div class=form-group>
            <label for="5">New</label>
            <input type="text" class="form-control" name="new" id="5" placeholder="Enter new">
        </div>
        <div class=form-group>
            <label for="6">Type</label>
            <input type="text" class="form-control" name="type" id="6">
        </div>
        <div class=form-group>
            <label for="exampleFormControlFile1">Image file</label>
            <input type="file" class="form-control" name="image" id="exampleFormControlFile1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="space50">&nbsp;</div>
@endsection