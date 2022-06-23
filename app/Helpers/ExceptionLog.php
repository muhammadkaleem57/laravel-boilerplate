<?php


namespace App\Helpers;

use App\Models\Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ExceptionLog
{
    public static function exception($exception)
    {
//        $file = "logs/Exception.json";
//        $storage = Storage::disk('public');
        $data = [
            'data_time' => date('Y-m-d H:i:s'),
            'url' => request()->url(),
            'file' => app()->runningInConsole() ? $exception->getFile() : Route::currentRouteAction(),
            'method' => app()->runningInConsole() ? 'Command run in Console' : request()->route()->getActionName(),
            'status' => $exception->getCode(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
        ];

        try {
            Exception::create($data);
        } catch (\Exception $e) {
            info($e);
        }

//        $file_info = self::getFileData($storage, $file);
//        if (is_array($file_info)) {
//            array_push($file_info, $data);
//
//            $storage->put($file, json_encode($file_info, JSON_PRETTY_PRINT));
//        }
    }

    public static function exceptionLogsList(): array
    {
        $storage = Storage::disk('public');
        $all_list = self::getFileData($storage, 'logs/Exception.json');
        $all_list = _array_reverse($all_list);
        return compact('all_list');
    }

    public static function getFileData($storage, $file = 'Exception.json'): ?array
    {
        return $storage->exists($file) ? _array_reverse(json_decode($storage->get($file),true)) : [];
    }

    public static function clearLogs($type): array
    {
        $storage = Storage::disk('public');
        self::clearFileLogs($storage, "logs/Exception.json");
        return self::exceptionLogsList();
    }

    private static function clearFileLogs($storage, $file_name = 'Exception.json')
    {
        $storage->put($file_name, json_encode([]));
    }
}
