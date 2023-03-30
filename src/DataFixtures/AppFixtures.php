<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Issue;
use App\Entity\Statut;
use App\Entity\Ticket;
use App\Entity\Hardware;
use App\Entity\Solution;
use App\Entity\Entreprise;
use App\Entity\TicketAction;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // Encoder le mot de passe de l'utilisateur
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->passwordHasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // Creation d'utilisateur
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setRoles(["ROLE_TECH","ROLE_ADMIN"]);
        $admin->setName('admin');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
        $manager->persist($admin);
        // Creation d'entreprise
        $entreprise = new Entreprise();
        $entreprise->setEmail('step@step.fr');
        $entreprise->setNom('step');
        $entreprise->setAdresse('8 rue richelieu');
        $entreprise->setCodePostal('64000');
        $entreprise->setVille('Pau');
        $entreprise->setTelephone('0123456789');
        $manager->persist($entreprise);

        // Creation de type
        $type1 = new Type();
        $type1->setCode(1);
        $type1->setNom('Pc portable');
        $manager->persist($type1);

        $type2 = new Type();
        $type2->setCode(2);
        $type2->setNom('Pc fixe');
        $manager->persist($type2);

        $type3 = new Type();
        $type3->setCode(3);
        $type3->setNom('Écran');
        $manager->persist($type3);

        // Creation d'hardware
        $hardware = new Hardware();
        $hardware->setLibelle('Apple MacBook Pro');
        $hardware->setSerialNum('198419922000');
        $hardware->setEntreprise($entreprise);
        $hardware->setType($type1);
        $manager->persist($hardware);

        // Creation d'hardware
        $hardware = new Hardware();
        $hardware->setLibelle('Lenovo Thinkpad');
        $hardware->setSerialNum('D8419GR422000');
        $hardware->setEntreprise($entreprise);
        $hardware->setType($type1);
        $manager->persist($hardware);

        // Creation du ticket
        $ticket = new Ticket();
        $ticket->setNumber(84-92-20);
        $ticket->setIntitule('first ticket');
        $ticket->setDescription('This is the first ticket');
        $ticket->setHardware($hardware);
        $manager->persist($ticket);

        // Creation de statut
        $statut1 = new Statut();
        $statut1->setCode(7);
        $statut1->setType('Urgence');
        $manager->persist($statut1);

        $statut2 = new Statut();
        $statut2->setCode(7);
        $statut2->setType('Urgence');
        $manager->persist($statut1);

        // Creation d'issue
        $issue = new Issue();
        $issue->setIntitule('Problem');
        $issue->setDescription('This is the first issue');
        $manager->persist($issue);

        // Creation de solution
        $solution = new Solution();
        $solution->setIntitule('Solution 1');
        $solution->setDescription('This is the first solution');
        $solution->setIssue($issue);
        $manager->persist($solution);

        // Creation d'une action 
        $action = new TicketAction();
        $action->setIntitule('Technicien 1');
        $action->setDescription('Ticket pour le technicien 1');
        $action->setTemps(48);
        $action->setPriorite(5);
        $action->setCreatedAt(new \DateTimeImmutable());
        $action->setUpdatedAt(new \DateTimeImmutable());
        $action->setUser($admin);
        $action->setTicket($ticket);
        $action->setStatut($statut1);
        $action->setIssue($issue);
        $manager->persist($action);

        $manager->flush();
    }
}

