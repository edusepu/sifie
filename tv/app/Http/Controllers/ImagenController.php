<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\imagenes;

class ImagenController extends Controller
{
    public function index()
    {
        $datos = imagenes::all();
        //dump( $datos);
        return view('subir-imagen',compact('datos'));
    }


    public function guardarImagen(Request $request)
    {
        $imagen = $request->file('imagen');

        // Verificar si se seleccionó una imagen
        if ($imagen) {
            // Guardar la imagen en el almacenamiento
            $path = $imagen->store('public/imagenes');

            // Generar una URL para acceder a la imagen
            $url = Storage::url($path);
            $imagenModel = new imagenes;
            $imagenModel->nombre = $imagen->getClientOriginalName();
            $imagenModel->url = $url;
            $imagenModel->save();

           // return "La imagen se ha guardado correctamente. URL: " . $url;
           $datos = imagenes::all();        
        return view('subir-imagen',compact('datos'));

        }

        return "No se seleccionó ninguna imagen.";
    }

}
