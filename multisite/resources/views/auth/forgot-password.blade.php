<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Nhập email của bạn" required>
    <button type="submit">Gửi link đặt lại mật khẩu</button>
</form>
