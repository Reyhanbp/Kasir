@extends('layouts.app')

@section('content')

<div class="card ms-5 me-5">
    <div class="card-header">
        <div class="card-title text w-100 d-flex justify-content-between">
            <h4 class="fw-bold  mb-2">
                <span class=" text-muted fw-light">Category / </span> Edit Category
            </h4>
            <div>
                <a class="btn btn-danger" role="button" href="{{ route ('category') }}">
                    <i class="fas fa-times-circle"></i>
                    Batal
                </a>
            </div>
        </div>
        <hr>
        <form action="{{ route ('update-category', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="name" class="form-label required"> Name : </label>
                            <input type="text" name="name" id="name" placeholder="Name" value="{{ $category -> name }}"
                                class="form-control" required autoComplete="off" />
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <br>
                    <button type="submit" class="btn btn-success btn-sm ms-auto mt-6 d-block">
                        <i class="fas fa-save ms"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </form>


    </div>

</div>
<!-- /.container-fluid -->

</div>

@endsection
