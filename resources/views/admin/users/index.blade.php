    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Message de succès --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Message d'erreur de validation --}}
            @if ($errors->any())
                <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                    <p class="font-bold">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="list-disc pl-5 mt-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 sm:p-8 rounded-lg shadow border border-gray-200">
                
                <!-- SÉLECTEUR DU TYPE D'UTILISATEUR -->
                <div class="mb-6 border-b pb-4">
                    <label for="user_type_select" class="block text-base font-semibold text-gray-700 mb-2">
                        Quel type d'utilisateur souhaitez-vous ajouter ?
                    </label>
                    <select id="user_type_select" onchange="toggleUserForm()" class="w-full md:w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2.5 text-gray-800 font-medium">
                        <option value="producteur" selected>Producteur Agricole</option>
                        <option value="fournisseur">Fournisseur d'Intrants</option>
                    </select>
                </div>

                <!-- FORMULAIRE PRINCIPAL -->
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- CHAMP CACHÉ (user_type) ENVOYÉ AU CONTRÔLEUR -->
                    <input type="hidden" name="user_type" id="user_type_hidden" value="producteur">

                    <!-- ================================================================= -->
                    <!--                   1. BLOC PRODUCTEUR AGRICOLE                     -->
                    <!-- ================================================================= -->
                    <div id="section-producteur" class="space-y-6">
                        <h3 class="text-lg font-bold text-green-700 border-b pb-2">Nouveau Producteur Agricole</h3>

                        <!-- BLOC 1 : IDENTITÉ & ACCÈS -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 space-y-4">
                            <h4 class="font-bold text-gray-800 text-base text-center">Informations Personnelles & Identité</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="producteur_name" :value="__('Nom complet *')" />
                                    <x-text-input id="producteur_name" name="producteur_name" type="text" class="mt-1 block w-full" :value="old('producteur_name')" placeholder="Ex: Mamadou Diallo" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_email" :value="__('Adresse Email (Identifiant) *')" />
                                    <x-text-input id="producteur_email" name="producteur_email" type="email" class="mt-1 block w-full" :value="old('producteur_email')" placeholder="Ex: m.diallo@foutaagri.com" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_password" :value="__('Mot de passe provisoire *')" />
                                    <x-text-input id="producteur_password" name="producteur_password" type="password" class="mt-1 block w-full" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_phone" :value="__('Numéro de Téléphone')" />
                                    <x-text-input id="producteur_phone" name="producteur_phone" type="text" class="mt-1 block w-full" :value="old('producteur_phone')" placeholder="Ex: +224 620 00 00 00" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_nin" :value="__('Identifiant National (CNI / NIN)')" />
                                    <x-text-input id="producteur_nin" name="producteur_nin" type="text" class="mt-1 block w-full" :value="old('producteur_nin')" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_cni_file" :value="__('Pièce d\'Identité (Scannée / Photo)')" />
                                    <input type="file" id="producteur_cni_file" name="producteur_cni_file" class="mt-1 block w-full border-gray-300 bg-white rounded-md p-1 border text-sm text-gray-500">
                                </div>
                            </div>
                        </div>

                        <!-- BLOC 2 : EXPLOITATION & PRODUCTION -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 space-y-4">
                            <h4 class="font-bold text-gray-800 text-base text-center">Informations sur la Production & l'Exploitation</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="producteur_surface_hectares" :value="__('Superficie / Nombre d\'hectares (ha)')" />
                                    <x-text-input id="producteur_surface_hectares" name="producteur_surface_hectares" type="number" step="0.01" class="mt-1 block w-full" :value="old('producteur_surface_hectares')" placeholder="Ex: 2.5" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_speculations" :value="__('Spéculations principales (Cultures)')" />
                                    <x-text-input id="producteur_speculations" name="producteur_speculations" type="text" class="mt-1 block w-full" :value="old('producteur_speculations')" placeholder="Ex: Pomme de terre, Tomate, Fiente..." />
                                </div>

                                <div>
                                    <x-input-label for="producteur_annees_experience" :value="__('Années d\'expérience')" />
                                    <x-text-input id="producteur_annees_experience" name="producteur_annees_experience" type="number" class="mt-1 block w-full" :value="old('producteur_annees_experience')" placeholder="Ex: 5" />
                                </div>

                                <div>
                                    <x-input-label for="producteur_localisation_ferme" :value="__('Localisation de la ferme / champ')" />
                                    <x-text-input id="producteur_localisation_ferme" name="producteur_localisation_ferme" type="text" class="mt-1 block w-full" :value="old('producteur_localisation_ferme')" placeholder="Ex: Timbi Madina, Labé..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================================================================= -->
                    <!--                   2. BLOC FOURNISSEUR D'INTRANTS                  -->
                    <!-- ================================================================= -->
                    <div id="section-fournisseur" class="space-y-6 hidden">
                        <h3 class="text-lg font-bold text-blue-700 border-b pb-2">Nouveau Fournisseur d'Intrants</h3>

                        <!-- BLOC 1 : IDENTITÉ & ACCÈS -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 space-y-4">
                            <h4 class="font-bold text-gray-800 text-base text-center">Informations du Représentant & Identité</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="fournisseur_name" :value="__('Nom du responsable / gérant *')" />
                                    <x-text-input id="fournisseur_name" name="fournisseur_name" type="text" class="mt-1 block w-full" :value="old('fournisseur_name')" placeholder="Ex: Alpha Oumar Bah" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_email" :value="__('Adresse Email Pro (Identifiant) *')" />
                                    <x-text-input id="fournisseur_email" name="fournisseur_email" type="email" class="mt-1 block w-full" :value="old('fournisseur_email')" placeholder="Ex: contact@fournisseur.com" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_password" :value="__('Mot de passe provisoire *')" />
                                    <x-text-input id="fournisseur_password" name="fournisseur_password" type="password" class="mt-1 block w-full" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_phone" :value="__('Téléphone de contact')" />
                                    <x-text-input id="fournisseur_phone" name="fournisseur_phone" type="text" class="mt-1 block w-full" :value="old('fournisseur_phone')" placeholder="Ex: +224 620 00 00 00" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_nin" :value="__('Identifiant National (CNI / NIN)')" />
                                    <x-text-input id="fournisseur_nin" name="fournisseur_nin" type="text" class="mt-1 block w-full" :value="old('fournisseur_nin')" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_cni_file" :value="__('Pièce d\'Identité du responsable')" />
                                    <input type="file" id="fournisseur_cni_file" name="fournisseur_cni_file" class="mt-1 block w-full border-gray-300 bg-white rounded-md p-1 border text-sm text-gray-500">
                                </div>
                            </div>
                        </div>

                        <!-- BLOC 2 : ENTREPRISE & INTRANTS -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 space-y-4">
                            <h4 class="font-bold text-gray-800 text-base text-center">Informations sur l'Entreprise & Produits Vendus</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="fournisseur_company_name" :value="__('Nom du magasin / Entreprise')" />
                                    <x-text-input id="fournisseur_company_name" name="fournisseur_company_name" type="text" class="mt-1 block w-full" :value="old('fournisseur_company_name')" placeholder="Ex: Fouta Agrogros" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_rccm" :value="__('Numéro RCCM')" />
                                    <x-text-input id="fournisseur_rccm" name="fournisseur_rccm" type="text" class="mt-1 block w-full" :value="old('fournisseur_rccm')" placeholder="Ex: GN.TKR.2023.B..." />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_address" :value="__('Adresse / Localisation magasin principal')" />
                                    <x-text-input id="fournisseur_address" name="fournisseur_address" type="text" class="mt-1 block w-full" :value="old('fournisseur_address')" placeholder="Ex: Marché central, Labé" />
                                </div>

                                <div>
                                    <x-input-label for="fournisseur_sales_zones" :value="__('Lieux de vente / Zones couvertes')" />
                                    <x-text-input id="fournisseur_sales_zones" name="fournisseur_sales_zones" type="text" class="mt-1 block w-full" :value="old('fournisseur_sales_zones')" placeholder="Ex: Labé, Pita, Dalaba, Mamou..." />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="fournisseur_intrants_sold" :value="__('Types d\'intrants vendus')" />
                                    <textarea id="fournisseur_intrants_sold" name="fournisseur_intrants_sold" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ex: Engrais bio, semences certifiées, fiente, outillage...">{{ old('fournisseur_intrants_sold') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOUTON D'ENREGISTREMENT (Breeze Primary Button) -->
                    <div class="mt-8 border-t pt-4 flex justify-end">
                        <x-primary-button class="ml-4 bg-green-600">
                            {{ __('Enregistrer l\'utilisateur') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT JS DE BASCULEMENT -->
    <script>
        function toggleUserForm() {
            const selectElement = document.getElementById('user_type_select');
            const selectedValue = selectElement.value;
            
            const sectionProducteur = document.getElementById('section-producteur');
            const sectionFournisseur = document.getElementById('section-fournisseur');
            const hiddenInput = document.getElementById('user_type_hidden');

            hiddenInput.value = selectedValue;

            if (selectedValue === 'producteur') {
                sectionProducteur.classList.remove('hidden');
                sectionFournisseur.classList.add('hidden');
            } else {
                sectionFournisseur.classList.remove('hidden');
                sectionProducteur.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>



    