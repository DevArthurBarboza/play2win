<x-app-layout>

    @include('layouts.header')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="/dashboard/category/update/{{$category->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="text-gray-200" for="name">Nome</label>
                        <input value="{{$category->name}}" type="text" name="name" id="name">
                        <label class="text-gray-200" for="description">Descrição</label>
                        <input value="{{$category->description}}" type="text" name="description" id="description">
                        <label class="text-gray-200" for="type">Tipo de Jogo</label>
                        <select name="type" id="type">
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->code}}</option>
                            @endforeach
                        </select>
                        <input class="text-gray-200" type="submit" value="Enviar">
                        <a class="text-gray-200" href="/dashboard/category/delete/{{$category->id}}">Excluir</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
