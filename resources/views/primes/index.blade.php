<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Import Fichier Excel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mx-auto my-5">

        <form onsubmit="submitForm()" method="POST" action="{{ route('import') }}" enctype="multipart/form-data" class="shadow-2xl px-4 py-4 mb-20">
            @csrf

            <div class="flex justify-center">
                <div class="border-b border-gray-900/10 pb-12">
                    <h1 class="text-3xl font-semibold leading-7 text-gray-900 text-center my-9">Bienvenue!</h1>
                    @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                      </div>
                    @endif
                    @if ($errors->all())
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        @foreach ($errors->all() as $error)
                        <span class="font-medium">{{ $error }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="mt-10">
                        <div class="w-96">
                            <div class="mt-2">
                                <label class="block">
                                    <span class="sr-only">Choisir le fichier</span>
                                    <input
                                    type="file"
                                    class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                    "
                                    name="file"
                                    required
                                    />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="mt-6 flex items-center justify-center gap-x-6">
                <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Annuler</button>
                @if (count($primes) > 0)
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" disabled>Importer</button>
                @else
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Importer</button>
                @endif
            </div>
        </form>

        <div class="container mx-auto shadow-2xl px-4 py-4">
            <div class="flex justify-between mb-8 px-4 py-4">
                <h1 class="text-3xl font-semibold leading-7 text-gray-900 text-center">Résultat</h1>
                <div class="hide">
                    <form action="{{ route('export') }}" method="post" class="flex">
                    @csrf
                        <input type="text" placeholder="Nommer le fichier" name="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-90" required>
                        &nbsp;&nbsp;
                        <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Valider</button>
                    </form>
                </div>
                @if (count($primes) > 0)
                <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 showToggle" type="button">Exporter</button>
                @else
                <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 showToggle" type="button" disabled>Exporter</button>
                @endif
            </div>
                

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Police
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-s-lg">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Retard
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-e-lg">
                                Contact
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($primes) > 0)
                        @foreach ($primes as $prime)
                        <tr class="bg-white dark:bg-gray-800">
                            <td class="px-6 py-4">
                                {{ $prime->id_ }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $prime->police }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $prime->nom }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $prime->retard }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $prime->contact }}
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="bg-white dark:bg-gray-800">
                            <td class="px-6 py-4" colspan="5" align="center">
                                Aucun fichier importer
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>