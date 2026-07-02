<?php

namespace App\Http\Controllers;

use App\Models\BureauMember;
use App\Models\Message;
use App\Models\Projet;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private function detailCatalog(): array
    {
        return [
            'chefferie' => [
                'histoire-village' => [
                    'title' => 'Histoire du Village',
                    'subtitle' => 'Les origines, les repères et l’évolution d’Andé',
                    'image' => 'images/chefferie/2.JPG',
                    'lead' => 'Andé porte une histoire faite de migrations, d’alliances et de transmission. Le village s’est construit autour de valeurs fortes qui unissent encore aujourd’hui les familles et les générations.',
                    'body' => [
                        'Cette page présente les grandes étapes qui ont façonné l’identité du village, depuis les premiers repères de peuplement jusqu’aux dynamiques actuelles de développement et d’organisation communautaire.',
                        'La mémoire collective, les récits des anciens et les cérémonies traditionnelles jouent un rôle essentiel dans la préservation de cette histoire vivante.',
                    ],
                ],
                'valeurs-fondamentales' => [
                    'title' => 'Valeurs Fondamentales',
                    'subtitle' => 'Solidarité, respect, honnêteté et entraide',
                    'image' => 'images/chefferie/3.JPG',
                    'lead' => 'Les valeurs sont le socle de la cohésion sociale à Andé. Elles guident les relations entre les familles, les responsables et les jeunes du village.',
                    'body' => [
                        'La solidarité et le respect mutuel permettent d’avancer ensemble, tandis que l’honnêteté et la responsabilité renforcent la confiance dans les décisions collectives.',
                        'Ces principes servent de boussole pour toutes les actions communautaires, des cérémonies aux projets de développement.',
                    ],
                ],
                'us-coutumes' => [
                    'title' => 'Us et Coutumes',
                    'subtitle' => 'Les pratiques qui rythment la vie sociale et culturelle',
                    'image' => 'images/chefferie/4.JPG',
                    'lead' => 'Les usages et coutumes constituent une part essentielle de l’identité d’Andé. Ils expriment le lien entre les ancêtres, les familles et la communauté actuelle.',
                    'body' => [
                        'Rites, danses, célébrations et façons de vivre ensemble permettent de transmettre des repères culturels solides aux plus jeunes.',
                        'La conservation de ces pratiques aide aussi à renforcer la fierté locale et la cohésion autour des moments importants de la vie du village.',
                    ],
                ],
                'manifestations-culturelles' => [
                    'title' => 'Manifestations Culturelles',
                    'subtitle' => 'Fêtes, cérémonies et moments de célébration',
                    'image' => 'images/chefferie/5.JPG',
                    'lead' => 'Les manifestations culturelles sont des temps forts où la communauté se retrouve pour célébrer, honorer et partager.',
                    'body' => [
                        'Elles rassemblent les habitants autour des danses, des masques, de la musique et des rites qui expriment la richesse du patrimoine d’Andé.',
                        'Ces événements sont aussi des occasions de transmettre les traditions et de faire vivre l’esprit communautaire.',
                    ],
                ],
                'patrimoine-culturel' => [
                    'title' => 'Patrimoine Culturel',
                    'subtitle' => 'Les richesses matérielles et immatérielles du village',
                    'image' => 'images/chefferie/6.JPG',
                    'lead' => 'Le patrimoine culturel d’Andé rassemble les savoirs, les objets, les pratiques et les lieux qui racontent l’histoire du village.',
                    'body' => [
                        'Préserver ce patrimoine, c’est protéger une mémoire collective précieuse et la rendre accessible aux générations futures.',
                        'La MUDEA soutient cette démarche en valorisant les traditions, les sites symboliques et les expressions culturelles locales.',
                    ],
                ],
                'galerie-culturelle' => [
                    'title' => 'Galerie Culturelle',
                    'subtitle' => 'Images et scènes de vie du patrimoine d’Andé',
                    'image' => 'images/chefferie/7.JPG',
                    'lead' => 'Cette galerie illustre la beauté et la diversité de la culture locale à travers des images du quotidien, des cérémonies et des symboles traditionnels.',
                    'body' => [
                        'Elle permet de découvrir la dimension visuelle du patrimoine et d’en conserver une trace claire pour la communauté et les visiteurs.',
                        'Les photos sont un support utile pour raconter le village et partager son identité à travers le site web.',
                    ],
                ],
            ],
            'education' => [
                'eleves-meritants' => [
                    'title' => 'Élèves Méritants',
                    'subtitle' => 'Valoriser l’effort et encourager la réussite',
                    'image' => 'images/education/2.JPG',
                    'lead' => 'La réussite des élèves est au cœur de la mission Éducation & Excellence. La MUDEA souhaite reconnaître le mérite et stimuler l’envie d’apprendre.',
                    'body' => [
                        'Les actions menées encouragent les jeunes à persévérer, à viser de bons résultats et à croire en leurs capacités.',
                        'Cette dynamique crée un cercle vertueux où la réussite scolaire devient une source d’inspiration pour toute la communauté.',
                    ],
                ],
                'etudiants' => [
                    'title' => 'Étudiants',
                    'subtitle' => 'Accompagnement, orientation et entraide',
                    'image' => 'images/education/3.JPG',
                    'lead' => 'Les étudiants d’Andé bénéficient d’un espace de partage pour échanger sur leurs parcours, leurs défis et leurs ambitions.',
                    'body' => [
                        'La MUDEA encourage l’entraide entre étudiants afin de créer un réseau de soutien solide, utile pendant les études et après.',
                        'L’objectif est de faciliter l’orientation et d’aider chacun à avancer avec confiance vers son projet de vie.',
                    ],
                ],
                'bourses' => [
                    'title' => 'Bourses',
                    'subtitle' => 'Soutenir les parcours académiques',
                    'image' => 'images/education/4.JPG',
                    'lead' => 'Les dispositifs de bourse sont pensés pour accompagner les élèves et étudiants qui ont besoin d’un appui financier pour continuer leurs études.',
                    'body' => [
                        'Ils permettent de réduire les obstacles liés aux frais scolaires et de créer plus d’égalité des chances.',
                        'La transparence et l’équité restent essentielles dans le suivi de ces opportunités.',
                    ],
                ],
                'academie-numerique' => [
                    'title' => 'Académie Numérique',
                    'subtitle' => 'Compétences digitales et apprentissage moderne',
                    'image' => 'images/education/5.JPG',
                    'lead' => 'L’académie numérique accompagne les jeunes vers les outils, les compétences et les usages du monde digital.',
                    'body' => [
                        'Des ressources en ligne et des initiations pratiques permettent d’aborder les nouvelles technologies avec méthode.',
                        'Cette ouverture renforce l’autonomie des apprenants et leur employabilité à moyen terme.',
                    ],
                ],
                'forum-education' => [
                    'title' => 'Forum Éducation',
                    'subtitle' => 'Échanger des idées et trouver des réponses',
                    'image' => 'images/education/6.JPG',
                    'lead' => 'Le forum rassemble les questions les plus fréquentes autour de l’école, des études et de l’orientation.',
                    'body' => [
                        'C’est un espace d’entraide qui permet de poser des questions, d’obtenir des pistes concrètes et de partager des expériences utiles.',
                        'La communauté peut ainsi contribuer activement à la réussite éducative du village.',
                    ],
                ],
            ],
            'projets' => [
                'complexe-scolaire' => [
                    'title' => 'Complexe Scolaire d’Excellence',
                    'subtitle' => 'Construire aujourd’hui le cadre scolaire de demain',
                    'image' => 'images/projets/2.png',
                    'lead' => 'Ce projet phare vise à offrir un environnement moderne et adapté pour les enfants d’Andé.',
                    'body' => [
                        'Le complexe scolaire symbolise l’investissement de la communauté dans l’éducation et la réussite des futures générations.',
                        'Sa construction traduit une volonté durable de créer des conditions d’apprentissage dignes et motivantes.',
                    ],
                ],
                'adduction-eau' => [
                    'title' => 'Adduction d’eau potable',
                    'subtitle' => 'Sécuriser l’accès à une eau de qualité',
                    'image' => 'images/projets/1.JPG',
                    'lead' => 'L’accès à l’eau potable reste un enjeu majeur pour le bien-être des familles et la santé publique.',
                    'body' => [
                        'Le projet d’adduction vise à améliorer durablement l’approvisionnement en eau du village.',
                        'Il participe directement à la qualité de vie des habitants et à la réduction des difficultés quotidiennes.',
                    ],
                ],
                'centre-sante' => [
                    'title' => 'Centre de Santé Intégré',
                    'subtitle' => 'Renforcer l’accès aux soins de proximité',
                    'image' => 'images/projets/2.JPG',
                    'lead' => 'La santé est un pilier du développement local. Ce projet soutient une meilleure prise en charge des besoins médicaux de la communauté.',
                    'body' => [
                        'Un centre de santé intégré permet de rapprocher les soins des populations et de fluidifier l’accès aux services essentiels.',
                        'Ce type de projet est structurant pour tout territoire qui veut améliorer durablement le quotidien de ses habitants.',
                    ],
                ],
                'pistes-rurales' => [
                    'title' => 'Réhabilitation des pistes rurales',
                    'subtitle' => 'Faciliter la circulation et les échanges',
                    'image' => 'images/projets/3.JPG',
                    'lead' => 'Les pistes rurales sont déterminantes pour le transport des personnes, des produits agricoles et du matériel.',
                    'body' => [
                        'Réhabiliter ces voies permet de désenclaver certains quartiers et de soutenir l’économie locale.',
                        'Le projet améliore aussi la sécurité et la fluidité des déplacements au quotidien.',
                    ],
                ],
                'electrification-solaire' => [
                    'title' => 'Électrification solaire',
                    'subtitle' => 'Promouvoir une énergie propre et durable',
                    'image' => 'images/projets/4.JPG',
                    'lead' => 'L’électrification solaire permet d’apporter une solution moderne, fiable et respectueuse de l’environnement.',
                    'body' => [
                        'Ce projet soutient la modernisation du village tout en réduisant la dépendance aux énergies plus coûteuses.',
                        'Il facilite également les activités économiques, scolaires et communautaires après la tombée de la nuit.',
                    ],
                ],
                'maison-jeunes' => [
                    'title' => 'Maison des Jeunes',
                    'subtitle' => 'Créer un espace de rencontre et de formation',
                    'image' => 'images/projets/chateau.jpg',
                    'lead' => 'La Maison des Jeunes est pensée comme un lieu vivant pour le dialogue, les activités collectives et l’initiation de projets.',
                    'body' => [
                        'Elle encourage l’engagement des jeunes et leur donne un espace pour apprendre, créer et participer au développement communal.',
                        'Un tel lieu favorise aussi la cohésion entre générations autour d’objectifs communs.',
                    ],
                ],
                'agriculture-locale' => [
                    'title' => 'Programme d’appui à l’agriculture locale',
                    'subtitle' => 'Soutenir les producteurs et les savoir-faire',
                    'image' => 'images/projets/route.jpg',
                    'lead' => 'L’agriculture reste un levier essentiel pour les revenus des familles et l’autonomie alimentaire.',
                    'body' => [
                        'Le programme d’appui vise à renforcer les capacités locales, les équipements et la valorisation des productions.',
                        'Il contribue à structurer une économie villageoise plus résiliente et plus durable.',
                    ],
                ],
                'place-publique' => [
                    'title' => 'Aménagement de la place publique',
                    'subtitle' => 'Un espace pour les rassemblements et la vie collective',
                    'image' => 'images/projets/5.JPG',
                    'lead' => 'L’aménagement de la place publique améliore le cadre de vie et offre un espace central pour les rencontres communautaires.',
                    'body' => [
                        'Cet espace peut accueillir les événements, les discussions collectives et les célébrations importantes du village.',
                        'Il joue un rôle de cohésion sociale et de représentation de l’identité locale.',
                    ],
                ],
                'complexe-sportif-culturel' => [
                    'title' => 'Complexe sportif et culturel',
                    'subtitle' => 'Développer les loisirs, le sport et la culture',
                    'image' => 'images/projets/6.JPG',
                    'lead' => 'Le complexe sportif et culturel permettra de rassembler les habitants autour d’activités utiles, saines et fédératrices.',
                    'body' => [
                        'Il soutient l’épanouissement des jeunes et la mise en valeur des talents du village.',
                        'Ce type d’infrastructure favorise aussi l’organisation régulière d’événements collectifs.',
                    ],
                ],
                'ecole' => [
                    'title' => 'Réhabilitation de l’école primaire d’Andé',
                    'subtitle' => 'Améliorer le cadre d’apprentissage des enfants',
                    'image' => 'images/projets/ecole.jpg',
                    'lead' => 'Cette action a permis de remettre l’école primaire au cœur des priorités du village et de soutenir la réussite scolaire.',
                    'body' => [
                        'La réhabilitation des infrastructures scolaires a contribué à rendre les salles plus accueillantes et plus propices à l’étude.',
                        'Le projet a symbolisé un engagement concret pour l’éducation de base des enfants d’Andé.',
                    ],
                ],
                'chateau' => [
                    'title' => 'Construction de la Maison des Jeunes',
                    'subtitle' => 'Un lieu pour les activités et la vie collective',
                    'image' => 'images/projets/chateau.jpg',
                    'lead' => 'La Maison des Jeunes est un projet structurant qui offre au village un espace de rassemblement et de dynamisation sociale.',
                    'body' => [
                        'Elle soutient les activités collectives et les échanges entre générations.',
                        'Ce lieu est pensé comme un point d’appui pour les initiatives de développement communautaire.',
                    ],
                ],
                'route' => [
                    'title' => 'Programme d’appui à l’agriculture locale',
                    'subtitle' => 'Relier les productions aux marchés et aux opportunités',
                    'image' => 'images/projets/route.jpg',
                    'lead' => 'Les actions liées aux voies d’accès et à l’agriculture améliorent la circulation et la valorisation des productions locales.',
                    'body' => [
                        'L’amélioration des chemins facilite les échanges commerciaux et réduit l’isolement de certaines zones.',
                        'Le projet accompagne aussi la vitalité économique des familles productrices.',
                    ],
                ],
            ],
            'actualites' => [
                'inauguration-complexe-scolaire' => [
                    'title' => 'Inauguration du Complexe Scolaire',
                    'subtitle' => 'Un nouveau cap pour l’éducation à Andé',
                    'image' => 'images/actualites/eleve.JPG',
                    'lead' => 'L’inauguration du complexe scolaire a marqué une étape importante dans la vie du village et dans la politique de soutien à l’éducation.',
                    'body' => [
                        'Ce moment symbolise la mobilisation collective autour de la jeunesse, de la scolarisation et de la réussite scolaire.',
                        'La cérémonie a rassemblé les autorités, les membres de la MUDEA et plusieurs familles du village.',
                    ],
                ],
                'avancement-travaux-chateau-eau' => [
                    'title' => 'Avancement des travaux du château d’eau',
                    'subtitle' => 'Suivi d’un projet prioritaire pour l’eau potable',
                    'image' => 'images/actualites/reunion.png',
                    'lead' => 'Le chantier du château d’eau progresse et reste suivi de près par la communauté afin de garantir une mise en service utile et durable.',
                    'body' => [
                        'L’objectif est de sécuriser l’approvisionnement en eau et de répondre à un besoin essentiel du village.',
                        'La transparence sur l’avancement des travaux contribue à maintenir la confiance autour du projet.',
                    ],
                ],
                'cours-soutien-examens' => [
                    'title' => 'Cours de soutien pour les examens',
                    'subtitle' => 'Accompagner les élèves vers la réussite',
                    'image' => 'images/actualites/examen.png',
                    'lead' => 'Les cours de soutien sont organisés pour renforcer les acquis et aider les élèves à aborder les examens avec plus de sérénité.',
                    'body' => [
                        'Cette action s’inscrit dans la mission de valorisation de l’excellence scolaire et d’accompagnement pédagogique.',
                        'Elle offre aux élèves des repères concrets et un encadrement supplémentaire pour progresser.',
                    ],
                ],
                'rencontre-chefs-familles' => [
                    'title' => 'Rencontre avec les chefs de familles',
                    'subtitle' => 'Dialoguer pour mieux construire',
                    'image' => 'images/actualites/solidarite.png',
                    'lead' => 'La rencontre avec les chefs de familles a permis d’échanger sur les priorités du village et les attentes des populations.',
                    'body' => [
                        'Ce dialogue renforce la coopération entre les responsables et les familles autour des enjeux de développement.',
                        'Il permet aussi de faire remonter les préoccupations du terrain et d’ajuster les actions de la MUDEA.',
                    ],
                ],
                'festival-masques-2024' => [
                    'title' => 'Festival des masques d’Andé 2024',
                    'subtitle' => 'Un moment fort pour le patrimoine culturel',
                    'image' => 'images/actualites/union.png',
                    'lead' => 'Le festival a célébré l’identité culturelle du village à travers les masques, les danses et les animations traditionnelles.',
                    'body' => [
                        'Cet événement a mis en lumière l’importance de préserver et de transmettre les expressions culturelles locales.',
                        'Il a également renforcé la visibilité du village et le sentiment d’appartenance des participants.',
                    ],
                ],
                'reunion' => [
                    'title' => 'Réunion d’avancement des projets',
                    'subtitle' => 'Coordonner les actions et suivre les priorités',
                    'image' => 'images/actualites/reunion.png',
                    'lead' => 'Cette réunion a permis d’évaluer l’évolution des projets et de renforcer la coordination entre les acteurs impliqués.',
                    'body' => [
                        'Le suivi régulier des projets aide à maintenir une vision claire sur les échéances et les besoins concrets.',
                        'La concertation reste un outil clé pour faire avancer le développement du village.',
                    ],
                ],
                'journee-solidarite' => [
                    'title' => 'Journée de solidarité communautaire',
                    'subtitle' => 'S’unir pour agir ensemble',
                    'image' => 'images/actualites/solidarite.png',
                    'lead' => 'La journée de solidarité a mis en avant l’esprit d’entraide et l’engagement collectif des habitants.',
                    'body' => [
                        'Ces moments fédèrent la communauté autour d’actions concrètes et visibles sur le terrain.',
                        'Ils renforcent les liens entre familles, responsables et bénévoles du village.',
                    ],
                ],
                'resultats-examens' => [
                    'title' => 'Résultats des examens',
                    'subtitle' => 'Mettre en valeur le mérite scolaire',
                    'image' => 'images/actualites/examen.png',
                    'lead' => 'Les résultats scolaires sont suivis avec attention afin de célébrer les réussites et d’encourager la persévérance.',
                    'body' => [
                        'La MUDEA accompagne les élèves dans leurs efforts pour obtenir de bons résultats et poursuivre leurs études dans de bonnes conditions.',
                        'Les réussites sont partagées comme une fierté collective pour tout le village.',
                    ],
                ],
                'action-fin-annee' => [
                    'title' => 'Action de fin d’année',
                    'subtitle' => 'Clôturer l’année par un geste solidaire',
                    'image' => 'images/actualites/examen.png',
                    'lead' => 'Cette action marque la volonté de terminer l’année par un moment utile, convivial et porteur de sens pour les membres de la communauté.',
                    'body' => [
                        'Les actions de fin d’année sont aussi l’occasion de faire le point sur les avancées et de remercier les acteurs mobilisés.',
                        'Elles ouvrent la voie à de nouvelles ambitions pour l’année suivante.',
                    ],
                ],
            ],
        ];
    }

    private function renderDetail(string $section, string $slug)
    {
        $item = $this->detailCatalog()[$section][$slug] ?? null;

        abort_unless($item, 404);

        return view('pages.detail', [
            'item' => $item,
            'section' => $section,
        ]);
    }

    public function chefferieDetail(string $slug)
    {
        return $this->renderDetail('chefferie', $slug);
    }

    public function educationDetail(string $slug)
    {
        return $this->renderDetail('education', $slug);
    }

    public function projetsDetail(string $slug)
    {
        return $this->renderDetail('projets', $slug);
    }

    public function actualitesDetail(string $slug)
    {
        return $this->renderDetail('actualites', $slug);
    }

    public function home()
    {
        return view('pages.home');
    }

    public function mutuelle()
    {
        return view('pages.mutuelle', [
            'bureauMembers' => BureauMember::latest()->get(),
        ]);
    }

    public function gouvernance()
    {
        return view('pages.gouvernance');
    }

    public function chefferie()
    {
        return view('pages.chefferie');
    }

    public function education()
    {
        return view('pages.education');
    }

    public function jeunesse()
    {
        return view('pages.jeunesse');
    }

    public function cadres()
    {
        return view('pages.cadres');
    }

    public function solidarite()
    {
        return view('pages.solidarite');
    }

    public function projets()
    {
        return view('pages.projets', [
            'publishedProjets' => Projet::query()->latest()->get(),
            'featuredProjet' => Projet::query()->where('featured', true)->latest()->first(),
        ]);
    }

    public function transparence()
    {
        return view('pages.transparence');
    }

    public function actualites()
    {
        return view('pages.actualites');
    }

    public function partenaires()
    {
        return view('pages.partenaires');
    }

    public function contact(Request $request)
    {
        $suiviDemande = null;
        $suiviErreur = null;

        if ($request->filled('suivi')) {
            $cle = trim((string) $request->string('suivi'));

            if ($cle !== '') {
                $suiviDemande = Message::query()
                    ->where('email', $cle)
                    ->orWhere('telephone', $cle)
                    ->latest()
                    ->first();

                if (! $suiviDemande) {
                    $suiviErreur = 'Aucune demande récente n\'a été trouvée pour cet email ou ce numéro.';
                }
            }
        }

        return view('pages.contact', compact('suiviDemande', 'suiviErreur'));
    }
}
