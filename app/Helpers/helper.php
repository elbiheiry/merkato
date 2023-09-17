<?php

if (!function_exists('failed_validation')) {
    /**
     * show validation message when validation fails
     *
     * @param Validation $error
     * @return void
     */
    function failed_validation($error)
    {
        return response()->json($error, 400);
    }
}

if (!function_exists('add_response')) {
    function add_response()
    {
        return response()->json('تم إضافة البيانات بنجاح', 200);
    }
}

if (!function_exists('update_response')) {
    function update_response()
    {
        return response()->json('تم تحديث البيانات بنجاح', 200);
    }
}

if (!function_exists('error_response')) {
    function error_response()
    {
        return response()->json('لقد حدث خطأ برجاء المحاولة مرة أخري', 400);
    }
}

if (!function_exists('success_response')) {
    function success_response($message)
    {
        return response()->json($message, 200);
    }
}

if (!function_exists('locale')) {
    function locale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('sanctum')) {
    function sanctum()
    {
        return auth()->guard('sanctum');
    }
}

if (!function_exists('api_response_success')) {
    function api_response_success($data)
    {
        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    }
}

if (!function_exists('api_response_error')) {
    function api_response_error($message = null)
    {
        $message = $message != null ? $message : 'لقد حدث خطأ برجاء المحاولة مرة أخري';

        return response()->json([
            'status' => false,
            'message' => $message,
        ], 400);
    }
}

if (!function_exists('module_path')) {
    function module_path($name, $path = '')
    {
        return app()->basePath() . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $name .  $path;
    }
}