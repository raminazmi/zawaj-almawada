<?php

namespace App\Http\Controllers\AddActivity;

use App\Models\BusinessActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessActivityController extends Controller
{
    public function showByType($type)
    {
        $activities = BusinessActivity::where('activity_type', $type)
            ->where('status', 'مقبول')
            ->get();

        $title = $type;
        return view('add-activity.show', compact('activities', 'title'));
    }

    public function create()
    {
        return view('add-activity.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'activity_type' => ['required', 'in:' . implode(',', BusinessActivity::ACTIVITY_TYPES)],
            'state' => ['required', 'string'],
            'rewards' => ['required', 'in:yes,no'],
            'botcheck' => ['nullable']
        ], [
            'name.required' => 'اسم المحل مطلوب',
            'name.string' => 'يجب أن يكون اسم المحل نصاً',
            'name.max' => 'يجب ألا يتجاوز اسم المحل 255 حرفاً',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.numeric' => 'يجب أن يكون رقم الهاتف رقماً',
            'activity_type.required' => 'يرجى اختيار نوع النشاط',
            'activity_type.in' => 'نوع النشاط المختار غير صحيح',
            'state.required' => 'الولاية مطلوبة',
            'state.string' => 'يجب أن تكون الولاية نصاً',
            'rewards.required' => 'يرجى اختيار ما إذا كنت مستعد لتقديم جوائز أم لا',
            'rewards.in' => 'القيمة المختارة للجوائز غير صحيحة. الرجاء اختيار "نعم" أو "لا"'
        ]);

        // Check for bot
        if ($request->filled('botcheck')) {
            return redirect()->back()->with('error', 'تم اكتشاف محاولة بوت');
        }

        try {
            BusinessActivity::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'activity_type' => $request->activity_type,
                'state' => $request->state,
                'offers_rewards' => $request->rewards === 'yes',
                'status' => 'قيد الانتظار'
            ]);

            return redirect()->back()->with('success', 'تم إرسال النشاط بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حفظ البيانات')
                ->withInput();
        }
    }

    public function index()
    {
        $activities = BusinessActivity::paginate(10);
        return view('admin.shops.index', compact('activities'));
    }

    public function updateStatus(Request $request, BusinessActivity $businessActivity)
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', BusinessActivity::STATUSES)]
        ], [
            'status.required' => 'يرجى اختيار حالة الطلب',
            'status.in' => 'الحالة المختارة غير صحيحة'
        ]);

        $businessActivity->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.shops')
            ->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    public function destroy($id)
    {
        $businessActivity = BusinessActivity::findOrFail($id);
        $businessActivity->delete();
        return redirect()->route('admin.shops');
    }
}
