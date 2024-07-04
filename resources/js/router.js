import VueRouter from 'vue-router'

// Pages
const  Register = () => import('./components/Register')
const  Login = () => import('./components/Login')
const  ForgotPassword = () => import('./components/ForgotPassword')
const  ChangePassword = () => import('./components/ChangePassword')
const  Home = () => import('./components/HomeComponent.vue')
const  Statistic = () => import('./components/StatisticComponent.vue')
const  Profile = () => import('./components/ProfileComponent.vue')
const  Ville = () => import('./components/VilleComponent.vue')
const  Rubrique = () => import('./components/RubriqueComponent.vue')
const  BlogType = () => import('./components/BlogTypeComponent.vue')
const  Formulaire = () => import('./components/FormulaireComponent.vue')
const  BlogPost = () => import('./components/BlogPostComponent.vue')
const  Slide = () => import('./components/SlideComponent.vue')
const  Categorie = () => import('./components/CategorieComponent.vue')
const  Marque = () => import('./components/MarqueComponent.vue')

const Actualite = () => import('./components/actualite/ActualiteComponent.vue')
const Utilisateur = () => import('./components/UtilisateurComponent.vue')

const  Groupe = () => import('./components/groupe/GroupeComponent.vue')
const  GroupeItem = () => import('./components/groupe/GroupeItemComponent.vue')

const  Produit = () => import('./components/produit/ProduitComponent.vue')

const  Meeting = () => import('./components/meeting/MeetingComponent.vue')
const  MeetingItem = () => import('./components/meeting/MeetingItemComponent.vue')

const  Rfq = () => import('./components/rfq/RfqComponent.vue')
const  RfqItem = () => import('./components/rfq/RfqItemComponent.vue')

const  Importateur = () => import('./components/importateur/ImportateurComponent.vue')
const  ImportateurProfile = () => import('./components/importateur/ImportateurProfileComponent.vue')

const  Entreprise = () => import('./components/entreprise/EntrepriseComponent.vue')
const  EntrepriseAttente = () => import('./components/entreprise/EntrepriseAttenteComponent.vue')
const  EntrepriseProfile = () => import('./components/entreprise/EntrepriseProfileComponent.vue')

const  TraductionRubrique = () => import('./components/TraductionRubriqueComponent.vue')
const  Traduction = () => import('./components/TraductionComponent.vue')
const  TraductionTable = () => import('./components/TraductionTableComponent.vue')


const  Lecon = () => import('./components/LeconComponent.vue')
const  Lettre = () => import('./components/LettreComponent.vue')

const  ConfigurationTable = () => import('./components/ConfigurationTableComponent.vue')

// Routes
const routes = [{
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            layout: "no-sidebar"
        }
    },
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: ForgotPassword,
        meta: {
            layout: "no-sidebar",
            auth: false
        }
    },
    {
        path: '/change-password/:token',
        name: 'change-password',
        component: ChangePassword,
        meta: {
            layout: "no-sidebar",
            auth: false
        }
    },
    // USER ROUTES
    {
        path: '/equipe',
        component: Utilisateur,
        meta: {
            auth: true
        }
    },
    {
        path: '/profile',
        component: Profile,
        name: 'profile',
        meta: {
            auth: true
        }
    },
    {
        path: '/statistics',
        component: Statistic,
        name: 'statistics',
        meta: {
            auth: true
        }
    },
    {
        path: '/villes',
        component: Ville,
        name: 'villes',
        meta: {
            auth: true
        }
    },
    {
        path: '/blog_rubriques',
        component: BlogType,
        name: 'blog_rubriques',
        meta: {
            auth: true
        }
    },
    {
        path: '/lecons',
        component: Lecon,
        name: 'lecons',
        meta: {
            auth: true
        }
    },
    {
        path: '/cards',
        component: Lettre,
        name: 'cards',
        meta: {
            auth: true
        }
    },
    {
        path: '/configurations',
        component: ConfigurationTable,
        name: 'configurations',
        meta: {
            auth: true
        }
    },
    {
        path: '/event_formulaires',
        component: Formulaire,
        name: 'event_formulaires',
        meta: {
            auth: true
        }
    },
    {
        path: '/groupes',
        component: Groupe,
        name: 'groupes',
        meta: {
            auth: true
        }
    },
    {
        path: '/groupes/details',
        component: GroupeItem,
        name: 'groupe_item',
        meta: {
            auth: true
        }
    },
    {
        path: '/rubriques',
        component: Rubrique,
        name: 'rubriques',
        meta: {
            auth: true
        }
    },
    {
        path: '/blog_posts',
        component: BlogPost,
        name: 'blog_posts',
        meta: {
            auth: true
        }
    },
    {
        path: '/slides',
        component: Slide,
        name: 'slides',
        meta: {
            auth: true
        }
    },
    {
        path: '/categories',
        component: Categorie,
        name: 'categories',
        meta: {
            auth: true
        }
    },
    {
        path: '/marques',
        component: Marque,
        name: 'marques',
        meta: {
            auth: true
        }
    },
    {
        path: '/actualite',
        component: Actualite,
        name: 'actualite',
        meta: {
            auth: true
        }
    },
    {
        path: '/entreprises',
        component: Entreprise,
        meta: {
            auth: true
        }
    },
    {
        path: '/entreprises_en_attente',
        component: EntrepriseAttente,
        name: 'entreprises_en_attente',
        meta: {
            auth: true
        }
    },
    {
        path: '/entreprises/view',
        component: EntrepriseProfile,
        name: 'entreprise_profile',
        meta: {
            auth: true
        }
    },
    {
        path: '/produits',
        component: Produit,
        meta: {
            auth: true
        }
    },
    {
        path: '/meetings',
        component: Meeting,
        meta: {
            auth: true
        }
    },
    {
        path: '/meetings/details',
        component: MeetingItem,
        name: 'meeting_item',
        meta: {
            auth: true
        }
    },
    {
        path: '/rfqs',
        component: Rfq,
        meta: {
            auth: true
        }
    },
    {
        path: '/rfqs/details',
        component: RfqItem,
        name: 'rfq_item',
        meta: {
            auth: true
        }
    },
    {
        path: '/importateurs',
        component: Importateur,
        meta: {
            auth: true
        }
    },
    {
        path: '/importateurs/view',
        component: ImportateurProfile,
        name: 'importateur_profile',
        meta: {
            auth: true
        }
    },
    {
        path: '/traduction_rubriques',
        component: TraductionRubrique,
        name: 'traduction_rubriques',
        meta: {
            auth: true
        }
    },
    {
        path: '/traductions_liste',
        component: Traduction,
        name: 'traductions_liste',
        meta: {
            auth: true
        }
    },
    {
        path: '/traductions',
        component: TraductionTable,
        name: 'traductions',
        meta: {
            auth: true
        }
    },
    // ADMIN ROUTES
    /*
    {
      path: '/admin',
      name: 'admin.dashboard',
      component: AdminDashboard,
      meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
      }
    },
    */
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    base: '/admin0619',
    routes,
})

export default router
