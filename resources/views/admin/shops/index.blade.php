@extends('layouts.app')

@section('content')
<div class="min-h-screen pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-8">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    قائمة المحلات
                </h1>
            </div>

            <div class="mb-6 flex justify-end mt-4">
                <a href="{{ route('business-activities.create') }}"
                    class="px-4 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition-all">
                    إضافة نشاط
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-pink-400 to-purple-500 text-white">
                                <tr>
                                    <th class="py-4 px-2 text-center text-md font-semibold"> م </th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">اسم المحل</th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">رقم الهاتف</th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">نوع النشاط</th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">الولاية</th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">جوائز</th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">الحالة</th>
                                    <th class="py-4 px-2 text-center text-md font-semibold">التحكم</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($activities as $activity)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                        {{ $activity->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                        {{ $activity->phone }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                        {{ $activity->activity_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                        {{ $activity->state }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                        {{ $activity->offers_rewards ? 'نعم' : 'لا' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                        <span
                                            class="px-3 py-1 text-white rounded-md {{ $activity->status === 'مقبول' ? 'bg-green-500' : ($activity->status === 'مرفوض' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                            {{ $activity->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-center flex justify-center gap-4">
                                        <form action="{{ route('admin.business-activities.updateStatus', $activity) }}"
                                            method="POST">
                                            @csrf
                                            <div class="relative">
                                                <select name="status" onchange="this.form.submit()"
                                                    class="w-full pr-8 min-w-[90px] pl-2 py-2 rounded-lg border-2 border-purple-600 bg-white text-gray-900 text-xs cursor-pointer transition-all hover:border-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-600">
                                                    <option value="مقبول" {{ $activity->status === 'مقبول' ?
                                                        'selected' : '' }}>
                                                        مقبول
                                                    </option>
                                                    <option value="مرفوض" {{ $activity->status === 'مرفوض' ?
                                                        'selected' : '' }}>
                                                        مرفوض
                                                    </option>
                                                    <option value="قيد الانتظار" {{ $activity->status ===
                                                        'قيد الانتظار' ? 'selected' : '' }}>
                                                        قيد الانتظار
                                                    </option>
                                                </select>
                                            </div>
                                        </form>
                                        <form action="{{ route('admin.shops.destroy', $activity->id) }}" method="POST"
                                            class="inline-block delete-activity">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-all">
                                                حذف
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
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
                    const deleteForms = document.querySelectorAll('.delete-activity');

                    deleteForms.forEach(form => {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            Swal.fire({
                                title: 'هل أنت متأكد؟',
                                text: "سيتم حذف هذا النشاط!",
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