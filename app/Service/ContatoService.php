<?php
namespace App\Service;
use App\Models\Contato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Exception;

class ContatoService
{

    public static function store($request)
    {
        try{

            $contato = Contato::create($request);
            return[
                'status' => true,
                'contatos' => $contato
                
            ];
        }catch(Exception $erro){
            
            return[
                'status'=> false,
                'contatos'=> $erro->getMessage(),
            ];
        }
    }

    public static function getContatoPorId($id)
    {
        try{
            $contato = Contato::findOrFail($id);
            return[
                'status' => true,
                'contato' => $contato
            ];
        }catch(Exception $erro){
            return [
                'status' => false,
                'erro'=> $erro->getMessage()
            ];
        }
    }

    public static function upadate($request, $id)
    {
        try{
            $contato = Contato::findOrFail($id);
            $contato -> update($request);

            return [
                'status' => true,
                'contato' => $contato
            ];
        }catch(Exception $erro){
            return[
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try{
           $contato = Contato::findOrFail($id);
            $contato -> delete();
            
            return[
                'status' => true
            ];
        }catch(Exception $erro){
            return[
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }

}