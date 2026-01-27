<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Control Panel</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0b1020, #020617);
            margin: 0;
            padding: 20px;
            color: #e5e7eb;
        }

        /* ===== Title & Top Bar ===== */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            color: #e0e7ff;
            letter-spacing: 1px;
        }

        .logout-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #dc2626, #991b1b);
            color: #fff;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.25s ease;
        }

        .logout-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(220,38,38,0.4);
        }

        /* ===== Container ===== */
        .container {
            max-width: 100%;
            margin: auto;
            background: rgba(2, 6, 23, 0.9);
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.7);
            overflow-x: auto;
            backdrop-filter: blur(6px);
        }

        /* ===== Form ===== */
        form {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        input[type="text"] {
            flex: 1;
            min-width: 220px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #1e293b;
            background: #020617;
            color: #e5e7eb;
            font-size: 14px;
        }

        input::placeholder {
            color: #94a3b8;
        }

        button {
            padding: 12px 18px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(37,99,235,0.4);
        }

        button.edit {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        button.delete {
            background: linear-gradient(135deg, #dc2626, #991b1b);
        }

        /* ===== Table ===== */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            min-width: 700px;
        }

        thead th {
            background: #020617;
            color: #93c5fd;
            font-weight: 500;
            padding: 14px;
            border-radius: 12px;
        }

        tbody tr {
            background: #020617;
            border-radius: 16px;
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            transform: scale(1.005);
        }

        td {
            padding: 14px;
            text-align: center;
            color: #e5e7eb;
        }

        td:first-child {
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
        }

        td:last-child {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        /* ===== Pagination ===== */
        .pagination-wrapper {
            margin: 35px 0 10px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 10px;
            list-style: none;
            padding: 0;
        }

        .pagination li a,
        .pagination li span {
            min-width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #020617;
            border: 1px solid #1e293b;
            color: #93c5fd;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .pagination li a:hover {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 0 12px rgba(37,99,235,0.6);
        }

        .pagination li.active span {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            box-shadow: 0 0 15px rgba(37,99,235,0.8);
        }

        .pagination li.disabled span {
            opacity: 0.4;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="top-bar">
        <h1>Admin Users</h1>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </div>

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

    <!-- Create -->
    <form method="post">
        <input type="text" placeholder="Enter item name">
        <a href="{{ route('createuser') }}">
            <button type="button">Add</button>
        </a>
    </form>

    <!-- Read -->
    <table>
        <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Mobile</th>
            <th>Avatar</th><th>Country</th><th>Is_Verified</th>
            <th>Role</th><th>Created_at</th><th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->avatar }}</td>
                <td>{{ $user->country }}</td>
                <td>{{ $user->is_verified }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('edituser', $user->id) }}">
                        <button class="edit">Edit</button>
                    </a>
                    <form method="POST" action="{{ route('deleteuser', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $users->links('vendor.pagination.simple') }}
    </div>
</div>

</body>
</html>
