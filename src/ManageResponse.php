<?php

namespace Erjon\ManageResponse;

use Illuminate\Http\RedirectResponse;

class ManageResponse
{
    public static function viewSuccess(string $view, string $title, string $body): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($view)->with([
            'success' => true,
            'successTitle' => $title,
            'successBody' => $body
        ]);
    }

    public static function viewError(string $view, string $title, string $body, array $errors = []): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($view)->with([
            'error' => true,
            'errorTitle' => $title,
            'errorBody' => $body,
            'errors' => $errors
        ]);
    }

    public static function backSuccess(string $title, string $body): RedirectResponse
    {
        return back()->with([
            'success' => true,
            'successTitle' => $title,
            'successBody' => $body
        ]);
    }

    public static function backError(string $title, string $body, array $errors = []): RedirectResponse
    {
        return back()->with([
            'error' => true,
            'errorTitle' => $title,
            'errorBody' => $body,
            'errors' => $errors
        ]);
    }

    public static function viewExceptionError(string $view, \Exception $exception): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view($view)->with([
            'error' => true,
            'errorBody' => $exception->getMessage(),
            'errors' => method_exists($exception, 'errors') ? $exception->errors() : []
        ]);
    }

    public static function backExceptionError(\Exception $exception): RedirectResponse
    {
        return back()->with([
            'error' => true,
            'errorBody' => $exception->getMessage(),
            'errors' => method_exists($exception, 'errors') ? $exception->errors() : []
        ]);
    }

    public static function createValidationErrorSession(string $title, array $failed): void
    {
        $errorsCount = count($failed);
        $body = trans_choice('manage-response::manage_response.errorBody', $errorsCount, ['count' => $errorsCount]);

        \Session::put('error', true);
        \Session::put('errorTitle', $title);
        \Session::put('errorBody', $body);
    }
}
