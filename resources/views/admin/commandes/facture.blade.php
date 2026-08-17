<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $commande->numero_commande }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .info-section {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .info-box {
            width: 45%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total-section {
            text-align: right;
            margin-top: 30px;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURE</h1>
        <p>{{ $commande->numero_commande }}</p>
    </div>

    <div class="info-section">
        <div class="info-box">
            <h3>Entreprise</h3>
            <p>Votre Entreprise</p>
            <p>Adresse</p>
        </div>
        <div class="info-box">
            <h3>Client</h3>
            <p>{{ $commande->user->name }}</p>
            <p>{{ $commande->user->email }}</p>
        </div>
    </div>

    <div class="info-section">
        <div class="info-box">
            <h3>Adresse de livraison</h3>
            <p>{{ $commande->adresse_livraison }}</p>
        </div>
        <div class="info-box">
            <h3>Informations de la commande</h3>
            <p><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y') }}</p>
            <p><strong>Statut:</strong> {{ $commande->statut_label }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->lignes as $ligne)
                <tr>
                    <td>{{ $ligne->produit->name ?? 'N/A' }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire, 2) }} CFA</td>
                    <td>{{ number_format($ligne->total, 2) }} CFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total">
            TOTAL: {{ number_format($commande->total, 2) }} CFA
        </div>
    </div>
</body>
</html>
