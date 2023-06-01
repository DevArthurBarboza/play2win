<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}

            <a href="{{Request::url()}}/category/create">| Criar Categoria |</a>
            <a href="{{Request::url()}}/category/show">Mostrar Categorias</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/dashboard/category/store" method="POST">
                        @csrf
                        <label for="name">Nome</label>
                        <input type="text" name="nome" id="name">
                        <label for="description">Descrição</label>
                        <input type="text" name="description" id="description">
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
