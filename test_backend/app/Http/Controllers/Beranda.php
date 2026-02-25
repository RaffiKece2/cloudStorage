<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use App\Models\Gallery;
use App\Models\Wallet;
use Illuminate\Support\Facades\Storage;
use App\Models\Folder;
use Illuminate\Support\Str;


class Beranda extends Controller
{
    public function akun($id)
    {
        $user = User::find($id);
        $folders = $user->folders()->whereNull('parent_id')->get();
        $files = $user->galleries()->get();

        return view('beranda', compact('user', 'folders', 'files'));
    }
    public function upload(Request $upload)
    {
        $upload->validate([
            'upload' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,application/pdf|max:2048'

        ]);

        if ($upload->hasFile('upload')) {
            $file = $upload->file('upload');

            $nama_file = Str::uuid() . '_' . $file->getClientOriginalName();

            Storage::putFileAs('data_user/' . auth()->id(),$file,$nama_file);

            

            Gallery:: create([
                'user_id' => auth()->id(),
                'file' => $nama_file,
                'nama_tampilan' => $nama_file

            ]);
            $nama_tampil = $nama_file;

            $koin_user = Wallet::firstOrCreate(
                ['user_id' => auth()->id()],
                ['koin' => 0]
                );

            $koin_user->increment('koin',amount: 10);

            return redirect('/beranda/'.auth()->id())->with('nama_tampil',$nama_tampil);
        
        }
    }
    public function hapus($id)
    {
        $hapus_file = Gallery::find($id);

        $akun = auth()->id();


        Storage::delete('data_user/' . $akun . '/' . $hapus_file->file);
        
        $hapus_file->delete();

        return redirect('/beranda/' . auth()->id())->with('hapus_sukses', 'data: ' . $hapus_file->file . ' berhasil dihapus' );
    }

    public function folder(Request $folderBaru)
    {
        $folderBaru->validate([
            'nama' => 'required|min:3'

        ]);

        $user = auth()->id();

        $strip_andalan = str_replace(' ','_',$folderBaru->nama);

        $folder_kedua =  Folder:: create([
            'nama_folder' => $strip_andalan,
            'user_id' => auth()->id(),
            'parent_id' => $folderBaru->input('parent_id')

        ]);


        $tambah_koin = Wallet::firstOrCreate(
            ['user_id' => auth()->id()],
            ['koin' =>  0 ]
        );
        $tambah_koin->increment('koin', 10);

        if ($folder_kedua->parent_id) {
            $folder_utama = Folder::find($folder_kedua->parent_id);
            $tempat_direktori = 'data_user/' . $user . '/' . $folder_utama->nama_folder .'/' . $folder_kedua->nama_folder;

        }else {
            $tempat_direktori = 'data_user/' . $user .'/' . $folder_kedua->nama_folder;

        }

    

        if (!Storage::exists($tempat_direktori)) {
            Storage::makeDirectory($tempat_direktori);
            
        }
            

        return back()
        ->with('notif','folder berhasil ditambakan!');


    }

    public function new_folder($id)
    {
        $isi_folder = Folder::with(relations: ['children', 'user'])->findOrFail(id: $id);

        if ($isi_folder->user_id !== auth()->id()) {
            abort(403, 'maaf anda tidak ada perizinan');
        }



        return view('isi', data: compact(var_name: 'isi_folder'));
    }

    public function pencarian(Request $cari)
    {
        $kunci = $cari->cari;
        
        $user = auth()->user();


        if($kunci) {
            $pemisah_str = str_replace(' ','_',$kunci);

            $folders = $user->folders()->where('nama_folder', 'LIKE' , '%' . $pemisah_str . '%')->get();
            $files = $user->galleries()->where('nama_tampilan', 'LIKE' , '%' . $pemisah_str . '%')->get();


        }else {
            $folders = $user->folders()->whereNull('parent_id')->get();
            $files = $user->galleries();
        }
     
        return view('beranda',compact('user','folders','files'));
        
    }

    public function hapus_folder($id)
    {
        $hapus_folder = Folder::find($id);

        $akun = auth()->id();


        $hapus_folder->delete();

        $tempat_hapus = 'data_user/' . $akun . '/' . $hapus_folder->nama_folder;

        Storage::deleteDirectory($tempat_hapus);
        $nama = $hapus_folder->nama_folder;
    



        return redirect('/beranda/' .auth()->id())->with('folder_status',"folder " . $nama ." berhasil dihapus");

    }
    public function hapus_subfolder($id)
    {
        $subfolder_hapus = Folder::find(id: $id);
        $parent_id = $subfolder_hapus->parent_id;

        $akun = auth()->id();


        if ($parent_id) {
            $folder_utama = Folder::find($parent_id);
            $tempat_subfolder = 'data_user/' . $akun . '/' . $folder_utama->nama_folder . '/' . $subfolder_hapus->nama_folder;
            
        }   
       
        if (Storage::exists($tempat_subfolder)) {
            Storage::deleteDirectory($tempat_subfolder);
        }

        



        $subfolder_hapus->delete();

        return redirect('/folder_open/' . $parent_id)->with('status_subfolder', 'Folder berhasil dihapus');
    }

    public function upload_subfolder(Request $upload_subfolder)
    {
        $upload_subfolder->validate(rules: [
            'upload' => 'required|image|mimes:png,jpg,jpeg|max:2048',

        ]);

        if ($upload_subfolder->hasFile('upload')) {
            $file = $upload_subfolder->file('upload');

            $nama = time() . '_' . $file->getClientOriginalName();


            Gallery::create([
                'user_id' => auth()->id(),
                'folder_id' => $upload_subfolder->input('folder_id'),
                'file' => $nama


            ]);

            $folder_utama = Folder::find($upload_subfolder->input('folder_id'));

            $parent_id = $folder_utama->parent_id;
            $akun = auth()->id();

        




            if ($folder_utama->id) {
                $tempat_file = 'data_user/' . $akun . '/' . $folder_utama->nama_folder;
            }

            if ($parent_id) {
                $folder_kedua = Folder::find($parent_id);
                $tempat_file = 'data_user/' . $akun . '/' . $folder_kedua->nama_folder . '/' . $folder_utama->nama_folder;
            }else {
                $tempat_file = 'data_user';

            }

            Storage::putFileAs($tempat_file,$file,$nama);

    
            return back()->with('nama_tampil' , $nama);
        }

    }

    public function hapus_file($id)
    {
        $hapus_isi = Gallery::find($id);
        $folder_utama = $hapus_isi->folder_id;

        $cari_folder = Folder::find($folder_utama);
        $parent_id = $cari_folder->parent_id;

        $akun = auth()->id();

        if ($cari_folder->id) {
            $tempat = 'data_user/' .$akun . '/' . $cari_folder->nama_folder . '/' . $hapus_isi->file;

        }

        if ($parent_id) {
            $folder_kedua = Folder::find($parent_id);
            $tempat = 'data_user/' . $akun . '/' . $folder_kedua->nama_folder . '/' . $cari_folder->nama_folder . '/' . $hapus_isi->file;
        }
 


        if (Storage::exists($tempat)) {
            Storage::delete($tempat);
        }

        $hapus_isi->delete();

        return back()->with('status_file', "File Berhasil dihapus");
    }

    public function izin_file($id)
    {
        $isi_file = Gallery::find($id);

        if ($isi_file->user_id != auth()->id() && $isi_file->izin == 0) {
            abort(403, 'Maaf File berisi private');
        }


        return view('permission', data: compact('isi_file'));
    }

    public function ubah_izin(Request $perizinan , $id)
    {
        $ubah = Gallery::findOrFail($id);

        $ubah->update([
            'izin' => $perizinan->izin
        ]);

        if ($ubah->izin == 1) {
            $pesan = 'public';
        }
        if ($ubah->izin == 0) {
            $pesan = 'private';
        }


        return back()->with('status', 'File '. $ubah->file . ' Menjadi ' . $pesan);
    }

    public function masuk_izin($id)
    {
        $izin_folder = Folder::find($id);

        return view('izin_folder',compact('izin_folder'));
    }

    public function folder_permission(Request $permission , $id)
    {
        $folder_izin = Folder::find($id);

        $folder_izin->update([
            'permission' => $permission->izin
        ]);

        if ($folder_izin->permission == 0) {
            $pesan = 'Private';
        }

        if ($folder_izin->permission == 1) {
            $pesan = 'Public';
        }

        return back()->with('status', 'File ' . $folder_izin->nama_folder . " menjadi " . $pesan );
    }

    public function hapus_akun($id)
    {
        $cari_akun = User::findOrFail($id);

        $tempat = 'data_user/' . auth()->id();


        if (Storage::exists($tempat)) {
            Storage::deleteDirectory($tempat);
        }
 
        $cari_akun->delete();

        $pesan = 'akun berhasil dihapus';

        return view('register',compact('pesan'));
    }

    public function lihat_akun($id)
    {
        $lihat_akun = User::find($id);

        return view('akun',compact('lihat_akun'));
    }

    public function logout(Request $keluar)
    {
        Auth::logout();

        $keluar->session()->invalidate();
        $keluar->session()->regenerateToken();


        return view('register');
    }


    public function download_file($id)
    {
        $file = Gallery::find($id);

        $user_sekarang = auth()->id();

        if ($file->user_id == $user_sekarang && $file->izin == 1) {
            $tempat = 'data_user/' . $user_sekarang . '/' . $file->file;

            return Storage::download($tempat);
        }

        return back()->with('error',"maaf data tidak bisa didownload!");
    }

    public function pindah($id)
    {
        $ubah_nama = Gallery::find($id);

        return view('rename',compact('ubah_nama'));
    }

    public function rename( Request $ubah , $id)
    {
        $cari_nama = Gallery::find($id);

        $ubah->validate([
            'ubah_nama' => 'required'

        ]);

        $nama_baru = str_replace(' ','_',$ubah->input('ubah_nama'));

        $cari_nama->update(
         
            ['nama_tampilan' => $nama_baru]
        );

        $status_rename = 'File berhasil direname!';  

        return view('beranda',compact('status_rename'));

        

    }
}
