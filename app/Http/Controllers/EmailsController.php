<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Mail\SendEmail;
use App\Email;
use Auth;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('emails.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = [];

        if($request->get('remitente') == ''){
            $error['remitente'] = 'Ingrese un Remitente';
        }
        if($request->get('destinatario') == ''){
            $error['destinatario'] = 'Ingrese un Destinatario';
        }
        if($request->get('asunto') == ''){
            $error['asunto'] = 'Ingrese un Asunto';
        }

        if($error){
            return response()->json([ 'type' => 'error','data' => $error]);
        }else{
            $values = [
                'remitente' => $request->get('remitente'),
                'destinatario' => $request->get('destinatario'),
                'asunto' => $request->get('asunto'),
                'user_id' => Auth::user()->id ,
                'estado' => 0,
            ];
            $current_item = new Email($values);
            $current_item->save();

            //funcion para enviar el correo
            //$this->send($current_item);

            return response()->json([ 'type' => 'success', 'data' => $current_item]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
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
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    private function send(Request $request)
    {
        Mail::to($request->get('remitente'))->send(new SendEmail($request));
    }

    public function service(Request $request)
    {   
        /* Filtros a la datatable de emails  */

        /* campos a filtrar */
        $search_remitente = $request->get('search_remitente');
        $search_destinatario = $request->get('search_destinatario');
        $search_asunto = $request->get('search_asunto');
        
        /* Query */
        $query = Email::where('remitente','LIKE','%'.$search_remitente.'%')
            ->where('destinatario','LIKE','%'.$search_destinatario.'%')
            ->where('asunto','LIKE','%'.$search_asunto.'%')
            ->where('user_id','=', Auth::user()->id )->get();
 
        /* Campos por defecto para la tabla dinamica */
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $totalRecords = count(Email::all());
        $totalRecordswithFilter = count($query);
    
        echo json_encode(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $query
        ));
    }
}
