@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-[#2A5C82]" style="font-family: 'Almarai', sans-serif;">
                    إدارة اختبارات الدورات
                </h2>
                <a href="{{ route('admin.exams.create') }}"
                    class="bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-6 py-2 rounded-full font-bold shadow hover:opacity-90 transition">
                    إضافة اختبار جديد
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-xl shadow">
                    <thead>
                        <tr class="bg-blue-50 text-[#2A5C82] text-lg">
                            <th class="py-3 px-4 text-right">العنوان</th>
                            <th class="py-3 px-4 text-right">الوصف</th>
                            <th class="py-3 px-4 text-right">المدة</th>
                            <th class="py-3 px-4 text-right">التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exams as $exam)
                        <tr class="border-b hover:bg-blue-50 transition">
                            <td class="py-3 px-4">{{ $exam->title }}</td>
                            <td class="py-3 px-4">{{ $exam->description }}</td>
                            <td class="py-3 px-4">{{ $exam->duration }} دقيقة</td>
                            <td class="py-3 px-4 flex flex-wrap gap-2">
                                <a href="{{ route('admin.exams.edit', $exam) }}"
                                    class="bg-purple-600 text-white px-4 py-1 rounded-full font-bold hover:bg-purple-700 transition">تعديل</a>
                                <a href="{{ route('admin.exams.questions', $exam) }}"
                                    class="bg-blue-600 text-white px-4 py-1 rounded-full font-bold hover:bg-blue-700 transition">الأسئلة</a>
                                <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST"
                                    onsubmit="return confirm('تأكيد الحذف؟')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-4 py-1 rounded-full font-bold hover:bg-red-700 transition">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($exams->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-8">لا توجد اختبارات حالياً.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection