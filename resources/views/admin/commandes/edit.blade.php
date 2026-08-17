<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Éditer la commande') }} {{ $commande->numero_commande }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.commandes.update', $commande->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Client</label>
                            <p class="px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                                {{ $commande->user->name }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Adresse de livraison</label>
                            <textarea name="adresse_livraison" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>{{ $commande->adresse_livraison }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Statut de paiement</label>
                            <select name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                @foreach(\App\Models\Commande::PAYMENT_STATUS as $key => $label)
                                    <option value="{{ $key }}" {{ $commande->payment_status == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <h3 class="font-bold mb-4">Produits</h3>
                            <table class="min-w-full border-collapse border border-gray-300 mb-4">
                                <thead class="bg-gray-200 dark:bg-gray-700">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2">Produit</th>
                                        <th class="border border-gray-300 px-4 py-2">Quantité</th>
                                        <th class="border border-gray-300 px-4 py-2">Prix unitaire</th>
                                        <th class="border border-gray-300 px-4 py-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commande->lignes as $ligne)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2">{{ $ligne->produit->name ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $ligne->quantite }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ number_format($ligne->prix_unitaire, 2) }} CFA</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ number_format($ligne->total, 2) }} CFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mettre à jour
                            </button>
                            <a href="{{ route('admin.commandes.show', $commande->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
