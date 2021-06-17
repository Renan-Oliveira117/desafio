<?php

namespace App\DataTables;

use App\Models\Contato;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContatoDataTable extends DataTable
{
   
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function($contato){
                return $contato->created_at->format('d/m/Y');
            })
            ->addColumn('action', function($contato){
                $acoes = link_to(
                            route('contato.edit',$contato),
                            'Editar',
                            ['class'=> 'btn btn-sm btn-primary']
                );

                $acoes .= FormFacade::button(
                    'Excluir',
                    [
                        'class' =>
                        'btn btn-sm btn-danger ml-1',
                        'onclick' => "excluir('" . route('contato.destroy', $contato) . "')"
                    ]
                    );
                return $acoes;
            });
    }


    public function query(Contato $model)
    {
        return $model->newQuery();
    }

 
    public function html()
    {
        return $this->builder()
                    ->setTableId('contato-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Novo Contato')

                    )
                    ->parameters([
                        'language' => ['url'=>'//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json']
                    ]);
    }


    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false),
            Column::make('id'),
            Column::make('nome')->title('Nome'),
            Column::make('created_at')->title('Data de Criação'),
        ];
    }


    protected function filename()
    {
        return 'Contato_' . date('YmdHis');
    }
}
