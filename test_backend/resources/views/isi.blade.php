<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ $isi_folder->nama_folder }}</title>

 
</head>
<body>

    <form action="/beranda/{{ auth()->id() }}">
        <button>Beranda</button>
    </form>

    <form action="/folder" method="POST">
        @csrf
        <input placeholder="Nama Folder" name="nama" type="text">
        <input value="{{ $isi_folder->id }}" name="parent_id" type="hidden">
        <button>Create Folder</button>

    </form>


    <form action="/upload_subfolder" enctype="multipart/form-data" method="POST">
        @csrf
        <input name="upload" type="file">
        <input name="folder_id" value="{{ $isi_folder->id }}" type="hidden">
        <button>Upload File</button>
    </form>

    @if (session('nama_tampil'))
        <button>{{ session('nama_tampil') }}</button>
    
    @endif


    @foreach ($isi_folder->files as $isi_file )
        <button>{{ $isi_file->file }}</button>

        <form action="/hapus_file/{{ $isi_file->id }}" method="GET">
            <button>Hapus</button>
        </form>
    
    @endforeach

    @foreach ($isi_folder->children as $subfolder )
        <form action="/folder_open/{{ $subfolder->id }}">
            <button>{{ $subfolder->nama_folder }}</button>

        </form>

        <form action="/hapus_subfolder/{{ $subfolder->id }}" method="GET">
            <button>Hapus</button>
        </form>
   
    
    @endforeach

    @if (session('notif'))
        <p>{{ session('notif') }}</p>
    
    @endif

    @if (session('status_subfolder'))
        <p>{{ session('status_subfolder') }}</p>
    
    @endif

    @if (session('status_file'))
        <p>{{ session('status_file') }}</p>
    
    @endif

    
</body>
</html>