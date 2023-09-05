@extends('layouts.app')
@section('content')
    <h1>Product List</h1>
    @if(session('success'))
        <div>{{session('success')}}</div>
    @endif
    <form method="GET" action="{{route('products.index')}}" class="input-group search m-4">
        <div class="form-outline">
          <input type="search" name="search" id="form1" class="form-control" value="{{request('search')}}" />
          <label class="form-label" for="form1">Search</label>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-search"></i>
        </button>
    </form>
    <div class="container">
        <a href="{{route('products.create')}}" class="btn btn-primary">Add Product</a>
        <table class="table table-striped">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Inventory</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            @if(count($products) > 0)
                @foreach($products as $product)
                <tr>
                    <td> <img src="{{asset('images/'.$product->image)}}" /> </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary">Edit</a>
                        <form method="post" action="{{route('products.destroy', $product->id)}}" >
                            @method("DELETE")
                            @csrf
                            <button class="btn btn-danger" type="submit" name="delete" onclick="Confirm()">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            @else <div>Không có sản phẩm nào</div>
            @endif
    
        </table>
    </div>
@endsection

@section('css')
    h1 {
        color: red;
    }

    .search {
        width: 30%;
    }
    img {
        max-width: 100px;
    }
@endsection

@section('scripts')
    
@endsection