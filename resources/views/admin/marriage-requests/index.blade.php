@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-purple-50 to-white">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-purple-800 inline-block relative pb-4">
                <i class="fas fa-heartbeat ml-3"></i>طلبات الخطوبة
            </h2>
        </div>

        <div class="mb-12">
            <h3 class="text-xl font-semibold text-purple-700 mb-6 flex items-center gap-2">
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
                    @if($request->exam && $request->exam->male_finished && $request->exam->female_finished)
                    <div class="mt-6 p-6 bg-gray-50 rounded-2xl shadow-xl border border-purple-100">
                        <h3 class="text-xl font-semibold text-purple-700 mb-4">نتائج اختبار مقياس الزواج</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-lg font-medium text-gray-800 mb-2">نتيجة الاختبار العامة</h4>
                                <p class="text-2xl font-bold text-green-600">{{ $request->exam->calculateScore() }}%</p>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-800 mb-2">الأسئلة المهمة</h4>
                                <?php
                                        $maleImportantScore = $request->exam->importantScore('male');
                                        $femaleImportantScore = $request->exam->importantScore('female');
                                        $totalImportant = $maleImportantScore['total'] + $femaleImportantScore['total'];
                                    ?>
                                <p class="text-gray-700">إجمالي الأسئلة المهمة: {{ $totalImportant }}</p>
                                <p class="text-gray-700">نقاط الذكر: {{ $maleImportantScore['score'] }} / {{
                                    $maleImportantScore['total'] }}</p>
                                <p class="text-gray-700">نقاط الأنثى: {{ $femaleImportantScore['score'] }} / {{
                                    $femaleImportantScore['total'] }}</p>
                            </div>
                        </div>
                    </div>
                    @elseif($request->exam)
                    <div class="mt-6 p-6 bg-yellow-100 rounded-2xl shadow-xl border border-yellow-200">
                        <p class="text-yellow-800">الاختبار لم يكتمل بعد من كلا الطرفين.</p>
                    </div>
                    @else
                    <div class="mt-6 p-6 bg-yellow-100 rounded-2xl shadow-xl border border-yellow-200">
                        <p class="text-yellow-800">لم يتم إجراء اختبار مقياس الزواج لهذا الطلب بعد.</p>
                    </div>
                    @endif

                    <div class="mt-6">
                        <div class="flex flex-wrap gap-4 justify-between items-center pb-4 border-b border-green-200">
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
                        <div class="flex items-center justify-center gap-4 px-4 pt-4">
                            <a href="{{ route('admin.profile-approvals.show', $request->user->id) }}"
                                class="text-purple-600 hover:text-purple-800 flex items-center gap-2">
                                <i class="fas fa-eye"></i>
                                عرض ملف المرسل
                            </a>
                            <a href="{{ route('admin.profile-approvals.show', $request->target->id) }}"
                                class="text-purple-600 hover:text-purple-800 flex items-center gap-2">
                                <i class="fas fa-eye"></i>
                                عرض ملف المستهدف
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center p-12">
                    <div class="text-6xl text-purple-200 mb-4"><i class="fas fa-inbox"></i></div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد طلبات معلقة للموافقة النهائية</h3>
                    <p class="text-gray-600">سيظهر هنا أي طلبات جديدة تحتاج لمراجعتك</p>
                </div>
                @endforelse
            </div>
        </div>

        <div>
            <h3 class="text-xl font-semibold text-purple-700 mb-6 flex items-center gap-2">
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
                <div class="flex items-center justify-center sm:justify-between flex-wrap gap-2">
                    <div class="flex items-center justify-start gap-4 px-4 py-2">
                        <a href="{{ route('admin.profile-approvals.show', $request->user->id) }}"
                            class="text-purple-600 hover:text-purple-800 flex items-center gap-2">
                            <i class="fas fa-eye"></i>
                            عرض ملف المرسل
                        </a>
                        <a href="{{ route('admin.profile-approvals.show', $request->target->id) }}"
                            class="text-purple-600 hover:text-purple-800 flex items-center gap-2">
                            <i class="fas fa-eye"></i>
                            عرض ملف المستهدف
                        </a>
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
                </div>
                @empty
                <div class="text-center p-12">
                    <div class="text-6xl text-purple-200 mb-4"><i class="fas fa-inbox"></i></div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد طلبات سابقة</h3>
                    <p class="text-gray-600">سيظهر هنا أي طلبات تمت معالجتها</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush