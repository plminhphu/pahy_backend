<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách lịch hẹn') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex justify-between">
                    <a href="{{ route('appointments.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        + Tạo lịch hẹn mới
                    </a>
                </div>

                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Mã KH</th>
                            <th class="px-4 py-2 border">Tên KH</th>
                            <th class="px-4 py-2 border">SĐT</th>
                            <th class="px-4 py-2 border">Địa chỉ</th>
                            <th class="px-4 py-2 border">Ngày hẹn</th>
                            <th class="px-4 py-2 border">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appt)
                            <tr>
                                <td class="px-4 py-2 border">{{ $appt->customer_code }}</td>
                                <td class="px-4 py-2 border">{{ $appt->customer_name }}</td>
                                <td class="px-4 py-2 border">{{ $appt->phone }}</td>
                                <td class="px-4 py-2 border">{{ $appt->address }}</td>
                                <td class="px-4 py-2 border">{{ $appt->appointment_date }}</td>
                                <td class="px-4 py-2 border space-x-2">
                                    <a href="{{ route('appointments.show', $appt->id) }}"
                                        class="text-blue-600 hover:underline">Xem</a>
                                    <a href="{{ route('appointments.edit', $appt->id) }}"
                                        class="text-green-600 hover:underline">Sửa</a>
                                    <form action="{{ route('appointments.destroy', $appt->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline"
                                            onclick="return confirm('Bạn có chắc muốn xóa lịch hẹn này?')">
                                            Xóa
                                        </button>
                                    </form>
                                    <a href="{{ route('appointments.invoice', $appt->id) }}"
                                        class="text-purple-600 hover:underline">Xuất HĐ</a>
                                    <a href="{{ route('appointments.barcode', $appt->id) }}"
                                        class="text-gray-600 hover:underline">Mã vạch</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $appointments->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
