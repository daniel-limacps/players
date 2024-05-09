@extends('main')
@section('content')

    <h1>Jogadores</h1>
        <br /><!-- comment -->
        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ asset('/player/addplayer') }}" class="underline text-gray-900 dark:text-white">Adicionar jogador</a></div>
            </div>
        </div>
        <br />
        <table class="table">
            @if(count($players) > 0)
            <tr class="title">
                    <th>Jogador</th>
                    <th>Goleiro</th>
                    <th>Nível</th>
                    <th>Ausente</th>
                    <th>Marcar ausência</th>
                    <th>Alterar</th>
                    <th>Remover</th>
                </tr>
                @foreach ($players as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->goalkeeper ? "Sim" : "Não"}}</td>
                    <td>{{ $p->nivel }}</td>
                    <td id="absent">{{ $p->absent ? "Sim" : "Não" }}</td>
                    
                    <td><input id="chkabsent" data-value="{{ $p->id }}" type="checkbox" onclick="javascript:absent(this)" {{ $p->absent == 1 ? "checked" : "" }}/></td>
                    <td><a href="{{ url('/updateplayer/' . $p->id)}}"><img src="{{ asset('img/update.png') }}" class="update" id="imgupdate" data-value="{{ $p->id }}" /></a></td>
                    <td><img src="{{ asset('img/delete.png') }}" class="delete" id="imgremove" data-value="{{ $p->id }}" onclick="javascript:remove(this)"/></td>
                    <!-- td>{{ date('d/m/Y H:i:s', $p->created_at )}}}</td -->
                </tr>
                @endforeach
            @else
                <tr>
                    <td>Sem jogadores</td>
                </tr>
            @endif
        </table>
        <br /><!-- comment -->
        
        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ asset('/') }}" class="underline text-gray-900 dark:text-white">Página inicial</a></div>
            </div>
        </div>
@stop()