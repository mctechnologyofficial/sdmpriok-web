@extends('layouts.master')
@section('title', 'Competency Tools')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="d-flex flex-row-reverse">
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Kompetensi
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Sistem Proteksi Turbin</a>
                                        <a class="dropdown-item" href="#">Sistem Proteksi HRSG</a>
                                        <a class="dropdown-item" href="#">Generator</a>
                                        <a class="dropdown-item" href="#">Transformator</a>
                                        <a class="dropdown-item" href="#">Sistem Interlock</a>
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
