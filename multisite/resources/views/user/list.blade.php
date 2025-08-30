
<div class="table-scroll mb-4">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-primary text-light">{{ $user->role_name }}</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btnShowUser"
                            data-route="{{ route('user.show', $user->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning btnEditUser"
                            data-route="{{ route('user.edit', $user->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteUser"
                            data-route="{{ route('user.destroy', $user->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Chưa có người dùng nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{!! $users->links('pagination::bootstrap-5') !!}
<script>
$(function() {
    $('#userListData').off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var page = 1;
        var match = url.match(/page=(\d+)/);
        if (match) page = match[1];
        loadListData(page);
    });
});
</script>