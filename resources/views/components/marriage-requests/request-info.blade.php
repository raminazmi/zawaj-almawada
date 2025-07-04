<div class="flex flex-wrap items-center gap-2">
    <span class="font-medium text-gray-600">رقم الطلب:</span>
    <span class="badge bg-purple-100 text-purple-800">{{ $request->request_number }}</span>
</div>
<div class="flex flex-wrap items-center gap-2">
    <span class="font-medium text-gray-600">المرسل:</span>
    <span class="text-gray-800">{{ $request->user->name ?? 'غير محدد' }}</span>
</div>
<div class="flex flex-wrap items-center gap-2">
    <span class="font-medium text-gray-600">المستهدف:</span>
    <span class="text-gray-800">{{ $request->target->name ?? 'غير محدد' }}</span>
</div>
<div class="flex items-center gap-2 mt-4">
    <span class="font-medium text-gray-600">الحالة:</span>
    @if($request->admin_approval_status === 'approved')
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-green-100 text-green-800'=>
        $request->admin_approval_status === 'approved'])>
        مكتمل ومعتمد
    </span>
    @elseif($request->admin_approval_status === 'rejected')
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-red-100 text-red-800'=>
        $request->admin_approval_status === 'rejected'])>
        مرفوض من الإدارة
    </span>
    @elseif($request->admin_approval_status === 'pending')
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-orange-100 text-orange-800'=>
        $request->admin_approval_status === 'pending'])>
        بانتظار موافقة الإدارة
    </span>
    @endif
    @if($request->status === 'rejected')
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-red-100 text-red-800'=> $request->status ===
        'rejected'])>
        مرفوض من احد الطرفين
    </span>
    @elseif($request->status === 'pending')
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-yellow-100 text-yellow-800'=> $request->status ===
        'pending'])>
        قيد المراجعة من الطرف الآخر
    </span>
    @elseif($request->status === 'approved' && ($request->user_approval === null || $request->target_approval === null))
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-orange-100 text-orange-800'=> $request->status ===
        'approved'])>
        بانتظار الموافقة النهائية
    </span>
    @elseif($request->status === 'awaiting_admin_approval')
    <span @class(['px-3 py-1 rounded-full text-sm font-medium', 'bg-blue-100 text-blue-800'=> $request->status ===
        'awaiting_admin_approval'])>
        تم الموافقة النهائية من الطرفين
    </span>
    @endif
</div>