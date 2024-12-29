@extends('layouts.main')
@section('menuKategori', 'active')
@section('content')

<style>
    .title-category {
        font-size: 2.5rem;
        background: linear-gradient(to right, #8d8180, #0b1389);
        -webkit-background-clip: text;
        color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: 700;
        letter-spacing: 1px;
    }

    .title-category i {
        margin-right: 10px;
    }

    /* Menambahkan jarak pada container */
    .container-fluid {
        margin-top: 30px;
    }
</style>

<div class="container-fluid mt-4 px-4">
    <h2 class="mb-5 text-center fw-bold title-category">
        <i class="bi bi-tags"></i> Daftar Kategori Produk
    </h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('kategori.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('kategori.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..." value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Kategori -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kategoris->isNotEmpty())
                            @foreach ($kategoris as $index => $kategori)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <!-- Tombol Edit (Ikon) -->
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square">Edit</i>
                                        </a>
                                        <!-- Form Hapus (Ikon) -->
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="bi bi-trash">Hapus</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    <i class="bi bi-emoji-frown"></i> Tidak ada kategori yang ditemukan.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $kategoris->links() }}
    </div>
</div>

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var form = $(this).closest("form");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data kategori ini akan dihapus dan tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
@endsection
