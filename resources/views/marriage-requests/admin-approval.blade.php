@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6 min-h-screen">
    <h2 class="text-3xl font-bold mb-6 text-center text-purple-800 border-b-[3px] pb-3 border-[#d4b341]">
        طلبات الخطوبة المعلقة
    </h2>
    <div class="bg-white rounded-lg shadow-md p-6">
        @forelse($requests as $request)
        <div class="border-b py-4">
            <p><strong>رقم الطلب:</strong> {{ $request->request_number }}</p>
            <p><strong>الطالب:</strong> {{ $request->user->name }} ({{ $request->user->gender === 'male' ? 'شاب' :
                'فتاة' }})</p>
            <p><strong>المستهدف:</strong> {{ $request->target->name }} ({{ $request->target->gender === 'male' ? 'شاب' :
                'فتاة' }})</p>
            <p><strong>الحالة:</strong> قيد المراجعة</p>
            <div class="flex space-x-4 mt-4">
                <form method="POST" action="{{ route('marriage-requests.approve', $request->id) }}">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">موافقة</button>
                </form>
                <form method="POST" action="{{ route('marriage-requests.reject', $request->id) }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">رفض</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-600">لا يوجد طلبات خطوبة معلقة حاليًا</p>
        @endforelse
    </div>
</section>
@endsection