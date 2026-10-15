<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditorUploadController extends Controller
{
    /**
     * Receive an image dropped/selected inside a CKEditor instance and return its public URL.
     *
     * CKEditor's SimpleUploadAdapter posts the file under the "upload" field and only
     * inspects the JSON body for an "error" key (it ignores the HTTP status), so failures
     * are reported as {"error": {"message": "..."}} instead of a plain 422 payload.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'upload' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
        ], [
            'upload.required' => 'فایلی برای آپلود ارسال نشد.',
            'upload.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'upload.mimes' => 'فرمت تصویر باید jpg، jpeg، png، webp یا gif باشد.',
            'upload.max' => 'حجم تصویر نباید بیشتر از ۴ مگابایت باشد.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => ['message' => $validator->errors()->first()],
            ], 422);
        }

        $name = $request->file('upload')->hashName();

        $request->file('upload')->storeAs('images/products/description/', $name, 'public');

        return response()->json([
            'url' => url('images/products/description/'.$name),
        ]);
    }
}
