@extends('layouts.app')
@section('content')
    <h1>Add Product</h1>
    
    <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
          <input type="text" name="name"  id="form4Example1" class="form-control" />
          <label class="form-label" for="form4Example1">Name</label>
        </div>
        @error('name')
            <div style="color: red">{{$message}}</div>
        @enderror
        <!-- Description input -->
        <div class="form-outline mb-4">
            <textarea class="form-control" name="description" id="form4Example2" rows="4"></textarea>
            <label class="form-label" for="form4Example2">Description</label>
        </div>

        <!-- Image input -->
        <div class="form-outline mb-4">
            <label >Image</label>
            <input type="file" name="image" accept="image/*" onchange="showFile(event)"/>
        </div>
        @error('image')
            <div style="color: red">{{$message}}</div>
        @enderror
        <div>
            <img src="" id="file" class="img-responsive" alt="" />
        </div>

        <!-- Category input -->
        <div class="form-outline mb-4">
            <label >Category</label>
            <select name="category">
                @foreach(json_decode('{"Smartphone":"Smartphone","Smart TV":"Smart TV", "Computer":"Computer"}', true) as $optionKey => $optionValue)
                <option value="{{$optionKey}}">{{$optionValue}}</option>
                @endforeach
            </select>
        </div>
      
        <!-- Inventory input -->
        <div class="form-outline mb-4">
            <label >Inventory</label>
            <input type="text" name="quantity" />
          </div>

        <!-- Price input -->
        <div class="form-outline mb-4">
            <label class="form-label" >Price</label>
            <input type="text" name="price"  />
          </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Send</button>
        <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
      </form>

@endsection

@section('css')
    form {
        max-width: 50%;
    } 
    img {
        max-width: 300px;
    }
@endsection

@section('scripts') 
function showFile(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById('file');
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}
@endsection