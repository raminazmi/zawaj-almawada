@php
$token = request('token') ?? request()->route('token');
@endphp
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                معلوماتك الشخصية
            </h2>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl border border-purple-100 overflow-hidden">
            <div class="p-8">
                @if (!auth()->user()->age)
                <form method="POST" action="{{ route('gender.update') }}" class="space-y-8">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                            <x-input-label for="skin_color" value="لون البشرة" class="text-lg text-purple-900 mb-2" />
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
                @else
                <script>
                    window.location.href = "{{ route('exam.pledge', ['token' => $token]) }}";
                </script>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection