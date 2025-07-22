@extends('admin.layouts.app')

@section('title', 'Tambah Kosakata')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Kosakata Baru Chinese</h1>

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

    <form method="POST" action="{{ route('vocabs-chn.store') }}">
        @csrf        
        <div class="form-group">
            <label for="hanzi">Hanzi Word</label>
            <input type="text" class="form-control" id="hanzi" name="hanzi" required value="{{ old('hanzi') }}">
        </div>

        <div class="form-group">
            <label for="pinyin">Pinyin Translation</label>
            <input type="text" class="form-control" id="pinyin" name="pinyin" required value="{{ old('pinyin') }}">
        </div>
        
        <div class="form-group">
            <label for="meaning">Meaning</label>
            <input type="text" class="form-control" id="meaning" name="meaning" required value="{{ old('meaning') }}">
        </div>

         <div class="row">
            {{-- Type --}}
            <div class="col-md-6 form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="" disabled selected>Pilih jenis kata</option>
                    @foreach(['noun', 'verb', 'adverb', 'conjunction', 'preposition', 'measure', 'particle', 'determiner'] as $t)
                        <option value="{{ $t }}"
                            @if ((old('type') ?? ($chinesewords->type ?? '')) == $t) selected @endif>
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
                            @if ((old('level') ?? ($chinesewords->level ?? '')) == $l) selected @endif>
                            {{ ucfirst($l) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="example_cn">Example Sentence (English)</label>
            <textarea class="form-control" id="example_cn" name="example_cn">{{ old('example_cn') }}</textarea>
        </div>

        <div class="form-group">
            <label for="example_id">Contoh Kalimat (Indonesia)</label>
            <textarea class="form-control" id="example_id" name="example_id">{{ old('example_id') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
