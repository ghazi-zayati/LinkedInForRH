<?php

namespace Prototype\ConfigBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixturestest extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $date= new \DateTime();

// annee budgetaire
        $anneeBudgetaire= new AnneeBudgetaire();
        $anneeBudgetaire->setAnnee(2018);
        /*$anneeBudgetaire->setDateDebutPap() ;
        $anneeBudgetaire->setDateFinPap() ;
        $anneeBudgetaire->setDateDebutRap() ;
        $anneeBudgetaire->setDateFinRap() ;*/
        $anneeBudgetaire->setCreatedAt($date) ;
        $anneeBudgetaire->setUpdatedAt($date) ;
        $anneeBudgetaire->setCreatedBy(1) ;
        $anneeBudgetaire->setUpdatedBy(1) ;
        $manager->persist($anneeBudgetaire);

// Mission
        $mission = new Mission();
        $mission->setIntituleAr('وزارة التجهيز والإسكان والتهيئة الترابية');
        $mission->setIntituleFr("Ministère de l'équipement, de l'habitat et de l'aménagement du territoire");
        $mission->setEtat(1);
        $mission->setBudget(1);
        $user = $manager->getRepository('PrototypeConfigBundle:AppUser')->find(9);
        $mission->setResponsable($user);
        $mission->setCreatedAt($date) ;
        $mission->setUpdatedAt($date) ;
        $mission->setCreatedBy(1);
        $mission->setUpdatedBy(1);
        $manager->persist($mission);

        $programme1 = new Programme();
        $programme1->setIntituleAr("البنية التحتية للطرقات");
        $programme1->setIntituleFr("Infrastructure Routière");
        $programme1->setIdentifiant("Programme 1");
        $programme1->setMission($mission);
        $programme1->setResponsable($user);
        $programme1->setPresentationFr("-	La première priorité sera donnée à l'entretien de l’infrastructure routière et des pistes rurales");
/*-	Le développement du réseau routier sur l'ensemble du territoire et autoroutier maghrébin.
-	L’Amélioration de la sécurité routière en offrant un bon niveau de services infrastructurels aux usagers de la route et pistes rurales sur tout le territoire national.
");*/
        $programme1->setPresentationAr("ترتكز إستراتيجية البنية التحتية  للطرقات إلى أفق 2030 على محورين أساسيين: ") ;
        $programme1->setEtat(1) ;
        $programme1->setStatus(1) ;
        $programme1->setCreatedAt($date) ;
        $programme1->setUpdatedAt($date) ;
        $programme1->setCreatedBy(1);
        $programme1->setUpdatedBy(1);

        $manager->persist($programme1);

            $sousProgramme11= new SousProgramme();
            $sousProgramme11->setProgramme($programme1) ;
           // $sousProgramme11->setResponsable() ;
            $sousProgramme11->setIntituleFr("Développement de l’infrastructure routière");
            $sousProgramme11->setIntituleAr("تطوير البنية التحتية للطرقات");
            $sousProgramme11->setIdentifiant("Sous programme 1.1") ;
            $sousProgramme11->setPresentationAr("تطوير البنية التحتية للطرقات") ;
            $sousProgramme11->setPresentationFr("Développement de l’infrastructure routière") ;
            $sousProgramme11->setEtat(1) ;
            $sousProgramme11->setCreatedAt($date) ;
            $sousProgramme11->setUpdatedAt($date) ;
            $sousProgramme11->setCreatedBy(1);
            $sousProgramme11->setUpdatedBy(1);
            $sousProgramme11->setBudget(0) ;
            $manager->persist($sousProgramme11);

                        $objectif111=new ObjectifStrategique();
                        $objectif111->setSousProgramme($sousProgramme11) ;
                        $objectif111->setIntituleAr("تنمية وتطوير الطرقات والطرقات السيارة على الصعيد الوطني والمغاربي  ");
                        $objectif111->setIntituleFr("Développement des routes et des autoroutes à l'échelle nationale et  Maghrébin") ;
                        $objectif111->setDescriptionAr("تنمية وتطوير الطرقات والطرقات السيارة على الصعيد الوطني والمغاربي  ") ;
                        $objectif111->setDescriptionFr("Développement des routes et des autoroutes à l'échelle nationale et  Maghrébin") ;
                        //$objectif111->setType(1) ;
                        //$objectif111->setCategorie(1) ;
                        $objectif111->setCreatedAt($date) ;
                        $objectif111->setUpdatedAt($date) ;
                        $objectif111->setCreatedBy(1);
                        $objectif111->setUpdatedBy(1);
                        $manager->persist($objectif111);

                        $objectif112=new ObjectifStrategique();
                        $objectif112->setSousProgramme($sousProgramme11) ;
                        $objectif112->setIntituleFr("Améliorer l’accessibilité des zones rurales les plus enclavées aux réseaux classés") ;
                        $objectif112->setIntituleAr("تحسين ربط التجمعات الريفية بشبكة الطرقات المرقمة");
                        $objectif112->setDescriptionAr(" ") ;
                        $objectif112->setDescriptionFr(" ") ;
                        //$objectif112->setType() ;
                        //  $objectif112->setCategorie() ;
                        $objectif112->setCreatedAt($date) ;
                        $objectif112->setUpdatedAt($date) ;
                        $objectif112->setCreatedBy(1);
                        $objectif112->setUpdatedBy(1);
                          $manager->persist($objectif112);


                    $sousProgramme12= new SousProgramme();
                    $sousProgramme12->setProgramme($programme1) ;
                    // $sousProgramme12->setResponsable() ;
                    $sousProgramme12->setIntituleFr("Entretien du réseau routier classé et des pistes rurales");
                    $sousProgramme12->setIntituleAr("صيانة شبكة الطرقات المرقمة والمسالك الريفية");
                    $sousProgramme12->setIdentifiant("Sous programme 1.2") ;
                    $sousProgramme12->setPresentationAr(" ") ;
                    $sousProgramme12->setPresentationFr(" ") ;
                    $sousProgramme12->setEtat(1) ;
                    $sousProgramme12->setCreatedAt($date) ;
                    $sousProgramme12->setUpdatedAt($date) ;
                    $sousProgramme12->setCreatedBy(1);
                    $sousProgramme12->setUpdatedBy(1);
                    $sousProgramme12->setBudget(0) ;
                    $manager->persist($sousProgramme12);

                        $objectif121=new ObjectifStrategique();
                        $objectif121->setSousProgramme($sousProgramme12) ;
                        $objectif121->setIntituleFr("Maintien de la qualité et du réseau routier") ;
                        $objectif121->setIntituleAr("المحافظة على نوعية وجودة شبكة الطرقات");
                        $objectif121->setDescriptionAr( " ") ;
                        $objectif121->setDescriptionFr(" ") ;
                        // $objectif121->setType() ;
                        //$objectif121->setCategorie() ;
                        $objectif121->setCreatedAt($date) ;
                        $objectif121->setUpdatedAt($date) ;
                        $objectif121->setCreatedBy(1);
                        $objectif121->setUpdatedBy(1);
                        $manager->persist($objectif121);




                $programme2 = new Programme();
                $programme2->setIntituleAr("حماية المناطق العمرانية  والشريط الساحلي");
                $programme2->setIntituleFr("Protection des zones urbaines et du littoral");
                $programme2->setIdentifiant("Programme 2");
                $programme2->setMission($mission);
                $programme2->setResponsable($user);
                $programme2->setPresentationFr(" Elle s’articule autour de : -	La protection des zones urbaines contre les inondations ");//<br/>-	La mise en œuvre d’un programme annuel de réalisation des projets  à l’horizon 2020 et l’actualisation de cette étude jusqu’à l’horizon 2050 pour atteindre la protection de l’ensemble du territoire contre les inondations<br/>-	La protection du littoral et maitrise des ouvrages portuaires par la révision des limites du domaine public maritime, la réalisation des projets de protection du littoral contre l’érosion et l’amélioration de performance en matière de réalisation des projets portuaires ");
                $programme2->setPresentationAr("تتمثل إستراتيجية مجال حماية المناطق العمرانية و الشريط الساحلي أساسا فيما يلي:     : ") ;
                //$programme2->setEtat() ;
                $programme2->setStatus(1) ;
                $programme2->setCreatedAt($date) ;
                $programme2->setUpdatedAt($date) ;
                $programme2->setCreatedBy(1);
                $programme2->setUpdatedBy(1);
                $manager->persist($programme2);

                    $sousProgramme21= new SousProgramme();
                    $sousProgramme21->setProgramme($programme2) ;
                //$sousProgramme21->setResponsable() ;
                    $sousProgramme21->setIntituleFr("Protection des zones urbaines contre les inondations");
                    $sousProgramme21->setIntituleAr("حماية المناطق العمرانية من الفيضانات");
                    $sousProgramme21->setIdentifiant("Sous Programme 2.1") ;
                $sousProgramme21->setPresentationAr(" ") ;
                $sousProgramme21->setPresentationFr(" ") ;
                //$sousProgramme21->setEtat() ;
                $sousProgramme21->setCreatedAt($date) ;
                $sousProgramme21->setUpdatedAt($date) ;
                $sousProgramme21->setCreatedBy(1);
                $sousProgramme21->setUpdatedBy(1);
                $sousProgramme21->setBudget(0) ;
                    $manager->persist($sousProgramme21);

                        $objectif211=new ObjectifStrategique();
                        $objectif211->setSousProgramme($sousProgramme21) ;
                        $objectif211->setIntituleFr("Maîtrise des eaux de ruissellement provenant des bassins versants extérieurs des villes et des agglomérations urbaines et garantie de la fonctionnalité des ouvrages de protection exécutés.") ;
                        $objectif211->setIntituleAr("التحكم في مياه السيلان المتأتية من الأحواض الساكبة على مشارف المدن والتجمعات السكنية و ضمان وظيفية المنشآت المنجزة");
                        $objectif211->setDescriptionAr(" ") ;
                        $objectif211->setDescriptionFr(" ") ;
                        //$objectif211->setType() ;
                        //$objectif211->setCategorie() ;
                        $objectif211->setCreatedAt($date) ;
                        $objectif211->setUpdatedAt($date) ;
                        $objectif211->setCreatedBy(1);
                        $objectif211->setUpdatedBy(1);
                        $manager->persist($objectif211);

                    $sousProgramme22= new SousProgramme();
                    $sousProgramme22->setProgramme($programme2) ;
                    //$sousProgramme22->setResponsable() ;
                    $sousProgramme22->setIntituleFr("Protection du Littoral et maitrise des ouvrages portuaires");
                    $sousProgramme22->setIntituleAr("حماية الشريط الساحلي و إحكام إنجاز المنشآت المينائية");
                    $sousProgramme22->setIdentifiant("Sous programme 2.2") ;
                    $sousProgramme22->setPresentationAr(" ") ;
                    $sousProgramme22->setPresentationFr(" ") ;
                    //$sousProgramme22->setEtat() ;
                    $sousProgramme22->setCreatedAt($date) ;
                    $sousProgramme22->setUpdatedAt($date) ;
                    $sousProgramme22->setCreatedBy(1);
                    $sousProgramme22->setUpdatedBy(1);
                    $sousProgramme22->setBudget(0) ;
                    $manager->persist($sousProgramme22);

                        $objectif221=new ObjectifStrategique();
                        $objectif221->setSousProgramme($sousProgramme22) ;
                        $objectif221->setIntituleFr("Conservation du domaine public maritime, protection du littoral contre l’érosion et maîtrise des ouvrages portuaires.") ;
                        $objectif221->setIntituleAr("حفظ الملك العمومي البحري وحماية الشريط الساحلي من الانجراف البحري و تطوير إنجاز المنشآت المينائية");
                        $objectif221->setDescriptionAr(" ") ;
                        $objectif221->setDescriptionFr(" ") ;
                        //$objectif221->setType() ;
                        // $objectif221->setCategorie() ;
                        $objectif221->setCreatedAt($date) ;
                        $objectif221->setUpdatedAt($date) ;
                        $objectif221->setCreatedBy(1);
                        $objectif221->setUpdatedBy(1);
                        $manager->persist($objectif221);

                $programme3 = new Programme();
                $programme3->setIntituleAr("التهيئة الترابية والتعمير والإسكان");
                $programme3->setIntituleFr("A.T, Urbanisme et Habitat");
                $programme3->setIdentifiant("Programme 3");
                $programme3->setMission($mission);
                $programme3->setResponsable($user);
                $programme3->setPresentationFr("La stratégie du programme consiste à assurer la répartition des activités démographiques et économiques sur le territoire national en vue d'établir un développement durable, ");// juste, équilibré et global entre les régions, établir un urbanisme durable pour les villes et les communautés rurales, promouvoir le logement social et faciliter l’accès à la propriété.");
                $programme3->setPresentationAr("يختص هذا البرنامج برسم سياسة عمومية تضم ثلاثة برامج فرعية ") ;
                //$programme3->setEtat() ;
                $programme3->setStatus(1) ;
                $programme3->setCreatedAt($date) ;
                $programme3->setUpdatedAt($date) ;
                $programme3->setCreatedBy(1);
                $programme3->setUpdatedBy(1);
                $manager->persist($programme3);

                    $sousProgramme31= new SousProgramme();
                    $sousProgramme31->setProgramme($programme3) ;
                // $sousProgramme31->setResponsable() ;
                    $sousProgramme31->setIntituleFr("Aménagement du Territoire");
                    $sousProgramme31->setIntituleAr("التهيئة الترابية ");
                    $sousProgramme31->setIdentifiant("Sous programme 3.1") ;
                    $sousProgramme31->setPresentationAr(" ") ;
                    $sousProgramme31->setPresentationFr(" ") ;
                // $sousProgramme31->setEtat() ;
                $sousProgramme31->setCreatedAt($date) ;
                $sousProgramme31->setUpdatedAt($date) ;
                $sousProgramme31->setCreatedBy(1);
                $sousProgramme31->setUpdatedBy(1);
                $sousProgramme31->setBudget(0) ;
                    $manager->persist($sousProgramme31);

                    $sousProgramme32= new SousProgramme();
                    $sousProgramme32->setProgramme($programme3) ;
                //$sousProgramme32->setResponsable() ;
                    $sousProgramme32->setIntituleFr("Urbanisme");
                    $sousProgramme32->setIntituleAr("التعمير ");
                    $sousProgramme32->setIdentifiant("Sous programme 3.2") ;
                $sousProgramme32->setPresentationAr(" ") ;
                $sousProgramme32->setPresentationFr(" ") ;
                //$sousProgramme32->setEtat() ;
                $sousProgramme32->setCreatedAt($date) ;
                $sousProgramme32->setUpdatedAt($date) ;
                $sousProgramme32->setCreatedBy(1);
                $sousProgramme32->setUpdatedBy(1);
                $sousProgramme32->setBudget(0) ;
                    $manager->persist($sousProgramme32);

                    $sousProgramme33= new SousProgramme();
                    $sousProgramme33->setProgramme($programme3) ;
                // $sousProgramme33->setResponsable() ;
                    $sousProgramme33->setIntituleFr("Habitat");
                    $sousProgramme33->setIntituleAr("الإسكان");
                    $sousProgramme33->setIdentifiant("Sous programme 3.3") ;
                 $sousProgramme33->setPresentationAr(" ") ;
                $sousProgramme33->setPresentationFr(" ") ;
                //$sousProgramme33->setEtat() ;
                $sousProgramme33->setCreatedAt($date) ;
                $sousProgramme33->setUpdatedAt($date) ;
                $sousProgramme33->setCreatedBy(1);
                $sousProgramme33->setUpdatedBy(1);
                 $sousProgramme33->setBudget(0) ;
                    $manager->persist($sousProgramme33);

                $programme4 = new Programme();
                $programme4->setIntituleAr("تطوير وتنمية قطاع البناء");
                $programme4->setIntituleFr("Promotion et développement Du secteur de la construction");
                $programme4->setIdentifiant("Programme 4");
                $programme4->setMission($mission);
                $programme4->setResponsable($user);
                $programme4->setPresentationFr("");
                $programme4->setPresentationAr("") ;
                //$programme4->setEtat() ;
                $programme4->setStatus(1) ;
                $programme4->setCreatedAt($date) ;
                $programme4->setUpdatedAt($date) ;
                $programme4->setCreatedBy(1);
                $programme4->setUpdatedBy(1);
                $manager->persist($programme4);

                    $sousProgramme41= new SousProgramme();
                    $sousProgramme41->setProgramme($programme4) ;
                // $sousProgramme41->setResponsable() ;
                    $sousProgramme41->setIntituleFr("La politique Nationale de la Construction");
                    $sousProgramme41->setIntituleAr("السياسة الوطنية للبناء");
                    $sousProgramme41->setIdentifiant("Sous programme 4.1") ;
                $sousProgramme41->setPresentationAr(" ") ;
                $sousProgramme41->setPresentationFr(" ") ;
                //$sousProgramme41->setEtat() ;
                $sousProgramme41->setCreatedAt($date) ;
                $sousProgramme41->setUpdatedAt($date) ;
                $sousProgramme41->setCreatedBy(1);
                $sousProgramme41->setUpdatedBy(1);
                $sousProgramme41->setBudget(0) ;
                    $manager->persist($sousProgramme41);

                    $sousProgramme42= new SousProgramme();
                    $sousProgramme42->setProgramme($programme4) ;
                //$sousProgramme42->setResponsable() ;
                    $sousProgramme42->setIntituleFr("Exemplarité de la Construction Publique");
                    $sousProgramme42->setIntituleAr("مثالية البناء العمومي");
                    $sousProgramme42->setIdentifiant("Sous programme 4.2") ;
                $sousProgramme42->setPresentationAr(" ") ;
                $sousProgramme42->setPresentationFr(" ") ;
                //$sousProgramme42->setEtat() ;
                $sousProgramme42->setCreatedAt($date) ;
                $sousProgramme42->setUpdatedAt($date) ;
                $sousProgramme42->setCreatedBy(1);
                $sousProgramme42->setUpdatedBy(1);
                $sousProgramme42->setBudget(0) ;
                $manager->persist($sousProgramme42);

                $programme5 = new Programme();
                $programme5->setIntituleAr("القيادة  والمساندة");
                $programme5->setIntituleFr("Pilotage et Appui");
                $programme5->setIdentifiant("Programme 9");
                $programme5->setMission($mission);
                $programme5->setResponsable($user);
                $programme5->setPresentationFr("");
                $programme5->setPresentationAr("") ;
                //$programme5->setEtat() ;
                $programme5->setStatus(1) ;
                $programme5->setCreatedAt($date) ;
                $programme5->setUpdatedAt($date) ;
                $programme5->setCreatedBy(1);
                $programme5->setUpdatedBy(1);
                $manager->persist($programme5);

                    $sousProgramme51= new SousProgramme();
                    $sousProgramme51->setProgramme($programme5) ;
                //$sousProgramme51->setResponsable() ;
                    $sousProgramme51->setIntituleFr("Pilotage");
                    $sousProgramme51->setIntituleAr("القيادة");
                    $sousProgramme51->setIdentifiant("Sous programme 9.1") ;
                    $sousProgramme51->setPresentationAr(" ") ;
                    $sousProgramme51->setPresentationFr(" ") ;
                //$sousProgramme51->setEtat() ;
                $sousProgramme51->setCreatedAt($date) ;
                $sousProgramme51->setUpdatedAt($date) ;
                $sousProgramme51->setCreatedBy(1);
                $sousProgramme51->setUpdatedBy(1);
                $sousProgramme51->setBudget(0) ;
                    $manager->persist($sousProgramme51);

                    $sousProgramme52= new SousProgramme();
                    $sousProgramme52->setProgramme($programme5) ;
                //$sousProgramme52->setResponsable() ;
                    $sousProgramme52->setIntituleFr("Appui");
                    $sousProgramme52->setIntituleAr("المساندة");
                    $sousProgramme52->setIdentifiant("Sous programme 9.2") ;
                    $sousProgramme52->setPresentationAr(" ") ;
                    $sousProgramme52->setPresentationFr(" ") ;
                //$sousProgramme52->setEtat() ;
                $sousProgramme52->setCreatedAt($date) ;
                $sousProgramme52->setUpdatedAt($date) ;
                $sousProgramme52->setCreatedBy(1);
                $sousProgramme52->setUpdatedBy(1);
                $sousProgramme52->setBudget(0) ;
                    $manager->persist($sousProgramme52);





        $manager->flush();
    }
}
