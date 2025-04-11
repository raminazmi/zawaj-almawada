<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReadinessTestLink;
use Illuminate\Http\Request;

class ReadinessTestLinkController extends Controller
{
    public function index()
    {
        $link = ReadinessTestLink::firstOrNew();
        return view('admin.readiness_test_link.index', compact('link'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
        ], [
            'link.required' => 'حقل الرابط مطلوب',
            'link.url' => 'الرابط يجب أن يكون عنوان URL صالح',
        ]);

        ReadinessTestLink::updateOrCreate(
            ['id' => ReadinessTestLink::first()?->id],
            ['link' => $request->link]
        );

        return redirect()->route('admin.readiness_test_link.index')
            ->with('success', 'تم حفظ الرابط بنجاح');
    }

    public function update(Request $request, ReadinessTestLink $readinessTestLink)
    {
        $request->validate([
            'link' => 'required|url',
        ], [
            'link.required' => 'حقل الرابط مطلوب',
            'link.url' => 'الرابط يجب أن يكون عنوان URL صالح',
        ]);

        $readinessTestLink->update(['link' => $request->link]);

        return redirect()->route('admin.readiness_test_link.index')
            ->with('success', 'تم تحديث الرابط بنجاح');
    }

    public function destroy(ReadinessTestLink $readinessTestLink)
    {
        $readinessTestLink->delete();

        return redirect()->route('admin.readiness_test_link.index')
            ->with('success', 'تم حذف الرابط بنجاح');
    }
}
