@extends('admin.layouts.app')

@section('title', 'Edit Kosakata')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Kosakata</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vocabs.update', $words->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_id">Category Word</label>
            <select name="category_id" id="category_id" class="form-control" required>
            <option value="" disabled selected>Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $category->id) == $category->id ? 'selected' : '' }}>
                {{ $category->title }}
            </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="word_en">English Word</label>
            <input type="text" class="form-control" id="word_en" name="word_en" required value="{{ old('word_en', $words->word_en) }}">
        </div>

        <div class="form-group">
            <label for="word_id">Indonesian Translation</label>
            <input type="text" class="form-control" id="word_id" name="word_id" required value="{{ old('word_id', $words->word_id) }}">
        </div>

        <div class="row">
            {{-- Type --}}
            <div class="col-md-6 form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="" disabled selected>Pilih jenis kata</option>
                    @foreach(['noun', 'verb', 'adjective', 'adverb'] as $t)
                        <option value="{{ $t }}" 
                            {{ old('type', isset($words) ? $words->type : '') == $t ? 'selected' : '' }}>
                            {{ ucfirst($t) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Level --}}
            <div class="col-md-6 form-group">
                <label for="level">Level</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="" disabled selected>Pilih level</option>
                    @foreach(['beginner', 'intermediate', 'advanced'] as $l)
                        <option value="{{ $l }}" 
                            {{ old('level', isset($words) ? $words->level : '') == $l ? 'selected' : '' }}>
                            {{ ucfirst($l) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="example_en">Example Sentence (English)</label>
            <textarea class="form-control" id="example_en" name="example_en">{{ old('example_en', $words->example_en) }}</textarea>
        </div>

        <div class="form-group">
            <label for="example_id">Contoh Kalimat (Indonesia)</label>
            <textarea class="form-control" id="example_id" name="example_id">{{ old('example_id', $words->example_id) }}</textarea>
        </div>

        

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
