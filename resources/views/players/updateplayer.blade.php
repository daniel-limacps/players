@extends('main')
@section('content')
    <h1>Atualizar Jogador</h1>
        <form action="{{ asset('/update/' . $player->id) }}"  method="POST" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Nome</label>
                <input name="name" value="{{ $player->name }}" size="50" />
            </div>
            <div class="form-group">
                <label>Nivel</label>
                <select name="nivel">
                    <option value="">Selecione</option>
                    @for ($i = 1; $i <= 5; $i++)
                    <option {{ $player->nivel == $i ? "selected" : "" }} value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label>Goleiro</label>
                <input name="goalkeeper" type ="checkbox" value="1" {{ $player->goalkeeper == 1 ? "checked" : "" }} />
            </div>
            <div class="form-group">
                <button type="submit">Salvar</button>
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
                    <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ asset('/player') }}" class="underline text-gray-900 dark:text-white">Voltar</a></div>
                </div>
            </div>
        </form>
@stop