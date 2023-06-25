<x-app-layout>

    @include('layouts.header')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="/dashboard/game/update/{{$game->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="text-gray-200" for="name">Nome</label>
                        <input value="{{$game->name}}" type="text" name="name" id="name">
                        <label class="text-gray-200" for="multiplier">Multiplicador</label>
                        <input type="number" value="{{$game->multiplier}}" name="multiplier" id="multiplier" step="0.01">
                        <input class="text-gray-200" type="submit" value="Enviar">
                        <a class="text-gray-200" href="/dashboard/games/delete/{{$game->id}}">Excluir</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
