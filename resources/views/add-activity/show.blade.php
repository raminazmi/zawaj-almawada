@extends('layouts.app')

@section('content')
<section class="islamic-pattern px-4 py-8 md:p-14 md:pt-18 md:pb-24">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-purple-900 mb-8 text-center">{{ $title }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($activities as $activity)
            <div class="activity-card p-6 rounded-xl shadow-md relative">
                <div class="badge">
                    <i class="fas fa-heart ml-2"></i>متوفر
                </div>
                @if ($activity->image)
                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}"
                    class="w-full h-48 object-cover rounded-t-xl mb-4">
                @endif
                <h2 class="text-xl font-bold text-purple-900 mb-3 flex items-center">
                    <i class="fas fa-ring ml-4 text-purple-900"></i>
                    {{ $activity->name }}
                </h2>
                <div class="space-y-2">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-phone ml-2 text-purple-900"></i>
                        {{ $activity->phone }}
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-map-marker-alt ml-2 text-purple-900"></i>
                        {{ $activity->state }}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-700 text-lg mb-4">
                    <i class="fas fa-exclamation-circle text-3xl text-[#d4b341]"></i>
                </div>
                <p class="text-gray-700">لا توجد محلات متاحة حاليًا.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection