@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        @if($request->status === 'pending')
        <div class="bg-yellow-100 p-4 rounded">
            طلبك قيد المراجعة من قبل الإدارة
        </div>
        @elseif($request->status === 'approved')
        <div class="bg-green-100 p-4 rounded">
            <!-- عرض قائمة المرشحين -->
            @foreach($suggestions as $suggestion)
            <div class="border p-4 mb-4">
                <h3 class="text-xl font-bold">{{ $suggestion->user->name }}</h3>
                <button @click="propose({{ $suggestion->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">
                    التقدم للخطوبة
                </button>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection