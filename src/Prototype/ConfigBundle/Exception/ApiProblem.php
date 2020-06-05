<?php

namespace Prototype\ConfigBundle\Exception;

class ApiProblem
{

    private $statusCode;
    private $message;

    const USER_NOT_EXIST = array('fr' => 'Utilisateur inexistant', 'ar' => 'مستخدم غير موجود');
    const WRONG_PASSWORD = array('fr' => 'Nom d\'utilisateur ou mot de passe erroné(s)', 'ar' => 'اسم المستخدم أو كلمة المرور غير صحيحة');
    const GOUVERNORAT_NOT_EXIST = 'gouvernorat not exist';
    const DEMANDES_DOES_NOT_EXIST = array('fr' => 'il n\'y a pas de demandes', 'ar' => 'لا توجد مطالب');
    const SPECIALITE_EXISTANTE = array('fr' => 'il ya une demande avec cette spécialité depuis {delai}  ', 'ar' => ' منذ {delai} هناك طلب مع هذا التخصص');
    const CIN_EMPTY = array('fr' => 'le numero de cin est obligatoire', 'ar' => 'تعمير هذا الحقل إجباري');
    const CIN_EQUAL_8 = array('fr' => 'Numéro cin doit comporter 8 chiffres', 'ar' => 'يجب أن يكون رقم بطاقة الهوية 8 أرقام');
    const TEL_EQUAL_13 = array('fr' => 'Numéro téléphone doit comporter 13 chiffres', 'ar' => 'يجب أن يكون رقم الهاتف 13 أرقام');
    const TEL_NUMERIQUE = array('fr' => 'Numéro téléphone doit etre numérique', 'ar' => 'يجب أن يكون رقم الهاتف رقميًا');
    const NATIONALITY_EMPTY = array('fr' => 'la nationalite est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const NATIONALITY_NOT_EXIST = array('fr' => 'la nationalite inexistante', 'ar' => 'تعمير هذا الحقل إجباري');
    const NOM_EMPTY = array('fr' => 'le nom est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const PRENOM_EMPTY = array('fr' => 'le prenom  est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DATE_NAISSANCE_EMPTY = array('fr' => 'la date de naissance est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const TEL_EMPTY = array('fr' => 'Téléphone est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const EMAIL_EMPTY = array('fr' => 'le mail est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const SEXE_EMPTY = array('fr' => 'le champ sexe est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const LIEU_NAISSANCE_EMPTY = array('fr' => 'le lieu de naissance est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const PERSONNE_BESOIN_SPECIFIQUE_EMPTY = array('fr' => 'le personne a besoin spécifique est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const NATURE_BESOIN_SPECIFIQUE_EMPTY = array('fr' => 'la nature du besoin spécifique est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const NIVEAU_ETUDE_EMPTY = array('fr' => 'le niveau d\'etude est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DATE_INSCRIPTION_EMPTY = array('fr' => 'la date d\'inscription est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const CIN_NOT_NUMERIC = array('fr' => 'Numéro de cin doit etre numérique', 'ar' => 'يجب أن يكون رقم بطاقة الهوية رقميًا');
    const PASSPORT_EMPTY = array('fr' => 'le numero de passport est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const PASSPORT_EQUAL_8 = array('fr' => 'Numéro de passport doit comporter 8 chiffres', 'ar' => 'رقم جواز السفر يجب أن يتكون من 8 أرقام ');
    const DATE_DELIVRANCE_PASSPORT_EMPTY = array('fr' => 'Date de delivrance passport est obligatoire non renseigné', 'ar' => 'تاريخ تسليم جواز السفر إلزامي ، وليس معبأ ');
    const DATE_DELIVRANCE_CIN_EMPTY = array('fr' => 'Date de delivrance CIN est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const FIELD_REQUIRED_IS_EMPTY = array('fr' => 'Champ obligatoire non renseigné', 'ar' => 'خانة فارغة ، يجب تعميرها');
    const PASSWORD_USER_RESET_SUCCESS = array('fr' => 'Mot de passe réinitialisé avec succès', 'ar' => 'إعادة تعمير كلمة المرور بنجاح');
    const PASSWORD_USER_RESET_ECHEC = array('fr' => 'operation échouée', 'ar' => 'شكرا لتصحيح الاخطاء');
    const MESSAGE_GLOBAL = array('fr' => 'Le formulaire n\'est pas valide, merci de corriger les erreurs', 'ar' => 'الاستمارة غير صحيحة ، يرجى تصحيح الأخطاء');
    const SPECIALITE_NOT_EXIST = array('fr' => 'Spécialité non existant', 'ar' => 'التخصص غير موجود');

    const TOKEN_JWT_EXPIRED = array('fr' => 'Merci de vous reconnecter', 'ar' => 'شكرا لك على إعادة تسجيل الدخول');

    const EMAIL_EXIST_IN_DATABASE = array('fr' => 'Adresse Email déjà existe', 'ar' => 'البريد الإلكتروني موجود ');
    const EMAIL_FALSE = array('fr' => 'Adresse Email n\'est pas valide', 'ar' => 'البريد الإلكتروني خاطئ ');
    const CIN_EXIST_IN_DATABASE = array('fr' => 'Numéro carte CIN existe déjà ', 'ar' => 'رقم بطاقة الهوية موجود ');
    const PASSPORT_EXIST_IN_DATABASE = array('fr' => 'Numéro du passeport existe déjà ', 'ar' => 'رقم جواز السفر موجود ');
    const DEMANDE_NOT_EXIST = array('fr' => 'Demande n\'existe pas ', 'ar' => 'هذا المطلب غير موجود ');
    const SEJOUR_EMPTY = array('fr' => 'le numero de séjour est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DATE_VALIDITE_SEJOUR_EMPTY = array('fr' => 'la date de validite de séjour est  obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const GOUVERNERAT_EMPTY = array('fr' => 'la gouvernorat est  obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DELEGATION_EMPTY = array('fr' => 'la délégation  est  obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    // IF REFERENCIEL DOES NOT EXIST IN DATABASE
    const NATIONALITY_DOES_NOT_EXIST = array('fr' => 'Nationalité n\'existe pas ', 'ar' => 'نظام مرجعية الجنسية غير موجودة');
    const GOUVERNERAT_DOES_NOT_EXIST = array('fr' => 'Gouvernorat n\'existe pas ', 'ar' => 'خانة  الولاية غير موجودة');
    const DELEGATION_DOES_NOT_EXIST = array('fr' => 'Délégation n\'existe pas ', 'ar' => 'خانة  المعتمدية غيرموجودة');
    const DIRECTION_REGIONAL_DOES_NOT_EXIST = array('fr' => 'Direction régionale n\'existe pas ', 'ar' => 'الإدارة الإقليمية غير موجودة');
    const NATURE_BESOIN_SPECIFIQUE_DOES_NOT_EXIST = array('fr' => 'Nature besoin spécifique n\'existe pas ', 'ar' => 'خانة طبيعة حاجة محددة غير موجودة');
    const NIVEAU_ETUDE_DOES_NOT_EXIST = array('fr' => 'Niveau étude n\'existe pas ', 'ar' => 'خانة مستوى الدراسة غير موجودة');
    const ROLES_DOES_NOT_EXIST = array('fr' => 'Role utilisateur n\'existe pas ', 'ar' => 'دور المستخدم غير موجود');
    const SECTEUR_DOES_NOT_EXIST = array('fr' => 'Secteur n\'existe pas ', 'ar' => 'خانة القطاع غير موجودة');
    const DOMAINE_DOES_NOT_EXIST = array('fr' => 'Domaine  n\'existe pas ', 'ar' => 'خانة الميدان غير موجودة');
    const JUSTIF_EXPERIENCE_DOES_NOT_EXIST = array('fr' => 'Expériences  n\'existe pas ', 'ar' => 'خانة الخبرة غير موجودة');
    const CENTRE_FORMATION_DOES_NOT_EXIST = array('fr' => 'Centre de formation  n\'existe pas ', 'ar' => 'مركز التكوين غير موجود ');

    const DELEGATION_NOT_EXIST = 'delegation not exist';
    const SOLEIL_NOT_EXIST = 'soleil not exist';
    const IMSAKIA_NOT_EXIST = 'Imsakia inexistante';
    const LUNE_NOT_EXIST = 'lune not exist';
    const PHASELUNE_NOT_EXIST = 'phase lune  not exist';
    const PRIERE_NOT_EXIST = 'priere  not exist';
    const OBSERVATION_NOT_EXIST = "observation not exist";
    const PREVISION_NOT_EXIST = "prévision not exist";
    const CATEGORIE_NOT_EXIST = "categorie not exist";
    const Region_NOT_EXIST = 'region not exist';
    const PICTOGRAMME_NOT_EXIST = "pictogramme not exist";
    const ECHEANCE_NOT_EXIST = "echeance not exist";
    const PLAGE_NOT_EXIST = "plage not exist";
    const DIRECTION_VENT_NOT_EXIST = " direction du vent not exist";
    const M001 = 'Le paramétrage défini dans le système n’est pas conforme avec la source de données (Fichier d’alimentation)';
    const LOGIN_ERROR = "login erreur";
    const CONNEXION_ERROR = "connexion erreur";
    const DISABLED_USER = 'disabled user';
    const VILLE_NOT_EXIST = 'ville not exist';
    const PAY_ETRANGER_NOT_EXIST = ' pays étranger not exist';
    const PAY_MONDE_NOT_EXIST = ' pays monde not exist';
    const Upload_failed = 'Upload failed';
    const SOUS_PROGRAMME_NOT_EXIST = 'Sous-programme inexistant';
    const PROGRAMME_NOT_EXIST = 'Programme inexistant';
    const PROJET_NOT_EXIST = 'Projet inexistant';
    const RESPONSABLE_NOT_EXIST = 'Responsable inexistant';
    const CHEF_PROJET_NOT_EXIST = 'Chef de projet inexistant';
    const MISSION_NOT_EXIST = 'Mission inexistante';
    const REFERNCIEL_NOT_EXIST = 'Référenciel inexistant';
    const REGION_NOT_EXIST = 'region inexistant';
    const REGION_REQUIRED = 'region obligatoire';
    const ACTIVITY_NOT_EXIST = 'Activité inexistante';
    const BUDGET_YEAR_NOT_EXIST = 'Année budgetaire inexistante';
    const OBJECTIF_OPERATIONNEL_NOT_EXIST = 'Objectif opérationnel inexistant';
    const INDICATEUR_OPERATIONNEL_NOT_EXIST = 'Indicateur opérationnel inexistant';
    const USERNAME_REQUIRED = "Nom d'utilisateur obligatoire";
    const PASSWORD_REQUIRED = "Mot de passe obligatoire";
    const SOUS_ACTIVITY_NOT_EXIST = 'Sous-activité inexistante';
    const OBJECTIF_STRATIGIQUE_NOT_EXIST = 'Objectif stratégique inexistant';
    const STRUCTURE_NOT_EXIST = 'Structure inexistante';
    const ORIENTATION_STRATIGIQUE_NOT_EXIST = 'Orientation stratégique inexistante';
    const PERMISSION_DENIDED = "Vous n'êtes pas autorisé à accéder à cette ressource";
    const USERNAME_ALREADY_EXISTS = "Nom d'utilisateur existe déjà";
    const EMAIL_ALREADY_EXISTS = 'Adresse e-mail existe déjà';
    const USER_NOT_FOUND = 'Utilisateur inconnu';
    const STRATEGIC_INDICATOR_NOT_EXIST = 'Indicateur stratégique inexistant';
    const FORMULE_NOT_FOUND = 'Formule inexistante';
    const STRUCTURE_NOT_OPERATIONNEL = "La structure séléctionnée n'est pas de type opérationnel";
    const INDICATEUR_OPERATIONNEL_REQUIRED = 'Indicateur opérationnel obligatoire';
    const NOM_REQUIRED = 'Nom obligatoire';
    const VALEUR_REQUIRED = 'Valeur obligatoire';
    const OPERATEUR_REQUIRED = 'Opérateur obligatoire';
    const FORMULE_INVALIDE = 'Formule invalide';
    const CDMT_NOT_EXIST = "CDMT inexistant";
    const CDMT_NOT_FOUND_BUDGET_YEAR = "Aucun CDMT n'appartient à cette année budgetaire";
    const CDMT_NOT_FOUND_PROGRAMME = "Aucun CDMT n'appartient à ce programme";
    const FOND_SPECIAUX_NOT_EXIST = "Fond speciaux inexistant";
    const DELETE_ERROR = "Vous devez supprimer les enregistrements associés";
    const BUDGET_TITRE1_NOT_EXIST = "Budget titre 1 inexistant";
    const BUDGET_TITRE2_NOT_EXIST = "Budget titre 2 inexistant";
    const ROLE_NOT_EXIST = "Rôle inexistant";
    const PERMISSION_NOT_EXIST = "Permission inexistante";
    const VIGILANCE_NOT_EXIST = "Vigilance inexistante";
    const VIGILANCESAISIPDF_NOT_EXIST = 'La table vigillancezonessaisipdf est vide';
    const SISMOLOGIE_NOT_EXIST = "Sismologie inexistante";
    const COULEUR_NOT_EXIST = 'Le code Couleur est inexistant';
    const HEURE_NOT_EXIST = 'Heure inexistante';
    const FORCE_NOT_EXIST = "Force prevision marine inexistant";
    const VENTDIRECTION_NOT_EXIST = "Direction vent marine inexistant";
    const MER_NOT_EXIST = "Etat Mer Inexistant";
    const DIRECTION_HOULE_NOT_EXIST = "Direction houle inexistant";
    const ZONEMARINE_NOT_EXIST = "Zone marine inexistant";
    const VISIBILITE_NOT_EXIST = "visibilite inexistant";
    const TEMPS_NOT_EXIST = "Temps inexistant";
    const REGION_STATION_NOT_EXIST = "Station not exist";
    const serializerGroups = "ClimatologieGroup";
    const DOCUMENTATION_NOT_EXIST = "documentation not exist";
    const PHENOMENE_NOT_EXIST = "Phénomène Astronomique  inexistant";
    /* Bloc de lecture Radhia */
    const AVIS_NOT_EXIST = "Ref Avis not exist";
    const AVIS_STATUS_NOT_EXIST = "Ref avis status not exist";
    const ZONESTATUS_NOT_EXIST = "Ref zone status not exist";
    const BMS_NOT_EXIST = "Bms not exist";
    const PARAM_NOT_EXIST = "Parametre not exist";
    const CLIMATOLOGIE_NOT_EXIST = "climatologie not exist";
    const TRANSITION_NOT_EXIST = "Transition not exist";
    const TOKEN_NOT_EXIST = 'Token inexistant';
    const TOKEN_NOT_VALIDE = 'Token invalide';
    const TOKEN_EXPIRED = 'Token expiré';
    const ROLE_ALREADY_EXIST = "Rôle existe déjà";
    const PRESENTATION_NOT_EXIST = "Presentation not exist";
    const COMMUNIQUE_NOT_EXIST = "Communique not exist";
    const AVIS_TRANSITION_NOT_EXIST = "Avis transition not exist";
    const TRAINING_NOT_EXIST = "Training not exist";
    const RCCSTATION_NOT_EXIST = "RCC station not exist";
    const File_REQUIRED = "File required";


    /* */
    /* Bloc de lecture Omar */
    const USER_NOT_ENABLED = "User not enabled";
    const PREVISION_TYPE_UNKNOW = "Inconnu paramétre type : 3 paramétres MATIN APM MOYENNE sont autorisées";
    const PREVISION_MARINE_TRANSITION = "Transition not exist";

    /**/

    public function __construct($statusCode, $message)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function toArray()
    {
        return
            [
                'code' => $this->statusCode,
                'message' => $this->message
            ];
    }

}
