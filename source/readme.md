# Code Documentatie config.php - parse_ini_file

Deze code laadt een .env-bestand en gebruikt de `parse_ini_file` functie om de inhoud van het bestand te parseren. Vervolgens worden de verschillende instellingen opgeslagen in constanten.

## Functies

- `file_exists($filename)` : Controleert of een bestand of directory bestaat.
- `parse_ini_file($filename)` : Parseert een .ini-bestand en retourneert de instellingen als een associatieve array.

## Variabelen

- `$envSettings` : Bevat de resultaten van de `parse_ini_file` functie.

## Constanten

- `DB_SCHEMA` : De naam van de database schema. Standaard is dit "schema" als deze waarde niet in het .env-bestand wordt opgegeven.
- `DB_USER` : De gebruikersnaam voor het verbinden met de database. Standaard is dit "user" als deze waarde niet in het .env-bestand wordt opgegeven.
- `DB_PASSWORD` : Het wachtwoord voor het verbinden met de database. Standaard is dit "password" als deze waarde niet in het .env-bestand wordt opgegeven.
- `DB_HOST` : De hostnaam voor het verbinden met de database. Standaard is dit "localhost" als deze waarde niet in het .env-bestand wordt opgegeven.

## Belangrijkste punten

- De code controleert eerst of het .env-bestand bestaat. Als het niet bestaat, wordt er een bericht weergegeven en wordt het script beëindigd.
- De `parse_ini_file` functie wordt gebruikt om het .env-bestand te lezen en de instellingen te extraheren.
- Als een instelling niet aanwezig is in het .env-bestand, wordt er een standaardwaarde gebruikt voor die instelling.

## Voorbeeld gebruik

```php
<?php
require 'path/to/this/file.php';

echo DB_SCHEMA; // Retourneert de waarde van de constant DB_SCHEMA uit het .env-bestand

// Andere code hier...
?>
```

## Conclusie

Deze code laadt instellingen uit een .env-bestand en maakt ze beschikbaar via constanten. Dit maakt het gemakkelijk om configuratiegegevens op te slaan en te gebruiken in andere delen van de applicatie.


# Code Documentatie database.php - database_connect

Deze code maakt een verbinding met de database met behulp van de geconfigureerde database-instellingen uit het config.php bestand.

## Functies

- `mysqli`: Instantieert een nieuw `mysqli` object om verbinding te maken met de database.
- `mysqli_connect_errno`: Bepaalt of er een fout is opgetreden bij het maken van de databaseverbinding.
- `mysqli_connect_error`: Retourneert een foutbericht als er een fout is opgetreden bij het maken van de databaseverbinding.
- `return $connection`: Retourneert de gemaakte databaseverbinding.

## Variabelen

- `$connection`: Bevat de gemaakte databaseverbinding.

## Belangrijkste punten

- De code maakt een nieuwe `mysqli` object om verbinding te maken met de database met behulp van de geconfigureerde database-inloggegevens.
- Als de databaseverbinding niet tot stand kan worden gebracht, wordt er een foutbericht weergegeven en stopt het script.

## Voorbeeldgebruik

```php
<?php
require 'path/to/this/file.php';

$connection = database_connect(); // Maakt een verbinding met de database

// Andere code hier...
?>
```

## Conclusie

Deze code maakt een databaseverbinding met behulp van de geconfigureerde database-instellingen uit het config.php bestand. Dit maakt het mogelijk om databasebewerkingen uit te voeren in andere delen van de applicatie.