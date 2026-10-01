<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>จัดการผู้ใช้ - CompanyChat</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #2563eb;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .name {
            font-size: 18px;
            font-weight: bold;
        }

        .email {
            color: #6b7280;
            margin-top: 5px;
        }

        select {
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            min-width: 180px;
        }

        button {
            padding: 10px 16px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('dashboard') }}" class="back">
        ← กลับหน้า CompanyChat
    </a>

    <h1>👥 จัดการผู้ใช้</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($users as $user)

        <div class="card">

            <div class="user-info">

                <div>
                    <div class="name">
                        👤 {{ $user->name }}
                    </div>

                    <div class="email">
                        {{ $user->email }}
                    </div>

                    <div>
                        ตำแหน่งปัจจุบัน:
                        <strong>{{ $user->position }}</strong>
                    </div>
                </div>

                <form method="POST"
                      action="{{ route('users.position', $user) }}">

                    @csrf
                    @method('PUT')

                    <select name="position">

                        <option value="พนักงาน"
                            {{ $user->position === 'พนักงาน' ? 'selected' : '' }}>
                            พนักงาน
                        </option>

                        <option value="หัวหน้างาน"
                            {{ $user->position === 'หัวหน้างาน' ? 'selected' : '' }}>
                            หัวหน้างาน
                        </option>

                        <option value="ผู้จัดการ"
                            {{ $user->position === 'ผู้จัดการ' ? 'selected' : '' }}>
                            ผู้จัดการ
                        </option>

                        <option value="ผู้ดูแลระบบ"
                            {{ $user->position === 'ผู้ดูแลระบบ' ? 'selected' : '' }}>
                            ผู้ดูแลระบบ
                        </option>

                    </select>

                    <button type="submit">
                        บันทึก
                    </button>

                </form>

            </div>

        </div>

    @endforeach

</div>

</body>
</html>