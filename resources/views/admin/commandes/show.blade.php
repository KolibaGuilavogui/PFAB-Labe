<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détail de la commande') }} {{ $commande->numero_commande }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations principales -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informations de la commande</h3>
                            <p class="mb-2"><strong>Numéro:</strong> {{ $commande->numero_commande }}</p>
                            <p class="mb-2"><strong>Client:</strong> {{ $commande->user->name }} ({{ $commande->user->email }})</p>
                            <p class="mb-2"><strong>Total:</strong> {{ number_format($commande->total, 2) }} CFA</p>
                            <p class="mb-2"><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Adresse de livraison</h3>
                            <p class="mb-2">{{ $commande->adresse_livraison }}</p>
                        </div>
                    </div>

                    <!-- Changer le statut -->
                    <form method="POST" action="{{ route('admin.commandes.updateStatut', $commande->id) }}" class="mt-6">
                        @csrf
                        <div class="flex gap-4">
                            <select name="statut" class="px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">-- Sélectionner un statut --</option>
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" {{ $commande->statut == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mettre à jour
                            </button>
                        </div>
                    </form>

                    <!-- Statut et paiement -->
                    <div class="mt-6 flex gap-4">
                        <span class="px-3 py-1 rounded text-white text-sm {{ \App\Helpers\ColorHelper::toTailwind($commande->color) }}">
                            {{ $commande->statut_label }}
                        </span>
                        <span class="px-3 py-1 rounded text-white text-sm {{ \App\Helpers\ColorHelper::toTailwind($commande->payment_color) }}">
                            {{ $commande->payment_status_label }}
                        </span>
                    </div>

                    <!-- Note admin -->
                    @if($commande->note_admin)
                        <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                            <p><strong>Note admin:</strong> {{ $commande->note_admin }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Produits de la commande -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Produits commandés</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-300">
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
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-4">
                        <a href="{{ route('admin.commandes.print', $commande->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Télécharger la facture (PDF)
                        </a>
                        <a href="{{ route('admin.commandes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour
                        </a>

                        @if($commande->statut != 'livree' && $commande->statut != 'annulee')
                            <!-- Modal Annuler -->
                            <button onclick="openModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Annuler la commande
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal Annulation -->
            <div id="cancelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg">
                    <h3 class="text-lg font-semibold mb-4">Annuler la commande</h3>
                    <form method="POST" action="{{ route('admin.commandes.annuler', $commande->id) }}">
                        @csrf
                        <textarea name="motif" class="w-full px-3 py-2 border border-gray-300 rounded-md mb-4" rows="4" placeholder="Motif de l'annulation..." required></textarea>
                        <div class="flex gap-4">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Confirmer l'annulation
                            </button>
                            <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openModal() {
                    document.getElementById('cancelModal').classList.remove('hidden');
                }
                function closeModal() {
                    document.getElementById('cancelModal').classList.add('hidden');
                }
            </script>
        </div>
    </div>
</x-app-layout>
