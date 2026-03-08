<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    private static array $tasks = [
        [
            'title'       => 'Mettre à jour la documentation API',
            'description' => 'Réviser et compléter la documentation Swagger pour les endpoints REST. Inclure les exemples de requêtes et de réponses pour chaque route.',
        ],
        [
            'title'       => 'Corriger le bug d\'affichage sur mobile',
            'description' => 'Sur les écrans inférieurs à 375px, le menu de navigation déborde et masque le contenu principal. Tester sur iOS Safari et Android Chrome.',
        ],
        [
            'title'       => 'Intégrer le paiement Stripe',
            'description' => 'Implémenter le flux de paiement par carte bancaire via l\'API Stripe. Gérer les webhooks pour confirmer les transactions et envoyer les reçus par email.',
        ],
        [
            'title'       => 'Rédiger les tests unitaires pour le module clients',
            'description' => 'Couvrir les cas nominaux et d\'erreur des méthodes create, update et delete du ClientController. Viser une couverture d\'au moins 80 %.',
        ],
        [
            'title'       => 'Optimiser les requêtes SQL du tableau de bord',
            'description' => 'Les requêtes d\'agrégation sur la table des commandes prennent plus de 2 secondes. Ajouter des index appropriés et utiliser le lazy loading.',
        ],
        [
            'title'       => 'Déployer la version 2.1 en production',
            'description' => 'Préparer le script de migration, vérifier les variables d\'environnement et effectuer un déploiement zero-downtime via le pipeline CI/CD.',
        ],
        [
            'title'       => 'Concevoir la maquette de la page d\'accueil',
            'description' => 'Créer des wireframes basse fidélité puis une maquette Figma haute fidélité pour la nouvelle landing page. Recueillir les retours du client avant le développement.',
        ],
        [
            'title'       => 'Mettre en place l\'authentification OAuth2',
            'description' => 'Permettre aux utilisateurs de se connecter via Google et GitHub. Utiliser Laravel Socialite et stocker les tokens de manière sécurisée.',
        ],
        [
            'title'       => 'Envoyer la newsletter mensuelle',
            'description' => 'Préparer le contenu éditorial, personnaliser le template HTML et programmer l\'envoi via Mailchimp pour le premier mardi du mois à 9h.',
        ],
        [
            'title'       => 'Analyser les retours utilisateurs du sprint 5',
            'description' => 'Compiler les tickets de support, les avis in-app et les enregistrements Hotjar. Produire un rapport de synthèse et proposer des user stories pour le prochain sprint.',
        ],
        [
            'title'       => 'Implémenter la fonctionnalité d\'export CSV',
            'description' => 'Ajouter un bouton d\'export sur les pages Tâches et Clients. Générer le fichier en tâche de fond avec Laravel Queues et envoyer un lien de téléchargement par email.',
        ],
        [
            'title'       => 'Configurer le monitoring avec Sentry',
            'description' => 'Intégrer le SDK Sentry dans l\'application et définir les alertes pour les erreurs critiques. Configurer les environnements staging et production séparément.',
        ],
        [
            'title'       => 'Refactoriser le module de facturation',
            'description' => 'Le code actuel de la génération des factures PDF dépasse 500 lignes dans un seul contrôleur. Découper en services et utiliser le pattern Repository.',
        ],
        [
            'title'       => 'Préparer la présentation client du sprint',
            'description' => 'Créer un support de présentation PowerPoint résumant les fonctionnalités livrées, les métriques de performance et le plan du prochain sprint.',
        ],
        [
            'title'       => 'Auditer la sécurité des dépendances',
            'description' => 'Lancer composer audit et npm audit, corriger ou mettre à jour les packages présentant des vulnérabilités connues. Documenter les exceptions justifiées.',
        ],
    ];

    public function definition(): array
    {
        $task = $this->faker->randomElement(self::$tasks);

        return [
            'title'        => $task['title'],
            'description'  => $this->faker->optional(0.85)->passthrough($task['description']),
            'is_completed' => $this->faker->boolean(30),
            'due_date'     => $this->faker->optional(0.85)->dateTimeBetween('-1 week', '+1 month'),
            'priority'     => $this->faker->numberBetween(0, 5),
        ];
    }
}
