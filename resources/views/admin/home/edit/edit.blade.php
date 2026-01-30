<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0b1020, #020617);
            margin: 0;
            padding: 20px;
            color: #e5e7eb;
        }

        h1 {
            text-align: center;
            color: #e0e7ff;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: rgba(2, 6, 23, 0.95);
            padding: 30px;
            border-radius: 22px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.7);
            backdrop-filter: blur(8px);
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 13px;
            color: #93c5fd;
            margin-bottom: 6px;
        }

        input, select {
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #1e293b;
            background: #020617;
            color: #e5e7eb;
            font-size: 14px;
            outline: none;
            transition: 0.25s;
        }

        input:focus, select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37,99,235,0.3);
        }

        input::placeholder {
            color: #94a3b8;
        }

        .full {
            grid-column: 1 / -1;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        button {
            padding: 12px 22px;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            font-weight: 500;
            transition: 0.25s;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(37,99,235,0.5);
        }

        .back {
            text-decoration: none;
            color: #93c5fd;
            font-size: 14px;
        }

        .back:hover {
            text-decoration: underline;
        }

        .avatar-preview {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-preview img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #2563eb;
        }
    </style>
</head>
<body>

<h1>Edit User</h1>
@csrf
@if ($errors->any())
    <div class="alert alert-danger p-2">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <form method="POST" action="{{ route('updateuser', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" value="{{ $user->mobile }}">
        </div>

        <div class="form-group">
            <label>Password <small style="color:#94a3b8">(leave empty)</small></label>
            <input type="password" name="password" placeholder="••••••••">
        </div>

        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" value="{{ $user->country }}">
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>


        <div class="form-group">
            <label>Is Verified</label>
            <select name="is_verified">
                <option value="1" {{ $user->is_verified ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$user->is_verified ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group full">
            <label>Avatar</label>
            <input type="file" name="avatar">

            @if($user->avatar)
                <img src="{{ asset('uploads/avatars/' . $user->avatar) }}"
                     alt="Avatar"
                     width="100"
                     height="100"
                     class="rounded-circle">
            @else
                <img src="{{ asset('uploads/avatars/default-avatar.png') }}"
                     alt="Default Avatar"
                     width="100"
                     height="100"
                     class="rounded-circle">
            @endif
        </div>

        <div class="actions full">
            <a href="{{ route('home') }}" class="back">← Back</a>
            <button type="submit">Update User</button>
        </div>

    </form>
</div>

</body>
</html>
