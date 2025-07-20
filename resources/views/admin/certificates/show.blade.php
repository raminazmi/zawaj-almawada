@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#2A5C82] mb-2">تفاصيل الشهادة</h1>
                    <p class="text-gray-600">عرض تفاصيل شهادة المستخدم</p>
                </div>
            </div>
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

        <!-- Certificate Details -->
        <div class="bg-white rounded-xl shadow-lg p-8 border border-[#3A8BCD]/20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- User Information -->
                <div>
                    <h3 class="text-xl font-semibold text-[#2A5C82] mb-4">معلومات المستخدم</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-16 h-16 rounded-full bg-[#3A8BCD] flex items-center justify-center">
                                <span class="text-white font-semibold text-lg">
                                    {{ substr($result->user->name ?? 'U', 0, 1) }}
                                </span>
                            </div>
                            <div class="mr-4">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $result->user->name ?? 'غير متوفر' }}
                                </h4>
                                <p class="text-gray-600">{{ $result->user->full_name ?? 'غير متوفر' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-[#3A8BCD] ml-3"></i>
                                <span class="text-gray-700">{{ $result->user->email ?? 'غير متوفر' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-[#3A8BCD] ml-3"></i>
                                <span class="text-gray-700">{{ $result->user->phone ?? 'غير متوفر' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-[#3A8BCD] ml-3"></i>
                                <span class="text-gray-700">تاريخ التسجيل: {{ $result->user->created_at->format('Y-m-d')
                                    }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exam Information -->
                <div>
                    <h3 class="text-xl font-semibold text-[#2A5C82] mb-4">معلومات الاختبار</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $result->exam->title ?? 'غير متوفر' }}</h4>
                            <p class="text-gray-600">{{ $result->exam->description ?? '' }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-[#3A8BCD] ml-3"></i>
                                <span class="text-gray-700">المدة: {{ $result->exam->duration ?? 0 }} دقيقة</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-check text-[#3A8BCD] ml-3"></i>
                                <span class="text-gray-700">تاريخ الاختبار: {{
                                    $result->exam->start_time->format('Y-m-d') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-[#3A8BCD] ml-3"></i>
                                <span class="text-gray-700">الحالة: {{ $result->exam->is_active ? 'مفعل' : 'غير مفعل'
                                    }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score and Certificate Details -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-semibold text-[#2A5C82] mb-4">تفاصيل النتيجة والشهادة</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-[#2A5C82] mb-2">{{ round($result->score) }}</div>
                        <div class="text-gray-600">العلامة النهائية</div>
                        <div class="text-sm text-gray-500">من 100</div>
                    </div>

                    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-green-600 mb-2">
                            {{ $result->score >= 60 ? 'شهادة إجتياز' : 'شهادة حضور' }}
                        </div>
                        <div class="text-gray-600">نوع الشهادة</div>
                        <div class="text-sm text-gray-500">
                            {{ $result->score >= 60 ? 'تم الإجتياز بنجاح' : 'حضور الدورة' }}
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-purple-600 mb-2">
                            {{ $result->created_at->format('Y-m-d') }}
                        </div>
                        <div class="text-gray-600">تاريخ الإصدار</div>
                        <div class="text-sm text-gray-500">{{ $result->created_at->format('H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-semibold text-[#2A5C82] mb-4">الإجراءات</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.certificates.download', [$result, $result->score >= 60 ? 'success' : 'attendance']) }}"
                        class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center">
                        <i class="fas fa-download ml-2"></i>
                        تحميل الشهادة
                    </a>

                    <form method="POST" action="{{ route('admin.certificates.delete', $result) }}"
                        class="inline delete-certificate">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition flex items-center">
                            <i class="fas fa-trash ml-2"></i>
                            حذف الشهادة
                        </button>
                    </form>
                </div>
            </div>
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