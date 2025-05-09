@extends('backend.v_layout.app')

@section('content')
<!-- contentAwal -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h4 class="card-title">{{ $judul }}</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label><br>
                                    <img class="foto-preview mb-2" style="max-width: 150px;">
                                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Hak Akses</label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Pilih Hak Akses -</option>
                                        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                                    @error('nama')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                    @error('email')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>HP</label>
                                    <input type="text" name="hp" value="{{ old('hp') }}" onkeypress="return hanyaAngka(event)" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP">
                                    @error('hp')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                    @error('password')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- contentAkhir -->
@endsection
