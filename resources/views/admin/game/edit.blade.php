<x-app-layout>

    @include('layouts.header')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="/dashboard/games/update/{{$game->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="text-gray-200" for="name">Nome</label>
                        <input value="{{$game->name}}" type="text" name="name" id="name">
                        <label class="text-gray-200" for="multiplier">Multiplicador</label>
                        <input type="number" value="{{$game->multiplier}}" name="multiplier" id="multiplier" step="0.01">
                        <label for="is_active">Ativado</label>
                        <input type="checkbox" value="{{$game->is_active}}" onclick='GameAux.toggle(this)' name="is_active" id="is_active">
                        <div class="mt-10">                        
                            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " type="submit" value="Atualizar">
                        </div>
                        <div class="mt-10">
                            <a class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="/dashboard/games/delete/{{$game->id}}">Excluir</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            GameAux = {
                toggle : function(element){
                    if(element.value == 0){
                        element.value = 1
                        return
                    } 
                    element.value = 0
                }
            }
        </script>
</x-app-layout>
