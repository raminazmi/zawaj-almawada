@extends('layouts.app')

@section('content')
<div class="min-h-screen pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-8">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    قائمة الأعضاء
                </h1>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-pink-400 to-purple-500 text-white">
                            <tr>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    م
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    الاسم المستعار
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    البريد الالكتروني
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    الجنس
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    العمر
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    الهاتف
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    الدولة
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    الوزن
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    الطول
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    لون البشرة
                                </th>
                                <th class="py-4 px-2 text-center text-md font-semibold">
                                    التحكم
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ $loop->iteration ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->email ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->gender ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->age ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->phone ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->country ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->weight ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->height ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                    {{ $user->skin_color ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center space-x-2">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="inline-block delete-member">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-all">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 mb-3 px-4">
                    {{ $users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        const deleteForms = document.querySelectorAll('.delete-member');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذا العضو!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection