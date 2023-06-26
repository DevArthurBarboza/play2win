<x-app-layout>

    @include('layouts.header')

    @forelse ($games as $game)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                            <div>
                                <div>
                                    <span>Nome : {{$game->name}}</span>
                                </div>
                                <div>
                                    <span>Data de Criação : {{$game->created_at}}</span>
                                </div>
                                <div>
                                    <span>Multiplicador : {{$game->multiplier}}</span>
                                </div>
                                <div>
                                    <span>
                                        @if ($game->is_active)
                                            ATIVADO        
                                        @else 
                                            DESATIVADO
                                        @endif
                                    </span>
                                </div>
                                <div>
                                     <a class="text-blue-600" href="/dashboard/games/edit/{{$game->id}}">Editar</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div>Nenhum jogo encontrada</div>
    @endforelse
</x-app-layout>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
