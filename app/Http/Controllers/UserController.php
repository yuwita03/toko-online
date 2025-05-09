<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'     => 'required|max:255',
            'email'    => 'required|max:255|email|unique:user',
            'role'     => 'required',
            'hp'       => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto'     => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max'   => 'Ukuran file gambar Maksimal adalah 1024 KB.',
        ]);

        $validatedData['status'] = 0;

        // Proses upload foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }

        // Validasi pola password: huruf besar, kecil, angka, dan simbol
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';

        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()->back()->withErrors([
                'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mencari user berdasarkan ID, jika tidak ditemukan akan memunculkan error 404
        $user = User::findOrFail($id);

        // Mengembalikan tampilan edit dengan data user yang ingin diubah
        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',  // Judul halaman
            'edit' => $user         // Data user yang akan diedit
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mencari user berdasarkan ID, jika tidak ditemukan akan memunculkan error 404
        $user = User::findOrFail($id);

        // Menentukan aturan validasi untuk input form
        $rules = [
            'nama' => 'required|max:255',
            'role' => 'required',
            'status' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        $messages = [
            'foto.image' => 'Format gambar harus menggunakan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ];

        // Jika email berubah, tambahkan aturan validasi untuk email yang unik
        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:user';
        }

        // Melakukan validasi input form
        $validatedData = $request->validate($rules, $messages);

        // Memeriksa apakah ada file foto yang diunggah
        if ($request->file('foto')) {
            // Menghapus gambar lama jika ada
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Mengambil file foto dan menentukan nama file yang unik
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Menggunakan ImageHelper untuk mengupload dan meresize gambar
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Menyimpan nama file gambar yang baru di database
            $validatedData['foto'] = $originalFileName;
        }

        // Memperbarui data user dengan data yang sudah tervalidasi
        $user->update($validatedData);

        // Mengalihkan pengguna kembali ke halaman index dengan pesan sukses
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbaharui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Cek apakah pengguna memiliki foto
        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;

            // Periksa apakah file foto ada
            if (file_exists($oldImagePath)) {
                // Hapus file foto lama
                unlink($oldImagePath);
            }
        }

        // Hapus data pengguna
        $user->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil dihapus');
    }
}
