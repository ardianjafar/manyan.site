@extends('admin.layouts.app')

@section('title', 'Tambah Kosakata')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Kosakata Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('educational-words.store') }}">
        @csrf

        <div class="form-group">
            <label for="word_en">English Word</label>
            <input type="text" class="form-control" id="word_en" name="word_en" required value="{{ old('word_en') }}">
        </div>

        <div class="form-group">
            <label for="word_id">Indonesian Translation</label>
            <input type="text" class="form-control" id="word_id" name="word_id" required value="{{ old('word_id') }}">
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="" disabled selected>Pilih jenis kata</option>
                @foreach(['noun', 'verb', 'adjective', 'adverb'] as $t)
                    <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="example_en">Example Sentence (English)</label>
            <textarea class="form-control" id="example_en" name="example_en">{{ old('example_en') }}</textarea>
        </div>

        <div class="form-group">
            <label for="example_id">Contoh Kalimat (Indonesia)</label>
            <textarea class="form-control" id="example_id" name="example_id">{{ old('example_id') }}</textarea>
        </div>

        <div class="form-group">
            <label for="level">Level</label>
            <select class="form-control" id="level" name="level">
                <option value="" disabled selected>Pilih level</option>
                @foreach(['beginner', 'intermediate', 'advanced'] as $l)
                    <option value="{{ $l }}" {{ old('level') == $l ? 'selected' : '' }}>{{ ucfirst($l) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
