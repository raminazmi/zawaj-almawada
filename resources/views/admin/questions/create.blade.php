<x-app-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    إضافة سؤال جديد
                </h2>
            </div>

            <form action="{{ route('admin.questions.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="male_question" class="block text-sm font-medium text-gray-700">السؤال للخاطب</label>
                    <textarea id="male_question" name="male_question" rows="3" required
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>

                <div>
                    <label for="female_question" class="block text-sm font-medium text-gray-700">السؤال للمخطوبة</label>
                    <textarea id="female_question" name="female_question" rows="3" required
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">اختر الإجابات المتوافقة</label>
                    <div class="bg-gray-100 p-4 rounded-lg space-y-2">
                        @foreach ($answers as $key => $answer)
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="answer_{{ $loop->index }}" name="correct_answers[]"
                                value="{{ $answer }}"
                                class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <label for="answer_{{ $loop->index }}" class="ml-2 text-sm text-gray-700">{{ $key }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg shadow-md hover:opacity-90 transition-all">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>