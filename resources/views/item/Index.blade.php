@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Data Item
                </div>
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>{{Session::get('message')}}!</strong></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Category</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Stock</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$item -> category -> name }}</td>
                                    <td>{{$item -> name }}</td>
                                    <td>RP.{{$item -> price }}</td>
                                    <td>{{$item -> stock }}</td>

                                    <td class="text-center align-middle">
                                        <form action="{{ route ('delete-item', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning" role="button"
                                                href="{{ route ('edit-item', $item->id) }}">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <button id="deleteButton" class="btn btn-danger" role="button">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="mb-4">
                            {{$data->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Tambah item
                </div>
                <div class="card-body">
                    <form action="{{route('Send-item')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                 <div class="col-12">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label required"> User Group : </label>
                                        <select
                                        class="form-control"
                                        name="category_id"
                                        placeholder="Pilih category_id"
                                        id="category_id"
                                        required
                                        >

                                        <option value="">Pilih</option>
                                        @foreach ($category as $Category)
                                        <option value="{{$Category -> id}}">{{$Category -> name}}</option>
                                        @endforeach

                                        </select>
                                    </div>
                                    </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label required"> Name : </label>
                                        <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                            required autoComplete="off" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label required"> Price : </label>
                                        <input type="number" name="price" id="name" placeholder="Price" class="form-control"
                                            required autoComplete="off" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="stock" class="form-label required"> Stock : </label>
                                        <input type="number" name="stock" id="name" placeholder="Stock" class="form-control"
                                            required autoComplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success ">
                                    <i class="fas fa-save"></i>
                                    Simpan
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    <i class="fas fa-save"></i>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
