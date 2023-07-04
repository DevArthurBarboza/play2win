<x-app-layout>

    @include('layouts.header')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex">
                    <form action="/dashboard/games/store" method="POST">
                        @csrf
                        <label class="text-gray-200" for="name">Nome</label>
                        <input type="text" name="name" id="name">
                        <label class="text-gray-200" for="multiplier">Multiplicador</label>
                        <input type="number" step='0.001' name="multiplier" id="multiplier">
                        <label for="category">Categoria</label>
                        <select name="category" id="category">
                            @forelse($categories as $category):
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty 
                            <option value="">Nenhuma categoria cadastrada</option>
                            @endforelse
                        </select>
                        <input class="border-solid border-2 border-sky-500 text-gray-200" type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
