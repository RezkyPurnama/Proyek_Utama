@extends('layouts.main')
@section('menuUser', 'active')
@section('content')

<style>
    .title-user {
        font-size: 2.5rem;
        background: linear-gradient(to right, #0b8d89, #0b1389);
        -webkit-background-clip: text;
        color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: 700;
        letter-spacing: 1px;
    }

    .title-user i {
        margin-right: 10px;
    }

    .container-fluid {
        margin-top: 30px;
    }
</style>

<div class="container-fluid mt-4 px-4">
    <h2 class="mb-5 text-center fw-bold title-user">
        <i class="bi bi-person-fill"></i> Daftar User
    </h2>

    <!-- Button to add user -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('mengelola-user.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Data User
        </a>

        <!-- Search Form -->
        <form method="GET" action="{{ route('mengelola-user.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari user..." value="{{ request()->search }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table of Users -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 20%;">Nama</th>
                            <th style="width: 20%;">Email</th>
                            <th style="width: 15%;">Telepon</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $dataUser)
                            <tr>
                                <td class="text-center">{{ $users->firstItem() + $index }}</td>
                                <td>{{ $dataUser->name }}</td>
                                <td>{{ $dataUser->email }}</td>
                                <td>{{ $dataUser->no_telepon }}</td>
                                <td class="text-center">
                                    <a href="{{ route('mengelola-user.edit', $dataUser->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('mengelola-user.destroy', $dataUser->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

</div>

@section('scripts')
    <script>
        // Konfirmasi Hapus
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                if (confirm('Apakah Anda yakin ingin menghapus data pengguna ini?')) {
                    this.closest('form').submit();
                }
            });
        });
    </script>
@endsection

@endsection
