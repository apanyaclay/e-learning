@extends('layouts.master')
@section('content')
<style>
    .post-wrapper {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .post-container {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 1rem;
    }

    .post-form {
        flex-shrink: 0;
    }

    .post {
        margin: 0.5rem 0;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
    }

    .post.left {
        background: #f1f1f1;
        align-self: flex-start;
    }

    .post.right {
        background: #f1f1f1;
        align-self: flex-end;
        border: 1px solid blue;
    }
</style>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pertemuan {{ $pertemuan->pertemuan }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pertemuan</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-bordered nav-justified">
                                <li class="nav-item">
                                    <a href="#postingan" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                        Postingan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#absensi" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                        Absensi
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="postingan">
                                    <div class="post-wrapper">
                                        <div class="post-container" id="post-container">

                                        </div>
                                        <div class="post-form">
                                            <form action="{{ route('guru/pertemuan/view_store') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" name="message" class="form-control" placeholder="Type a message...">
                                                    <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->id }}">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="absensi">
                                    <div class="table-responsive">
                                        <table
                                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                            <thead class="student-thread">
                                                <tr>
                                                    <th>No</th>
                                                    <th>NISN</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Status Absensi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($absensi as $value)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $value->siswa->nisn }}</td>
                                                        <td>{{ $value->siswa->nama }}</td>
                                                        <td>{{ $value->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function fetchPosts() {
                $.ajax({
                    url: '{{ route('guru/pertemuan/fetchPosts', $pertemuan->id) }}',
                    method: 'GET',
                    success: function(data) {
                        console.log(data)
                        let postContainer = $('#post-container');
                        postContainer.empty();
                        data.forEach(function(post) {
                            let postDate = new Date(post.created_at);
                        let formattedDate = postDate.toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'short'
                        });
                        let formattedTime = postDate.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        let postClass = post.user_id === {{ Auth::id() }} ? 'right' : 'left';

                        let postElement = `
                            <div class="post ${postClass}">
                                <p>${post.username} <span class="text-muted" style="font-size: 12px; margin-left: 10px">${formattedDate} ${formattedTime}</span></p>
                                <p>${post.message}</p>
                            </div>
                            `;
                        postContainer.append(postElement);
                        });
                    }
                });
            }
            setInterval(fetchPosts, 5000);
            fetchPosts(); // Initial fetch to load posts immediately on page load
        });
    </script>
@endsection
