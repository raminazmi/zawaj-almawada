<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarriageVideoLink;
use Illuminate\Http\Request;

class MarriageVideoLinkController extends Controller
{
    public function index()
    {
        $link = MarriageVideoLink::firstOrNew();
        return view('admin.marriage_video_link.index', compact('link'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
        ], [
            'link.required' => 'حقل الرابط مطلوب',
            'link.url' => 'الرابط يجب أن يكون عنوان URL صالح',
        ]);

        MarriageVideoLink::updateOrCreate(
            ['id' => MarriageVideoLink::first()?->id],
            ['link' => $request->link]
        );

        return redirect()->route('admin.marriage_video_link.index')
            ->with('success', 'تم حفظ الرابط بنجاح');
    }

    public function update(Request $request, MarriageVideoLink $marriageVideoLink)
    {
        $request->validate([
            'link' => 'required|url',
        ]);

        $marriageVideoLink->update(['link' => $request->link]);

        return redirect()->route('admin.marriage_video_link.index')
            ->with('success', 'تم تحديث الرابط بنجاح');
    }

    public function destroy(MarriageVideoLink $marriageVideoLink)
    {
        $marriageVideoLink->delete();

        return redirect()->route('admin.marriage_video_link.index')
            ->with('success', 'تم حذف الرابط بنجاح');
    }
}
