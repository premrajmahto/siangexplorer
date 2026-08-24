<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $input = $request->except(['_token', '_method', 'site_logo', 'site_favicon']);

        // Checkboxes handling
        $checkboxKeys = ['hero_search_enabled', 'hero_search_show_destination', 'hero_search_show_tour_type', 'hero_search_show_duration'];
        foreach ($checkboxKeys as $cbKey) {
            if ($request->has($cbKey . '_submitted')) {
                $input[$cbKey] = $request->has($cbKey) ? '1' : '0';
                unset($input[$cbKey . '_submitted']);
            }
        }

        foreach ($input as $key => $value) {
            Setting::set($key, (string) $value);
        }

        if ($request->hasFile('site_logo')) {
            $logoPath = ImageService::upload($request->file('site_logo'), 'branding');
            Setting::set('site_logo', $logoPath);
        }

        if ($request->hasFile('site_favicon')) {
            $faviconPath = ImageService::upload($request->file('site_favicon'), 'branding');
            Setting::set('site_favicon', $faviconPath);
        }

        return back()->with('success', 'System settings updated successfully!');
    }
}
