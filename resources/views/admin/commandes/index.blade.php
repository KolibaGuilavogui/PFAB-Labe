<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Filtres et Recherche -->
                    <form method="GET" action="{{ route('admin.commandes.index') }}" class="mb-6 flex gap-4">
                        <select name="statut" class="px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">Tous les statuts</option>
                            @foreach($statuts as $key => $label)
                                <option value="{{ $key }}" {{ request('statut') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" name="search" placeholder="Rechercher par numéro ou client..." value="{{ request('search') }}" class="px-3 py-2 border border-gray-300 rounded-md flex-1">

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Rechercher
                        </button>
                    </form>

                    <!-- Tableau des commandes -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">N° Commande</th>
                                    <th class="border border-gray-300 px-4 py-2">Client</th>
                                    <th class="border border-gray-300 px-4 py-2">Total</th>
                                    <th class="border border-gray-300 px-4 py-2">Statut</th>
                                    <th class="border border-gray-300 px-4 py-2">Paiement</th>
                                    <th class="border border-gray-300 px-4 py-2">Date</th>
                                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commandes as $commande)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="border border-gray-300 px-4 py-2">{{ $commande->numero_commande }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $commande->user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ number_format($commande->total, 2) }} CFA</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <span class="px-2 py-1 rounded text-white text-sm {{ \App\Helpers\ColorHelper::toTailwind($commande->color) }}">
                                                {{ $commande->statut_label }}
                                            </span>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <span class="px-2 py-1 rounded text-white text-sm {{ \App\Helpers\ColorHelper::toTailwind($commande->payment_color) }}">
                                                {{ $commande->payment_status_label }}
                                            </span>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $commande->created_at->format('d/m/Y') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.commandes.show', $commande->id) }}" class="text-blue-500 hover:text-blue-700">Voir</a>
                                                <a href="{{ route('admin.commandes.print', $commande->id) }}" class="text-green-500 hover:text-green-700">PDF</a>
                                                @if($commande->statut != 'livree' && $commande->statut != 'annulee')
                                                    <a href="{{ route('admin.commandes.edit', $commande->id) }}" class="text-orange-500 hover:text-orange-700">Éditer</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                            Aucune commande trouvée
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $commandes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
