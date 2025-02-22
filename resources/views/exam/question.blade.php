@if ($question)
<div class="p-6 text-gray-900">
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
            class="action__btn w-[100%] hover:scale-105 md:w-80 py-2 text-md flex justify-center items-center border border-transparent rounded-xl font-semibold text-white uppercase tracking-wide transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-green-400 bg-green-600 scale-100 shadow-lg">
            ✅ نعم
        </button>
        <button type="button" data-id="{{ $question->id }}" data-answer="0"
            class="action__btn w-[100%] hover:scale-105 md:w-80 py-2 text-md flex justify-center items-center border border-transparent rounded-xl font-semibold text-white uppercase tracking-wide transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-red-400 bg-red-600 scale-100 shadow-lg">
            ❌ لا
        </button>
    </div>
</div>

<div class="mt-6 px-3">
    <div class="w-full bg-gray-300 rounded-full h-3">
        <div class="bg-gradient-to-r from-green-600 to-green-400 h-3 rounded-full"
            style="width: {{ ((session('currentQuestion') ?? 1) / $questionsCount) * 100 }}%"></div>
    </div>
    <p class="text-center mt-4 text-lg text-gray-700 font-medium">
        سؤال {{ session('currentQuestion') ?? 1 }} من أصل {{ $questionsCount }} أسئلة
    </p>
</div>

<div class="p-6">
    <div class="bg-purple-50 p-4 rounded-xl border border-purple-200 my-6">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-purple-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd" />
            </svg>
            <h4 class="font-semibold text-purple-900">تعليمات الإجابة:</h4>
        </div>
        <ul class="list-disc list-inside text-sm text-purple-700 space-y-2">
            <li>
                إذا كنت تعتبر السؤال ذو أهمية قصوى<strong class="text-red-500">(خط أحمر)</strong> في قبول أو رفض الزواج بالطرف الآخر فضع المؤشر على أنها حاسمة قبل أن تجيب بنعم أو لا.
            </li>
<li>
    انتبه لا تجب قبل فهمك للسؤال بدقة، فالمقياس ليس به تراجع عن الإجابة.
</li>
<li>
صدقك ودقتك في الإجابة تمنحك دقة في النتائج.
</li>
        </ul>
    </div>
</div>
@else
<div class="p-6 text-gray-900 ">
    <div class="mb-4">
        <p>الاختبار مكتمل. سيتم التحويل....</p>
    </div>
</div>
@endif
