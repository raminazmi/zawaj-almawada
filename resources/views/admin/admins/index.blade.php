@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-4">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    إدارة المشرفين
                </h1>
            </div>
        </div>

        <div class="mb-6 flex justify-end items-center">
            <a href="{{ route('admin.admins.create') }}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة مشرف جديد
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-purple-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                        <tr>
                            <th class="py-4 px-4 text-center text-sm font-semibold w-20">#</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">الاسم</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">البريد الإلكتروني</th>
                            <th class="py-4 px-4 text-center text-sm font-semibold">الصلاحية</th>
                            <th class="py-4 px-4 text-center text-sm font-semibold w-48">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($admins as $admin)
                        <tr>
                            <td class="px-4 py-4 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-right text-sm text-gray-700">{{ $admin->name }}</td>
                            <td class="px-4 py-4 text-right text-sm text-gray-700">{{ $admin->email }}</td>
                            <td class="px-4 py-4 text-center">
                                @php
                                $roleConfig = [
                                'main' => [
                                'class' => 'bg-purple-100 text-purple-600',
                                'label' => $admin->id === 1 ? 'ادمن رئيسي' : 'ادمن'
                                ],
                                'sub' => [
                                'class' => 'bg-pink-100 text-pink-600',
                                'label' => 'مشرف'
                                ]
                                ][$admin->admin_role] ?? [
                                'class' => 'bg-gray-100 text-gray-600',
                                'label' => 'غير معروف'
                                ];
                                @endphp

                                <span class="px-3 py-1 text-sm rounded-full font-medium {{ $roleConfig['class'] }}">
                                    {{ $roleConfig['label'] }}
                                </span>
                            </td>
                            @if(auth()->user()->isMainAdmin())
                            <td class="px-4 py-4 text-center flex gap-2">
                                <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-all">
                                    تعديل
                                </a>
                                @if($admin->id !== 1 && auth()->user()->isMainAdmin())
                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST"
                                    class="inline-block delete-admin">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-all">
                                        حذف
                                    </button>
                                </form>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                لا توجد سجلات
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($admins->hasPages())
            <div class="mt-6 mb-3 px-4">
                {{ $admins->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-admin');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذا المشرف!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
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