<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;

class FilesController extends Controller
{
    protected $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function sendFile(Request $request)
    {
        if (!$this->userController->decodeToken($request->bearerToken())) {
            $this->userController->sendNotify("Se intento subir un archivo sin token");
            return response()->json([
                'error' => 'Token inválido'
            ], 401);
        }
        $path = Storage::disk('digitalocean')->put('marco', $request->file('file'), 'public');
        $this->userController->sendNotify("Se mostraron los archivos guardados");
        return response()->json([
            'message' => 'Archivo guardado exitosamente',
            'path' => $path
        ]);
    }

    public function getAllFiles(Request $request)
    {
        $userFiles = "marco";

        if (!$this->userController->decodeToken($request->bearerToken())) {

            $this->userController->sendNotify("Se intento subir un archivo sin token");
            return response()->json([
                'error' => 'Token inválido'
            ], 401);
        }
        $this->userController->sendNotify("Se mostraron los archivos de " . $userFiles . " ");
        $files = Storage::disk('digitalocean')->allFiles($userFiles);
        return response()->json($files);
    }

    public function getFile($fileName, Request $request)
    {
        if (!$this->userController->decodeToken($request->bearerToken())) {

            $this->userController->sendNotify("Se intento subir un archivo sin token");
            return response()->json([
                'error' => 'Token inválido'
            ], 401);
        }

        $filePath = 'marco/' . $fileName;
        if (Storage::disk('digitalocean')->exists($filePath)) {
            $fileContent = Storage::disk('digitalocean')->get($filePath);

            $this->userController->sendNotify("Se mostro el arcvhivo" . $fileName . "");
            return response($fileContent, 200)
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } else {
            $this->userController->sendNotify("No se encontro el archivo");
            return response()->json([
                'error' => 'El archivo no existe.'
            ], 404);
        }
    }
}
