<!-- resources/views/upload.blade.php -->

@extends('layouts.app')

@section('title', 'Upload File')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Upload File</h1>
        </div>

        <div class="section-body">
            <form action="{{ route('upload.files') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="number" name="user_id" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="files">Select Images</label>
                    <input type="file" name="files[]" class="form-control" multiple required>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </section>
</div>
@endsection
