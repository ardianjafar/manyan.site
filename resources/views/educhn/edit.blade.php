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

    <form method="POST" action="{{ route('vocabs-chn.update', $item->id) }}">
        @csrf
        @method('PUT')
        </div>
        <div class="form-group">
            <label for="hanzi">Chinese Word</label>
            <input type="text" class="form-control" id="hanzi" name="hanzi" required value="{{ old('hanzi', $item->hanzi) }}">
        </div>
        <div class="form-group">
            <label for="pinyin">Pinyin Word</label>
            <input type="text" class="form-control" id="pinyin" name="pinyin" required value="{{ old('pinyin', $item->pinyin) }}">
        </div>

        <div class="form-group">
            <label for="meaning">Arti Indonesia</label>
            <input type="text" class="form-control" id="meaning" name="meaning" required value="{{ old('meaning', $item->meaning) }}">
        </div>

        <div class="row">
            {{-- Type --}}
            <div class="col-md-6 form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="" disabled selected>Pilih jenis kata</option>
                    @foreach(['noun', 'verb', 'adverb','conjunction','preposition','measure','particle','determiner'] as $t)
                        <option value="{{ $t }}" 
                            {{ old('type', isset($item) ? $item->type : '') == $t ? 'selected' : '' }}>
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
                            {{ old('level', isset($item) ? $item->level : '') == $l ? 'selected' : '' }}>
                            {{ ucfirst($l) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="example_cn">Example Sentence (English)</label>
            <textarea class="form-control" id="example_cn" name="example_cn">{{ old('example_cn', $item->example_cn) }}</textarea>
        </div>

        <div class="form-group">
            <label for="example_id">Contoh Kalimat (Indonesia)</label>
            <textarea class="form-control" id="example_id" name="example_id">{{ old('example_id', $item->example_id) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
