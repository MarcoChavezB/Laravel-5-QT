<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\files;


class FilesController extends Controller
{
    protected $userController;

    public function insertFile($path, $userId)
    {
        $file = new files();
        $file->file_name = $path;
        $file->user_id = $userId;
        $file->save();
    }

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }


    public function sendFile(Request $request)
    {
        $name  = $this->userController->getTokenId(Request()->bearerToken())->name;

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf,jpg,png,txt'
        ]);

        $path = Storage::disk('digitalocean')->put($name, $request->file('file'), 'public');

        $this->insertFile($path, $this->userController->getTokenId(Request()->bearerToken())->id);

        $this->userController->sendNotify("Se guardo el archivo correctamente");
        return response()->json([
            'message' => 'Archivo guardado exitosamente',
            'path' => $path,
        ]);
    }

    public function getAllFiles()
    {
        try {
            $userFiles = $this->userController->getTokenId(Request()->bearerToken())->name;
            $this->userController->sendNotify("Se mostraron los archivos de " . $userFiles . " ");
            $files = Storage::disk('digitalocean')->allFiles($userFiles);
            return response()->json($files);
        } catch (\Throwable $th) {
            return response()->json(['msg' => "Error al obtener los archivos: " . $th->getMessage()], 500);
            $this->userController->sendNotify("Error" . $th->getMessage());
        }
    }

    public function getFile($filePath)
    {
        $userName = $this->userController->getTokenId(Request()->bearerToken())->name;

        $url = env('DIGITALOCEAN_SPACES_URL') . $userName . '/' . $filePath;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url, ['allow_redirects' => false]);

        if ($response->getStatusCode() == 200) {
            return redirect($url);
        } else {
            return response()->json(['error' => 'Archivo encontrado en la base de datos pero no en Digital Ocean'], 404);
        }
    }
}
