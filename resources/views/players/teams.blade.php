@extends('main')
@section('content')
    <h1>Formação dos times</h1>
    <form action="{{ url('/createteams') }}"  method="POST" >
        @csrf
        <div class="form-group">
            <label>Qtde de Jogadores por times</label>
            <input name="players" size="10" value="@if(isset($data['players'])) {{ $data['players'] }} @endif" />
        </div>
        <div class="form-group">
            <button type="submit">Executar</button>
        </div>
    </form>

    <div class="container">
        <div class="teams">
        @if(isset($data['team']))
            @foreach($data['team'] as $team)
                <div class="team">
                    <ul>
                        <li class="player"><label>Goleiro</label></li>
                        <li><label>{{ count($team['Goalkeeper']) > 0 ? $team['Goalkeeper'][0] : "" }}</label></li>
                        <li class="player"><label>Jogadores</label></li>
                    @if ( count($team['Players']) > 0 )
                            @foreach($team['Players'] as $player)
                            <li class="players"><label>{{ $player }}</label></li>
                            @endforeach
                    @endif
                    </ul>
                </div>
            @endforeach
        @endif
        </div>
    </div>
    <div class="form-group">
        <label>@if(isset($data['message'])) {{ $data['message'] }} @endif</label>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li><label>{{ $error }}</label></li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <div class="ml-4 text-lg leading-7 font-semibold"><a href="/" class="underline text-gray-900 dark:text-white">Página inicial</a></div>
        </div>
    </div>
@stop