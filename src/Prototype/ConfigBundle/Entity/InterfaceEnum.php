<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Abidi
 * Date: 24/10/2018
 * Time: 10:31
 */

namespace Prototype\ConfigBundle\Entity;


abstract class InterfaceEnum
{
    const ACCESS_ACTIVITE = "Activité";
    const ACCESS_SOUS_ACTIVITY = "Sous-activité";
    const ACCESS_FORMULE = "Formule";
    const ACCESS_MISSION = "Mission";
    const ACCESS_OBJ_OPER = "Objectif opérationnel";
    const ACCESS_OBJ_STRAT = "Objectif stratégique";
    const ACCESS_PROGRAMME = "Programme";
    const ACCESS_SOUS_PROGRAMME = "Sous-programme";
    const ACCESS_PROJET = "Projet";
    const ACCESS_REFERENTIEL = "Référentiel";
    const ACCESS_STRUCTURE = "Structure";

    /**
     * @return array<string>
     */
    public static function getAllInterfaces()
    {
        return [
            self::ACCESS_ACTIVITE,
            self::ACCESS_SOUS_ACTIVITY,
            self::ACCESS_FORMULE,
            self::ACCESS_MISSION,
            self::ACCESS_OBJ_OPER,
            self::ACCESS_OBJ_STRAT,
            self::ACCESS_PROGRAMME,
            self::ACCESS_SOUS_PROGRAMME,
            self::ACCESS_PROJET,
            self::ACCESS_REFERENTIEL,
            self::ACCESS_STRUCTURE
        ];
    }
}