<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une nouvelle commande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.commandes.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Client</label>
                            <select name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                <option value="">-- Sélectionner un client --</option>
                                <!-- À implémenter: charger les clients -->
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Adresse de livraison</label>
                            <textarea name="adresse_livraison" class="w-full px-3 py-2 border border-gray-300 rounded-md" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Produits</label>
                            <div id="lignes-container">
                                <div class="ligne-commande mb-4 p-4 border border-gray-300 rounded-md">
                                    <select name="lignes[0][produit_id]" class="w-full px-3 py-2 border border-gray-300 rounded-md mb-2" required>
                                        <option value="">-- Sélectionner un produit --</option>
                                        <!-- À implémenter: charger les produits -->
                                    </select>
                                    <input type="number" name="lignes[0][quantite]" placeholder="Quantité" class="w-full px-3 py-2 border border-gray-300 rounded-md mb-2" required min="1">
                                    <input type="number" name="lignes[0][prix_unitaire]" placeholder="Prix unitaire" class="w-full px-3 py-2 border border-gray-300 rounded-md" required step="0.01" min="0">
                                </div>
                            </div>
                            <button type="button" onclick="addLigne()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
                                + Ajouter un produit
                            </button>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Créer la commande
                            </button>
                            <a href="{{ route('admin.commandes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>

                    <script>
                        let ligneCount = 1;
                        function addLigne() {
                            const html = `
                                <div class="ligne-commande mb-4 p-4 border border-gray-300 rounded-md">
                                    <select name="lignes[${ligneCount}][produit_id]" class="w-full px-3 py-2 border border-gray-300 rounded-md mb-2" required>
                                        <option value="">-- Sélectionner un produit --</option>
                                    </select>
                                    <input type="number" name="lignes[${ligneCount}][quantite]" placeholder="Quantité" class="w-full px-3 py-2 border border-gray-300 rounded-md mb-2" required min="1">
                                    <input type="number" name="lignes[${ligneCount}][prix_unitaire]" placeholder="Prix unitaire" class="w-full px-3 py-2 border border-gray-300 rounded-md mb-2" required step="0.01" min="0">
                                    <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                        Supprimer
                                    </button>
                                </div>
                            `;
                            document.getElementById('lignes-container').insertAdjacentHTML('beforeend', html);
                            ligneCount++;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
