<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Katedra
        \App\Department::create(["name" => "Katedra za Automatiku"]);                  // 1
        \App\Department::create(["name" => "Katedra za Elektroniku"]);                 // 2
        \App\Department::create(["name" => "Katedra za Energetiku"]);                  // 3
        \App\Department::create(["name" => "Katedra za Matematiku"]);                  // 4
        \App\Department::create(["name" => "Katedra za Merenja"]);                     // 5
        \App\Department::create(["name" => "Katedra za Mikroelektroniku"]);            // 6
        \App\Department::create(["name" => "Katedra za Računarstvo"]);                 // 7
        \App\Department::create(["name" => "Katedra za Telekomunikacije"]);            // 8
        \App\Department::create(["name" => "Katedra za Teorijsku Elektrotehniku"]);    // 9
        \App\Department::create(["name" => "Katedra za Opšte obrazovne predmete"]);    // 10


        // Smer
        \App\Module::create(["name" => "Računarstvo i informatika"]);       // 1
        \App\Module::create(["name" => "Elektroenergetika"]);               // 2
        \App\Module::create(["name" => "Elektronika"]);                     // 3
        \App\Module::create(["name" => "Elektronske komponente i mikrosistemi"]);   // 4
        \App\Module::create(["name" => "Upravljanje sistemima"]);           // 5
        \App\Module::create(["name" => "Telekomunikacije"]);                // 6


        // Predmet
        \App\Course::create(["name" => "Matematika 1",                         "module_id" => 1, "department_id" => 4]);
        \App\Course::create(["name" => "Matematika 2",                         "module_id" => 1, "department_id" => 4]);
        \App\Course::create(["name" => "Osnovi elektrotehnike 1",              "module_id" => 1, "department_id" => 9]);
        \App\Course::create(["name" => "Osnovi elektrotehnike 2",              "module_id" => 1, "department_id" => 9]);
        \App\Course::create(["name" => "Uvod u računarstvo",                   "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Algoritmi i programiranje",            "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Fizika",                               "module_id" => 1, "department_id" => 6]);
        \App\Course::create(["name" => "Elektronske komponente",               "module_id" => 1, "department_id" => 6]);

        \App\Course::create(["name" => "Diskretna matematika",                 "module_id" => 1, "department_id" => 4]);
        \App\Course::create(["name" => "Digitalna elektronika",                "module_id" => 1, "department_id" => 2]);
        \App\Course::create(["name" => "Objektno orijentisano programiranje",  "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Računarski sistemi",                   "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Logičko projektovanje",                "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Arhitektura i organizacija računara",  "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Strukture podataka",                   "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Programski jezici",                    "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Baze podataka",                        "module_id" => 1, "department_id" => 7]);

        \App\Course::create(["name" => "Engleski jezik 1",                     "module_id" => 1, "department_id" => 10]);
        \App\Course::create(["name" => "Operativni sistemi",                   "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Računarske mreže",                     "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Objektno orijentisano projektovanje",  "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Web programiranje",                    "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Telekomunikacije",                     "module_id" => 1, "department_id" => 8]);
        \App\Course::create(["name" => "Osnovi Analize signala i sistema",     "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Engleski jezik 2",                     "module_id" => 1, "department_id" => 10]);
        \App\Course::create(["name" => "Informacioni sistemi",                 "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Softversko inženjerstvo",              "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Mikroračunarski sistemi",              "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Distribuirani sistemi",                "module_id" => 1, "department_id" => 7]);
        \App\Course::create(["name" => "Sistemi baza podataka",                "module_id" => 1, "department_id" => 7]);


        // Oblasti
        \App\Domain::create(["course_id" => 1, "name" => "Kompleksni brojevi"]);
        \App\Domain::create(["course_id" => 1, "name" => "Sistemi jednaćina"]);
        \App\Domain::create(["course_id" => 1, "name" => "Polinomi"]);
        \App\Domain::create(["course_id" => 1, "name" => "Matrice"]);
        \App\Domain::create(["course_id" => 1, "name" => "Analitička geometrija"]);

        \App\Domain::create(["course_id" => 1, "name" => "Kompleksni brojevi"]);
        \App\Domain::create(["course_id" => 1, "name" => "Matrice"]);
        \App\Domain::create(["course_id" => 1, "name" => "Vektori"]);

        \App\Domain::create(["course_id" => 2, "name" => "Nizovi"]);
        \App\Domain::create(["course_id" => 2, "name" => "Tačke prekida funkcije"]);
        \App\Domain::create(["course_id" => 2, "name" => "Grafik funkcije"]);
        \App\Domain::create(["course_id" => 2, "name" => "Integrali"]);

        \App\Domain::create(["course_id" => 2, "name" => "Granične vrednosti"]);
        \App\Domain::create(["course_id" => 2, "name" => "Funkcije"]);
        \App\Domain::create(["course_id" => 2, "name" => "Integrali"]);

        \App\Template::create(["course_id" => 1, "name" => "Prvi kolokvijum"]);
        \App\Template::create(["course_id" => 1, "name" => "Drugi kolokvijum"]);
        \App\Template::create(["course_id" => 1, "name" => "Ispit"]);

        \App\Task::create(["domain_id" => 1, "type" => "practice", "body" => "Izracunati:"]);
        \App\Task::create(["domain_id" => 1, "type" => "practice", "body" => "Izracunati:"]);
        \App\Task::create(["domain_id" => 1, "type" => "practice", "body" => "Izracunati:"]);
        \App\Task::create(["domain_id" => 1, "type" => "practice", "body" => "Izracunati:"]);
        \App\Task::create(["domain_id" => 1, "type" => "theory", "body" => "Izvedi formulu:"]);
        \App\Task::create(["domain_id" => 1, "type" => "theory", "body" => "Izvedi formulu:"]);
        \App\Task::create(["domain_id" => 1, "type" => "theory", "body" => "Izvedi formulu:"]);
        \App\Task::create(["domain_id" => 1, "type" => "theory", "body" => "Izvedi formulu:"]);
    }
}
