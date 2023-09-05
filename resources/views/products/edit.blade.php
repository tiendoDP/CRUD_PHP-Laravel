@extends('layouts.app')
@section('content')
    <h1>Edit Product</h1>
    
    <form method="post" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Name input -->
        <div class="form-outline mb-4">
          <input type="text" name="name" id="form4Example1" class="form-control" value="{{ $product->name}}" />
          <label class="form-label" for="form4Example1">Name</label>
        </div>
        <input type="hidden" name="hidden_id" value={{$product->id}}/>
        @error('name')
            <div style="color: red">{{$message}}</div>
        @enderror
        <!-- Description input -->
        <div class="form-outline mb-4">
            <textarea class="form-control" name="description" id="form4Example2" rows="4" value="{{ $product->description}}">{{ $product->description}}</textarea>
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
            <img src="{{asset('images/'.$product->image)}}" id="file" class="img-responsive" alt="" />
            <input type="hidden" name="hidden_product_image" value="{{$product->image}}"/>
        </div>

        <!-- Category input -->
        <div class="form-outline mb-4">
            <label >Category</label>
            <select name="category">
                @foreach(json_decode('{"Smartphone":"Smartphone","Smart TV":"Smart TV", "Computer":"Computer"}', true) as $optionKey => $optionValue)
                <option value="{{$optionKey}}" {{isset($product->category) && $product->category == $optionKey ? 'selected':''}}>{{$optionValue}}</option>
                @endforeach
            </select>
        </div>
      
        <!-- Inventory input -->
        <div class="form-outline mb-4">
            <label >Inventory</label>
            <input type="text" name="quantity" value="{{ $product->quantity}}" />
          </div>

        <!-- Price input -->
        <div class="form-outline mb-4">
            <label class="form-label" >Price</label>
            <input type="text" name="price" value="{{ $product->price}}" />
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