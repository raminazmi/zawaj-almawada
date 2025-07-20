@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2A5C82] text-center mb-4">إدارة الشهادات</h1>
            <p class="text-gray-600 text-center">عرض وإدارة جميع الشهادات الصادرة من الاختبارات</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle ml-2"></i>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-[#3A8BCD]/20">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-certificate text-blue-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm text-gray-600">إجمالي الشهادات</p>
                        <p class="text-2xl font-bold text-[#2A5C82]">{{ $stats['total_certificates'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-green-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm text-gray-600">شهادات الإجتياز</p>
                        <p class="text-2xl font-bold text-green-600">{{ $stats['passing_certificates'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-yellow-200">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-user-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm text-gray-600">شهادات الحضور</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $stats['attendance_certificates'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-200">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm text-gray-600">متوسط العلامات</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $stats['average_score'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-green-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-trophy text-green-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm text-gray-600">أعلى علامة</p>
                        <p class="text-2xl font-bold text-green-600">{{ $stats['highest_score'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-red-200">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="fas fa-chart-bar text-red-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm text-gray-600">أدنى علامة</p>
                        <p class="text-2xl font-bold text-red-600">{{ $stats['lowest_score'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-[#3A8BCD]/20">
            <h3 class="text-lg font-semibold text-[#2A5C82] mb-4">فلترة النتائج</h3>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">البحث</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                        placeholder="اسم المستخدم، رقم الجوال، البريد الإلكتروني">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الاختبار</label>
                    <select name="exam_id"
                        class="w-full rounded-lg border-gray-300 focus:ring-[#3A8BCD] focus:border-[#3A8BCD]">
                        <option value="">جميع الاختبارات</option>
                        @foreach($exams as $exam)
                        <option value="{{ $exam->id }}" {{ request('exam_id')==$exam->id ? 'selected' : '' }}>
                            {{ $exam->title }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">من تاريخ</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-[#3A8BCD] focus:border-[#3A8BCD]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">إلى تاريخ</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-[#3A8BCD] focus:border-[#3A8BCD]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">العلامة من</label>
                    <input type="number" name="score_min" value="{{ request('score_min') }}" min="0" max="100"
                        class="w-full rounded-lg border-gray-300 focus:ring-[#3A8BCD] focus:border-[#3A8BCD]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">العلامة إلى</label>
                    <input type="number" name="score_max" value="{{ request('score_max') }}" min="0" max="100"
                        class="w-full rounded-lg border-gray-300 focus:ring-[#3A8BCD] focus:border-[#3A8BCD]">
                </div>

                <div class="flex gap-2 items-end">
                    <button type="submit"
                        class="bg-[#3A8BCD] text-white px-2 py-1 h-fit rounded-lg hover:bg-[#2A5C82] transition">
                        <i class="fas fa-search ml-1"></i> بحث
                    </button>
                    <a href="{{ route('admin.certificates.index') }}"
                        class="bg-gray-500 text-white px-2 py-1 h-fit rounded-lg hover:bg-gray-600 transition">
                        <i class="fas fa-times ml-1"></i> إعادة تعيين
                    </a>
                </div>
            </form>
        </div>

        <!-- Export Button -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-[#2A5C82]">نتائج البحث ({{ $results->total() }} نتيجة)</h3>
            </div>
        </div>

        <!-- Results Table -->
        <div class="bg-white rounded-xl shadow-lg border border-[#3A8BCD]/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                المستخدم
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                رقم الجوال
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                الاختبار
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                العلامة
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                نوع الشهادة
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                تاريخ الإصدار
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                الإجراءات
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($results as $result)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div
                                            class="h-10 w-10 rounded-full bg-[#3A8BCD] flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">
                                                {{ substr($result->user->name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mr-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $result->user->name ?? 'غير متوفر' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $result->user->full_name ?? 'غير متوفر' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $result->user->email ?? 'غير متوفر' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $result->user->phone ?? 'غير متوفر' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $result->exam->title ?? 'غير متوفر' }}</div>
                                <div class="text-sm text-gray-500">{{ $result->exam->description ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $result->score >= 60 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ round($result->score) }}/100
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $result->score >= 60 ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                    {{ $result->score >= 60 ? 'شهادة إجتياز' : 'شهادة حضور' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $result->created_at->format('Y-m-d') }}<br>
                                <span class="text-gray-500">{{ $result->created_at->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.certificates.show', $result) }}"
                                        class="text-[#3A8BCD] hover:text-[#2A5C82] transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.certificates.download', [$result, $result->score >= 60 ? 'success' : 'attendance']) }}"
                                        class="text-green-600 hover:text-green-800 transition">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.certificates.delete', $result) }}"
                                        class="inline delete-certificate">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                لا توجد نتائج مطابقة للبحث
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($results->hasPages())
            <div class="mt-6 mb-3 px-4">
                {{ $results->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-certificate');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذه الشهادة نهائياً!",
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