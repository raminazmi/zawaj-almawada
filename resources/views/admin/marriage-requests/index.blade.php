@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-purple-50 to-white">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-purple-800 inline-block relative pb-4">
                <i class="fas fa-heartbeat ml-3"></i>طلبات الخطوبة
            </h2>
        </div>

        <div class="mb-12">
            <h3 class="text-2xl font-semibold text-purple-700 mb-6 flex items-center gap-2">
                <i class="fas fa-hourglass-half text-purple-600"></i>الطلبات المعلقة للموافقة النهائية
            </h3>

            <div class="bg-white rounded-2xl shadow-xl border border-purple-100 overflow-hidden">
                @forelse($pendingRequests as $request)
                <div class="p-6 border-b border-purple-50 bg-white transition-all group">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-purple-600">
                                <i class="fas fa-hashtag"></i>
                                <span class="font-medium">رقم الطلب:</span>
                                <span class="font-bold">{{ $request->request_number }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user text-purple-600"></i>
                                <span class="font-medium">المرسل:</span>
                                <span class="text-gray-800">{{ $request->user->name }}</span>
                                <span class="text-sm px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                    {{ $request->user->gender === 'male' ? 'شاب' : 'فتاة' }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-bullseye text-purple-600"></i>
                                <span class="font-medium">المستهدف:</span>
                                <span class="text-gray-800">{{ $request->target->name }}</span>
                                <span class="text-sm px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                    {{ $request->target->gender === 'male' ? 'شاب' : 'فتاة' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span class="font-medium">التاريخ:</span>
                                <span class="text-gray-600">{{ $request->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 bg-green-100 p-4 rounded-lg">
                        <p><strong>بيانات المرسل:</strong></p>
                        <p>الاسم: {{ $request->user->name ?? 'غير متوفر' }}</p>
                        <p>الولاية: {{ $request->state ?? 'غير متوفر' }}</p>

                        <form method="POST" action="{{ route('admin.marriage-requests.send-test-link', $request->id) }}"
                            class="mt-4 flex justify-end">
                            @csrf
                            <button type="submit"
                                class="flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                                <i class="fas fa-link ml-2"></i><span>إرسال رابط المقياس</span>
                            </button>
                        </form>
                    </div>

                    <div class="mt-6 border-t border-green-200 pt-4">
                        <div class="flex flex-wrap gap-4 justify-between items-center">
                            <div class="flex-1 min-w-[200px]">
                                <p class="text-sm text-green-800 mb-2">
                                    <i class="fas fa-info-circle ml-2"></i>مراجعة نهائية من الإدارة
                                </p>
                            </div>

                            <div class="flex gap-3 w-full md:w-auto">
                                <form method="POST"
                                    action="{{ route('admin.marriage-requests.approve-final', $request->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg 
                                                       hover:bg-green-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm
                                                       transform hover:scale-[1.02]">
                                        <i class="fas fa-check-circle"></i>
                                        موافقة نهائية
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('admin.marriage-requests.reject', $request->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg 
                                                       hover:bg-red-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm
                                                       transform hover:scale-[1.02]">
                                        <i class="fas fa-times-circle"></i>
                                        رفض الطلب
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center p-12">
                    <div class="text-6xl text-purple-200 mb-4"><i class="fas fa-inbox"></i></div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">لا توجد طلبات معلقة للموافقة النهائية</h3>
                    <p class="text-gray-600">سيظهر هنا أي طلبات جديدة تحتاج لمراجعتك</p>
                </div>
                @endforelse
            </div>
        </div>

        <div>
            <h3 class="text-2xl font-semibold text-purple-700 mb-6 flex items-center gap-2">
                <i class="fas fa-history text-purple-600"></i>الطلبات السابقة
            </h3>

            <div class="bg-white rounded-2xl shadow-xl border border-purple-100 overflow-hidden">
                @forelse($allRequests as $request)
                <div class="p-6 border-b border-purple-50 hover:bg-purple-50 transition-all group">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-purple-600">
                                <i class="fas fa-hashtag"></i>
                                <span class="font-medium">رقم الطلب:</span>
                                <span class="font-bold">{{ $request->request_number }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user text-purple-600"></i>
                                <span class="font-medium">المرسل:</span>
                                <span class="text-gray-800">{{ $request->user->name }}</span>
                                <span class="text-sm px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                    {{ $request->user->gender === 'male' ? 'شاب' : 'فتاة' }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-bullseye text-purple-600"></i>
                                <span class="font-medium">المستهدف:</span>
                                <span class="text-gray-800">{{ $request->target->name }}</span>
                                <span class="text-sm px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                    {{ $request->target->gender === 'male' ? 'شاب' : 'فتاة' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span class="font-medium">التاريخ:</span>
                                <span class="text-gray-600">{{ $request->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-4">
                        <span class="font-medium">الحالة:</span>
                        @if($request->admin_approval_status === 'approved')
                        <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-green-100 text-green-800'=>
                            $request->admin_approval_status === 'approved',
                            ])>
                            مكتمل ومعتمد
                        </span>
                        @endif

                        @if($request->admin_approval_status === 'rejected')
                        <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                            $request->admin_approval_status === 'rejected',
                            ])>
                            مرفوض من الادارة
                        </span>
                        @endif

                        @if($request->status === 'rejected')
                        <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                            $request->status ===
                            'rejected',
                            ])>
                            مرفوض من أحد الطرفين
                        </span>
                        @endif

                        @if($request->status === 'pending')
                        <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-yellow-100 text-yellow-800'=>
                            $request->status ===
                            'pending',
                            ])>
                            قيد المراجعة من قبل أحد الطرفين
                        </span>
                        @endif

                        @if($request->status === 'approved')
                        <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-blue-100 text-blue-800'=>
                            $request->status ===
                            'approved',
                            ])>
                            موافق عليه من الطرفين
                        </span>
                        @endif

                        @if($request->admin_approval_status === 'pending')
                        <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-orange-100 text-orange-800'=>
                            $request->admin_approval_status === 'pending',
                            ])>
                            بانتظار الموافقة النهائية
                        </span>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.marriage-requests.pending', $request->id) }}"
                    class="flex items-center justify-end p-2">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg 
                   hover:bg-purple-700 transition-all shadow-md hover:shadow-lg gap-3
                   transform hover:scale-[1.02]">
                        <i class="fas fa-undo text-white"></i>
                        <span>التراجع عن الإجراء</span>
                    </button>
                </form>
                @empty
                <div class="text-center p-12">
                    <div class="text-6xl text-purple-200 mb-4"><i class="fas fa-inbox"></i></div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">لا توجد طلبات سابقة</h3>
                    <p class="text-gray-600">سيظهر هنا أي طلبات تمت معالجتها</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection