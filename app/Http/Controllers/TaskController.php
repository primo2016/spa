<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
Use Image;
use Intervention\Image\Exception\NotReadableException;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('order')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array_validate = [
            'descripcion' => 'required|max:200'
        ];

        //Si es un nuevo registro, se validan atributos de la imagen
        if($request->task_id == 0) {
            $array_validate['photo_name'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        request()->validate($array_validate);

        $task = null;

        //Se obtiene objeto en caso de ser una edición, sino se crea uno nuevo
        if(isset($request->task_id) && $request->task_id > 0) {
            $task = Task::find($request->task_id);
        } else {
            $task = new Task();
        }

        if ($files = $request->file('photo_name')) {

            // for save original image
            $ImageUpload = Image::make($files);

            //Se crea la url que se guardará en la base.
            $urlimage = 'images/' . time() . $files->getClientOriginalName();
            $pathcomplete = public_path($urlimage);

            if (!file_exists(public_path('images/'))) {
                mkdir(public_path('images '), 666, true);
            }

            $ImageUpload->save($pathcomplete);

            //
            //Se crea una carpeta para renderizar las imagenes a 300x300
            $thumbnailPath = 'public/resize/';

            //Si la carpeta no existe se crea
            if (!file_exists(public_path('resize/'))) {
                mkdir(public_path('resize '), 666, true);
            }

            $ImageUpload->resize(300, 300);

            $urlimageresize = 'resize/' . time() . $files->getClientOriginalName();
            $ImageUpload = $ImageUpload->save(public_path($urlimageresize));

            $task->urlimage = $urlimage;

        }

        //se actualizan los datos en la base.
        $task->descripcion = $request->descripcion;
        $task->save();

        $image = Task::latest()->first(['urlimage']);
        return Response()->json($image);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro eliminado con éxito.'
        ], 200);
    }
}
