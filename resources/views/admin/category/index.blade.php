<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}

            <a href="/dashboard/category/create">| Criar Categoria |</a>
            <a href="/dashboard/category/index">Mostrar Categorias</a>
        </h2>
    </x-slot>

    @forelse ($categories as $category)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                            <div>
                                  <div>
                                      <span>Nome : {{$category->name}}</span>
                                  </div>

                                  <div>
                                      <span>Descrição : {{$category->description}}</span>
                                  </div>

                                  <div>
                                      <a href="/dashboard/category/edit/{{$category->id}}">Editar</a>
                                  </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div>Nenhuma categoria encontrada</div>
    @endforelse
</x-app-layout>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
