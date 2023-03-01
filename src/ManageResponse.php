<?php

namespace Erjon\ManageResponse;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ManageResponse
{
    /**
     * Returns a view with a success message title and description
     *
     * @param string $view
     * @param string $title
     * @param string $description
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function viewSuccess(string $view, string $title, string $description): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($view)->with([
            'success' => true,
            'successTitle' => $title,
            'successDescription' => $description
        ]);
    }

    /** Returns a view with an error message title and description
     * @param string $view
     * @param string $title
     * @param string $description
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public static function viewErrorMessage(string $view, string $title, string $description): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view($view)->with([
            'error' => true,
            'errorTitle' => $title,
            'errorDescription' => $description
        ]);
    }

    /** Redirects to a route with an error message title and description, and with errors if there are any
     * @param string $title
     * @param string $description
     * @param string|null $path
     * @param null|array $errors
     * @return RedirectResponse
     */
    public static function redirectError(string $title, string $description, string $path = null, array $errors = null): RedirectResponse
    {
        $bag = [
            'error' => true,
            'errorTitle' => $title,
            'errorDescription' => $description
        ];

        if ($errors) {
            $bag = array_merge($bag, $errors);
        }

        return $path ?
            redirect($path)->withErrors($bag)
            : back()->withErrors($bag);
    }

    /** Redirects to a route with a success message title and description
     * @param string $title
     * @param string $description
     * @param string|null $path
     * @return RedirectResponse
     */
    public static function redirectSuccess(string $title, string $description, string $path = null): RedirectResponse
    {
        $bag = [
            'success' => true,
            'successTitle' => $title,
            'successDescription' => $description
        ];

        return $path ?
            redirect($path)->withErrors($bag)
            : redirect()->back()->withErrors($bag);
    }

    /** Returns a view with the exception message title and description
     * @param string $view
     * @param \Exception $exception
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public static function viewExceptionError(string $view, \Exception $exception): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view($view)->with([
            'error' => true,
            'errorTitle' => __('manage-response::manage_response.exception_error_title'),
            'errorDescription' => $exception->getMessage()
        ]);
    }

    /** Returns back with the exception message title and description
     * @param \Exception $exception
     * @param string|null $path
     * @return RedirectResponse
     */
    public static function redirectExceptionError(\Exception $exception, string $path = null): RedirectResponse
    {
        $bag = [
            'error' => true,
            'errorTitle' => __('manage-response::manage_response.exception_error_title'),
            'errorDescription' => $exception->getMessage()
        ];

        return $path? redirect($path)->withErrors($bag) : back()->withErrors($bag);
    }

    /** Creates a session with an error title and description
     * @param array $failed
     * @return void
     */
    public static function createValidationErrorSession(array $failed): void
    {
        $errorsCount = count($failed);

        \Session::put('error', true);
        \Session::put('errorTitle', __('manage-response::manage_response.validation_error_title'));
        \Session::put('errorDescription', trans_choice('manage-response::manage_response.validation_error_description', $errorsCount, ['count' => $errorsCount]));
    }

    /** Returns a json response for api calls with error message and data
     * @param int $code
     * @param string|null $message
     * @param array $data
     * @return JsonResponse
     */
    public static function jsonErrorResponse(int $code = 400, string $message = null, array $data = []): JsonResponse
    {
        return \response()->json([
            "message" => $message,
            "data" => $data
        ], $code);
    }

    /** Returns a json exception response message
     * @param \Exception $exception
     * @param int $code
     * @return JsonResponse
     */
    public static function jsonExceptionResponse(\Exception $exception, int $code = 400): JsonResponse
    {
        return \response()->json([
            "message" => $exception->getMessage()
        ], $code);
    }

    /** Returns a json success response with message and data
     * @param int $code
     * @param array $data
     * @param string|null $message
     * @return JsonResponse
     */
    public static function jsonSuccessResponse(int $code = 200, array $data = [], string $message = null): JsonResponse
    {
        return \response()->json([
            "message" => $message,
            "data" => $data
        ], $code);
    }
}
