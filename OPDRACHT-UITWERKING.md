Zojuist heb ik de opdracht doorgenomen. Een schematisch plan maak ik hieruit op
1. Maak migrations en bijbehorende models;
2. Maak seeders;
3. Maak een ScoreboardService met een methode met die de hoogste score per vaardigheid ophaalt en bij welke speler dit hoort;
4. Maak een ScoreboardService met een methode een score berekening om te zien wat de score is per speler 

## Stap 1: Maak migrations en bijbehorende models
Als eerste denk ik aan 4 tabellen: Player, Game, Skill, en Score. De eerste drie zijn losse entities, score is degene die de relaties legt tussen de spelers, spellen en vaardigheden.
- `php artisan make:model Player -mf`
- `php artisan make:model Game -mf`
- `php artisan make:model Skill -mf`

Voortschrijdend inzicht: ik heb pas een factory nodig als ik meer ga opslaan dan enkel een naam, voor nu behoud ik de bestanden voor als ik later uitbreid.

Een game kan 1 of meer skills hebben, en een skill kan ook aan meerdere games toebehoren. daarom een veel op veel relatie
`php artisan make:migration create_game_skill_table`

Het vierde model Score en legt relaties tussen de spelers, spellen en natuurlijk noteert wat de score is
- `php artisan make:model Score -mf`

## Stap 2: Maak seeders
De relaties heb ik nu gelegd en de factories zijn aangemaakt. Tijdens het migreren worden alle tabellen en relaties aangemaakt.

## Stap 3: Maak een ScoreboardService
Nu ga ik een service maken die de hoogste score per vaardigheid ophaalt en bij welke speler dit hoort. Hiervoor maak ik een service class aan. 
De reden voor een service class is dat ik deze (later) kan implementeren in een commando of controller, en dat ik deze kan testen zonder dat ik een controller of commando hoef te maken.

Ik heb een service class gemaakt, met de twee functies, en schrijf eerst een test met afgebakende data.
- Ik verwacht een array gevuld het aantal skills, per item staat de hoogste score, de skillnaam, en de spelernaam;
- Ik vul de test met een aangepaste versie van mijn factory, waardoor ik beter kan testen;
- Ik maak een test die de hoogste score per vaardigheid ophaalt en bij welke speler dit hoort;

Daarnaast maak ik een werking aan in de service class die de scores per speler berekent. De werking voor de methode 'getHighestScoresPerSkill()' is als volgt;
- haal alle scores op.
- loop door alle skills, games en spelers en maken een lijst van elke hoogste score per speler
- we sorteren de lijst en noteren de hoogste speler met diens score op deze skill
- return de lijst met hoogste scores per skill

Dit lijkt goed te werken, al is dit enkel de happy flow. Gezien de tijd ga ik even kijken wat het handigste is.
