@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                قائمة الفتيات المتاحات
            </h1>
        </div>

        <div class="mb-6 text-center">
            <a href="{{ route('marriage-requests.status') }}"
                class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                حالة طلباتي
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($girls as $girl)
            @if($girl->is_admin == 1 || $girl->id == Auth::id()) @continue @endif
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden border border-purple-100 transition-all hover:shadow-xl">
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $girl->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $girl->age }} سنة</p>
                            <p class="text-sm text-gray-600"> {{ $girl->skin_color }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <span @class([ 'px-3 py-1 rounded-full text-sm' , 'bg-green-100 text-green-800'=> $girl->status
                            === 'available',
                            'bg-red-100 text-red-800' => $girl->status !== 'available'
                            ])>
                            {{ $girl->status === 'available' ? 'متاحة' : 'غير متاحة' }}
                        </span>

                        @if($girl->status === 'available')
                        @if(Auth::user()->gender === $girl->gender)
                        <p class="text-red-600 text-sm">لا يمكن تقديم طلب لشخص من نفس الجنس</p>
                        @else
                        <a href="{{ route('marriage-requests.create-proposal', $girl->id) }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            تقديم طلب
                        </a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-xl p-6 text-center text-gray-600 shadow-sm">
                    لا يوجد فتيات متاحات حالياً
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection