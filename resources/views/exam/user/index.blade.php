<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-purple-50 to-pink-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2
                    class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    اختباراتي
                </h2>
            </div>
            <div class="bg-white rounded-3xl shadow-2xl border border-purple-100 overflow-hidden">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-xl shadow-lg">
                            <thead class="bg-gradient-to-r from-pink-400 to-purple-500 text-white">
                                <tr>
                                    <th class="py-4 px-6 text-right text-lg font-semibold">رقم الاختبار</th>
                                    <th class="py-4 px-6 text-right text-lg font-semibold">التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                <tr class="bg-gray-50 border-b border-purple-100 hover:bg-pink-100 transition-all">
                                    <td class="py-4 px-6 text-lg text-gray-700 font-medium">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-6 text-lg text-gray-700">
                                        <a href="{{ route('exam.user.show', $exam) }}"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-600 text-white text-[16px] rounded-md hover:bg-yellow-700 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                            عرض
                                        </a>
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
</x-app-layout>