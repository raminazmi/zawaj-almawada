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

    public function convertToEmbedUrl($url)
    {
        if (empty($url)) {
            return null;
        }
        if (str_contains($url, 'youtube.com/embed')) {
            return $url;
        }
        $pattern = '~
        (?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)
        ([^"&?/\s]{11})
    ~ix';
        if (preg_match($pattern, $url, $matches)) {
            $videoId = $matches[1];
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return $url;
    }

    public function store(Request $request)
    {
        $validated =  $request->validate([
            'link' => 'required|url',
        ], [
            'link.required' => 'حقل الرابط مطلوب',
            'link.url' => 'الرابط يجب أن يكون عنوان URL صالح',
        ]);

        if (!empty($validated['link'])) {
            $validated['link'] = $this->convertToEmbedUrl($validated['link']);
        }

        MarriageVideoLink::updateOrCreate(
            ['id' => MarriageVideoLink::first()?->id],
            ['link' => $validated['link']]
        );

        return redirect()->route('admin.marriage_video_link.index')
            ->with('success', 'تم حفظ الرابط بنجاح');
    }

    public function update(Request $request, MarriageVideoLink $marriageVideoLink)
    {
        $validated = $request->validate([
            'link' => 'required|url',
        ], [
            'link.required' => 'حقل الرابط مطلوب',
            'link.url' => 'الرابط يجب أن يكون عنوان URL صالح',
        ]);

        if (!empty($validated['link'])) {
            $validated['link'] = $this->convertToEmbedUrl($validated['link']);
        }

        $marriageVideoLink->update(['link' => $validated['link']]);

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
