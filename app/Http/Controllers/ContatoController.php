<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\DataTables\ContatoDataTable;
use App\Service\ContatoService;
use App\Http\Requests\ContatoRequest;
USE App\Models\Contato;

class ContatoController extends Controller
{
    public function index(ContatoDataTable $userDataTable)
    {  
      return $userDataTable->render('cadastro.index');
    }

    public function create()
    {

      return view('cadastro.form');
    }

    public function store(ContatoRequest $request)
    {
      $contato = ContatoService::store($request->all());

      if($contato['status']){
        return redirect()->route('contato.index')
                        ->withSucesso('Contato salvo com sucesso');
      }

      return back()->withInput()
                    ->withFalha('Ocorreu um erro ');
    }

    public function edit($id)
    {
      $contato = ContatoService::getContatoPorId($id);

      if ($contato['status']){
        return view('cadastro.form',[
        'contato' => $contato['contato']
        ]);
                          
      }
      return back()->withFalha('Ocorreu um erro ao selecionar o contato '); 
    }

    public function update(Request $request, $id)
    {
        $contato = ContatoService::upadate($request->all(), $id);

        if ($contato['status']){
            return redirect()->route('contato.index')
                    ->withSucesso('Contato atualizado com sucesso');

        }
        return back()->withInput()
                ->withFalha('Ocorreu um erro ao atualizar');
    }

    public function destroy($id)
    {
      $contato = ContatoService::destroy($id);

        if ($contato['status']){
            return 'Contato excluida com sucesso';
        }

        abort(403,'Erro ao excluir,' .$contato['erro']);
    }
    

}
