@extends('layouts.master')
@section('title', 'Slider')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                    <div>
                        <label class="main-content-label mb-2">List Slider</label>
                    </div>
                    <div class="ml-auto">
                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('slider.create') }}">Add Image</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead class="thead-dark">
                            <tr>
                                <th class="wd-15p">Image</th>
                                {{-- <th class="wd-20p">Filename</th> --}}
                                <th class="wd-15p">Type</th>
                                <th class="wd-10p">Row</th>
                                <th class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slider as $data)
                                <tr>
                                    <td class="text-center">
                                        <!--<img src="{{ Storage::url($data->image) }}" alt="..." class="img-fluid w-50">-->
                                        <img src="{{ asset($data->image) }}" alt="..." class="img-fluid w-50">
                                    </td>
                                    {{-- <td>{{ $data->name }}</td> --}}
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->row }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('slider.edit', $data->id) }}">Edit</a>
                                        <form action="{{ route('slider.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal effects -->
                    {{-- <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Slider Data</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body tx-center pd-y-20 pd-x-20">
                                    <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                                    <i class="fas fa-exclamation-triangle tx-100 tx-warning lh-1 mg-t-20 d-inline-block"></i>
                                    <h4 class="tx-warning tx-semibold mg-b-20">Warning</h4>
                                    <p class="mg-b-20 mg-x-20">Are you sure want to delete this slider data?</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="button">Delete</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- End Modal effects-->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- {!! $slider->links() !!} --}}
@endsection
