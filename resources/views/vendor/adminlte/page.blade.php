@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

            {{-- Content Header --}}
            @hasSection('content_header')
                <div class="content-header">
                    <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                        @yield('content_header')
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            <div class="content">
                <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                    @yield('content')
                </div>
            </div>

        </div>

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')

    <script>
        function excluir(rota){
            Swal.fire({
                    title: 'Atenção',
                    text:"Deseja mesmo excluir",
                    showCancelButton:true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if(result.value){
                        axios.delete(rota)
                            .then(function (res){
                                $('#' + Object.keys(window.LaravelDataTables)[0]).DataTable().ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Perfeito!',
                                    text: 'Excluido com sucesso'
                            })
                            })
                            .catch(function (err){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ops!',
                                    text: 'Ocorreu um erro ao excluir'
                            })
                        });
                 }
                
            })
        }
    </script>
        @if(Session::has('sucesso') || Session::has('falha'))
        <script>
            
            Swal.fire({
            text: '{{ Session::get('sucesso') ?? Session::get('falha')}}',
            @if (Session::has('sucesso'))
                icon: 'success',
            @else 
                icon: 'error',
            @endif
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
            })
    
    </script>
@endif
@stop
