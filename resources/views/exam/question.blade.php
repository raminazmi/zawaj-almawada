@if ($question)
<div class="p-6 text-gray-900 ">
    <div class="text-center">
        <p
            class="text-purple-900 text-lg md:text-2xl my-6 font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
            {{ $question->question }}
        </p>
    </div>
    <div class="flex items-center mt-4 justify-center">
        <input type="checkbox" id="is_important"
            class="form-checkbox h-5 w-5 text-yellow-600 border-pink-300 rounded-lg transition-all duration-300">
        <label for="is_important" class="mr-2 text-lg text-gray-700">هل هذه العبارة حاسمة</label>
    </div>
    <div class="flex flex-col items-center justify-center mt-6 space-y-4">
        <button type="button" data-id="{{ $question->id }}" data-answer="1"
            class="action__btn w-[100%] md:w-80 py-2 text-md flex justify-center items-center border border-transparent rounded-xl font-semibold text-white uppercase tracking-wide transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-green-400 bg-green-600 scale-105 shadow-lg">
            ✅ نعم
        </button>
        <button type="button" data-id="{{ $question->id }}" data-answer="0"
            class="action__btn w-[100%] md:w-80 py-2 text-md flex justify-center items-center border border-transparent rounded-xl font-semibold text-white uppercase tracking-wide transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-red-400 bg-red-600 scale-105 shadow-lg">
            ❌ لا
        </button>
    </div>
</div>
<!-- Progress Bar -->
<div class="mt-6 px-3">
    <div class="w-full bg-gray-300 rounded-full h-3">
        <div class="bg-gradient-to-r from-green-600 to-green-400 h-3 rounded-full"
            style="width: {{ ((session('currentQuestion') ?? 1) / $questionsCount) * 100 }}%"></div>
    </div>
    <p class="text-center mt-4 text-lg text-gray-700 font-medium">
        سؤال {{ session('currentQuestion') ?? 1 }} من أصل {{ $questionsCount }} أسئلة
    </p>
</div>

@else
<div class="p-6 text-gray-900 ">
    <div class="mb-4">
        <p>الاختبار مكتمل. سيتم التحويل....</p>
    </div>
</div>
@endif