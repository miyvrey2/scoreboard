Zojuist heb ik de opdracht doorgenomen. Een schematisch plan maak ik hieruit op
1. Maak migrations en bijbehorende models;
2. Maak seeders;
3. Maak een ScoreboardService met een methode met die de hoogste score per vaardigheid ophaalt en bij welke speler dit hoort;
4. Maak een ScoreboardService met een methode een score berekening om te zien wat de score is per speler 

Als eerste denk ik aan 4 tabellen: Player, Game, Skill, en Score. De eerste drie zijn losse entities, score is degene die de relaties legt tussen de spelers, spellen en vaardigheden.
- `php artisan make:model Player -mf`
- `php artisan make:model Game -mf`
- `php artisan make:model Skill -mf`

Voortschrijdend inzicht: ik heb pas een factory nodig als ik meer ga opslaan dan enkel een naam, voor nu behoud ik de bestanden voor als ik later uitbreid.

Een game kan 1 of meer skills hebben, en een skill kan ook aan meerdere games toebehoren. daarom een veel op veel relatie
`php artisan make:migration create_game_skill_table`

Het vierde model Score en legt relaties tussen de spelers, spellen en natuurlijk noteert wat de score is
- `php artisan make:model Score -mf`

De relaties heb ik nu gelegd en de factories zijn aangemaakt. Tijdens het migreren worden alle tabellen en relaties aangemaakt.
