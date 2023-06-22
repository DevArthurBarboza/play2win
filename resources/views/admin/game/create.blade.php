<x-app-layout>

    @include('layouts.header')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="/dashboard/game/store" method="POST">
                        @csrf
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name">
                        <label for="description">Descrição</label>
                        <input type="text" name="description" id="description">
                        <input class="border-solid border-2 border-sky-500 text-gray-200" type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
