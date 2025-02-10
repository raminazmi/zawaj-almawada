<x-app-layout>
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h2
                    class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    مقياس التوافق الزواجي
                </h2>
                <p class="mt-4 text-lg text-purple-700">أجب بصدق لتحصل على نتائج دقيقة</p>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-purple-100 overflow-hidden">
                <div class="p-8">
                    @if (!auth()->user()->age)
                    <!-- Personal Information Form -->
                    <div class="max-w-3xl mx-auto">
                        <div class="mb-8 text-center">
                            <h3 class="text-2xl font-bold text-purple-900 mb-4">المعلومات الشخصية</h3>
                            <p class="text-gray-600">من فضلك قم بإدخال معلوماتك الشخصية لبدء المقياس</p>
                        </div>

                        <form method="POST" action="{{ route('gender.update') }}" class="space-y-8">
                            @csrf
                            <input type="hidden" name="token" value="{{ request('token') }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @if (!auth()->user()->gender)
                                <div class="col-span-full md:col-span-1">
                                    <x-input-label for="gender" value="النوع" class="text-lg text-purple-900 mb-2" />
                                    <select id="gender" required name="gender"
                                        class="block w-full rounded-xl border-pink-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300 hover:border-purple-400 text-lg py-3">
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                </div>
                                @endif
                                <div>
                                    <x-input-label for="age" value="العمر" class="text-lg text-purple-900 mb-2" />
                                    <input id="age" required name="age" type="text"
                                        class="block w-full rounded-xl border-pink-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300 hover:border-purple-400 text-lg py-3"
                                        placeholder="25" />
                                    <x-input-error class="mt-2" :messages="$errors->get('age')" />
                                </div>
                                <div>
                                    <x-input-label for="weight" value="الوزن" class="text-lg text-purple-900 mb-2" />
                                    <input id="weight" required name="weight" type="text"
                                        class="block w-full rounded-xl border-pink-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300 hover:border-purple-400 text-lg py-3"
                                        placeholder="70" />
                                    <x-input-error class="mt-2" :messages="$errors->get('weight')" />
                                </div>
                                <div>
                                    <x-input-label for="height" value="الطول" class="text-lg text-purple-900 mb-2" />
                                    <input id="height" required name="height" type="text"
                                        class="block w-full rounded-xl border-pink-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300 hover:border-purple-400 text-lg py-3"
                                        placeholder="170" />
                                    <x-input-error class="mt-2" :messages="$errors->get('height')" />
                                </div>
                                <div>
                                    <x-input-label for="skin_color" value="لون البشرة"
                                        class="text-lg text-purple-900 mb-2" />
                                    <select id="skin_color" required name="skin_color"
                                        class="block w-full rounded-xl border-pink-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300 hover:border-purple-400 text-lg py-3">
                                        <option value="بيضاء">بيضاء</option>
                                        <option value="حنطية">حنطية</option>
                                        <option value="سمراء">سمراء</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('skin_color')" />
                                </div>
                            </div>
                            <div class="flex items-center justify-center mt-8">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-700 text-white text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                    حفظ المعلومات
                                </button>
                            </div>
                        </form>
                    </div>
                    @else
                    <!-- Test Start Section -->
                    <div class="max-w-3xl mx-auto">
                        <div class="bg-pink-50 rounded-2xl p-8 mb-8 border border-pink-200">
                            <h2 class="flex flex-col items-start">
                                <span class="flex flex-col space-y-4">
                                    <span class="text-xl font-bold text-purple-900 mb-4 flex items-center">
                                        <i class="fas fa-exclamation-circle ml-2"></i>
                                        قسم الاستخدام:
                                    </span>
                                    <p class="text-gray-700 leading-relaxed text-lg">
                                        حتى أكون صادقاً أمام الله وأمام الطرف الآخر، أقسم بالله العظيم أن أجيب بصدق
                                        تام
                                        على كل عبارات المقياس،
                                        <br>
                                        كما أقسم ألا أنسخ أو أصور أو استخدام المقياس في أي موضع آخر دون أذن صاحبه.
                                    </p>
                                </span>
                                <label for="swearCheckbox"
                                    class="inline-flex items-center mt-6 cursor-pointer hover:opacity-90 transition-opacity">
                                    <input id="swearCheckbox" type="checkbox"
                                        class="form-checkbox h-6 w-6 ml-3 text-yellow-600 border-pink-300 rounded-lg transition-all duration-300">
                                    <span class="text-xl font-bold text-purple-900">أُقسم</span>
                                </label>
                            </h2>
                        </div>

                        @php
                        $token = request('token') ?? request()->route('token');
                        @endphp

                        <div class="text-center">
                            <a id="startTestButton" href="{{ route('exam.index', ['token' => $token]) }}"
                                class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-700 text-white text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                <i class="fas fa-play-circle ml-2"></i>
                                ابدأ الاختبار الآن
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('startTestButton')?.addEventListener('click', function(event) {
            const swearCheckbox = document.getElementById('swearCheckbox');
            if (!swearCheckbox?.checked) {
                event.preventDefault();
                alert('يجب عليك الضغط على "أقسم" قبل بدء الاختبار.');
            }
        });
    </script>
</x-app-layout>