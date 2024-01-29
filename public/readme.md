# Code Documentatie ImageDownload.php - Afbeelding zoeken en downloaden

Deze code zoekt naar een afbeelding in de database aan de hand van het meegegeven id. Als de afbeelding wordt gevonden, wordt de afbeelding weergegeven.

## Functies

- `database_connect()` : Maakt verbinding met de database en retourneert het databaseverbinding object.
- `GetQueryResultsAssoc($result)` : Converteert het resultaat van een database query naar een associatieve array.
- `FindImage($conn, $id)` : Zoekt naar een afbeelding in de database aan de hand van het meegegeven id.

## Variabelen

- `$id` : Het meegegeven id dat wordt gebruikt om de afbeelding te zoeken in de database.
- `$conn` : Het databaseverbinding object.
- `$searchResults` : Bevat de resultaten van het zoeken naar de afbeelding in de database.

## Belangrijkste punten

- De code maakt eerst verbinding met de database.
- Vervolgens wordt de functie `FindImage` aangeroepen om de afbeelding te zoeken.
- Als de afbeelding wordt gevonden, wordt de afbeelding weergegeven met behulp van de `fpassthru` functie in combinatie met de juiste headers. De afbeelding wordt gelezen vanuit het bestand met behulp van een filepointer.

## Voorbeeld gebruik

```php
<?php
require 'path/to/this/file.php';

$id = $_GET['link'];

// Zoek de afbeelding in de database aan de hand van het meegegeven id
$searchResults = FindImage($conn, $id);

// Als de afbeelding wordt gevonden, wordt deze weergegeven
if (sizeof($searchResults) == 1) {
  $filename = $searchResults[0]['filename'];
  $filepointer = fopen($filename, 'rb');
  header("Content-Type: image/png");
  header("Content-Length: " . filesize($filename));
  fpassthru($filepointer);
  exit;
} else {
  die("Invalid file");
}

// Andere code hier...
?>
```

## Conclusie

Deze code zoekt naar een afbeelding in de database aan de hand van het meegegeven id en geeft de afbeelding weer als deze wordt gevonden. Dit maakt het mogelijk om afbeeldingen op te halen en weer te geven in een webapplicatie.


# Code Documentatie imagerecieve.php - Afbeelding krijgen van het website

Dit PHP-script heeft de volgende functies:

1. `handlefile`: Deze functie verwerkt het geüploade bestand en slaat het op in de map "uploads" met een unieke bestandsnaam.
2. `insertImageInDb`: Deze functie voegt de gegevens van de afbeelding toe aan de database.
3. `createLink`: Deze functie genereert een downloadlink voor de afbeelding.
4. `UguuAPI`: Deze functie maakt gebruik van de Uguu API om de afbeelding naar een externe server te uploaden.

De script gebruikt ook de volgende externe bronnen:
- "database.php": Een bestand dat de databaseverbinding tot stand brengt.
- "config.php": Een bestand dat configuratie-instellingen bevat.

## Variabelen en parameters

- `$conn`: Een variabele voor de databaseverbinding.
- `$curl`: Een cURL-resource voor het maken van een HTTP-verzoek naar de Uguu API.
- `$file`: Een array met informatie over het geüploade bestand, zoals naam, type, grootte, en tijdelijke locatie.
- `$fileid`: Een uniek bestands-ID gegenereerd met behulp van de functie `uniqid()`.
- `$link`: De downloadlink voor de afbeelding.
- `$filename`: De naam van het opgeslagen bestand.
- `$type`: Het type van het geüploade bestand.
- `$size`: De grootte van het geüploade bestand.
- `$response`: Een array die de reactie van het uploadscript wordt opgeslagen en later als JSON wordt geëncodeerd.

## Functies en hun functionaliteit

1. `handlefile($file, $fileid)`: Deze functie verwerkt het geüploade bestand door het op te slaan in de map "uploads" met een unieke bestandsnaam. Het retourneert de opgeslagen bestandsnaam.

2. `insertImageInDb($conn, $type, $size, $filename, $link)`: Deze functie voegt de gegevens van de afbeelding toe aan de database. Het maakt gebruik van prepared statements voor het veilig invoegen van gegevens. Deze functie heeft de volgende parameters:
    - `$conn`: De databaseverbinding.
    - `$type`: Het type van het geüploade bestand.
    - `$size`: De grootte van het geüploade bestand.
    - `$filename`: De naam van het opgeslagen bestand.
    - `$link`: De downloadlink voor de afbeelding.

3. `createLink($fileid)`: Deze functie genereert een downloadlink voor de geüploade afbeelding. Het heeft het unieke bestands-ID als parameter en retourneert de downloadlink.

4. `UguuAPI($curl, $filename)`: Deze functie maakt gebruik van de Uguu API om de afbeelding naar een externe server te uploaden. Het heeft de cURL-resource en het bestandsnaam als parameters. Het retourneert de URL van de geüploade afbeelding.

## Hoofdgedeelte van de code

In het hoofdgedeelte van de code worden de volgende stappen uitgevoerd:

1. De databaseverbinding wordt tot stand gebracht met behulp van de functie `database_connect()` uit het `database.php` bestand.

2. Er wordt een cURL-resource gemaakt met behulp van de functie `curl_init()`.

3. Er wordt gecontroleerd of er een bestand is geüpload zonder fouten. Indien ja, wordt de volgende stappen uitgevoerd:
    - Er wordt een uniek bestands-ID gegenereerd.
    - Er wordt een downloadlink gecreëerd.
    - Het geüploade bestand wordt verwerkt en opgeslagen op de server.
    - De gegevens van de afbeelding worden toegevoegd aan de database.
    - De downloadlink en het uploadpad van de afbeelding worden toegevoegd aan de response array.

4. Als er een fout is opgetreden tijdens het uploaden, wordt er een foutmelding toegevoegd aan de response array.

5. De response array wordt geëncodeerd naar een JSON-string en uitgevoerd.

## Voorbeeld uitvoer

De output van het script is een JSON-string met de volgende structuren:

- `succeeded`: Een boolean die aangeeft of de upload is geslaagd.
- `message`: Een bericht met aanvullende informatie over de upload.
- `downloadlink`: De downloadlink voor de afbeelding.
- `upload_path`: Het uploadpad van de afbeelding op de externe server.

Hier is een voorbeeld van de output:

```json
{
  "succeeded": true,
  "message": "",
  "downloadlink": "https://example.com/imagedownload.php?link=123456789",
  "upload_path": "https://a.uguu.se/abcdefgh.png"
}
```

## Conclusie

Deze code is een PHP-script dat een afbeelding uploadt naar een server en vervolgens de uploadlink en het pad van de afbeelding retourneert.


# Code Documentatie webcamupload.html - Webcam Pagina

Deze code beschrijft de functionaliteit en het gebruik van de "Webcam" webpagina. Deze webpagina maakt gebruik van de ingebouwde camera van het apparaat om een foto te maken en deze te tonen.

## Installatie

Er is geen speciale installatie vereist om deze webpagina te gebruiken. Deze kan worden geopend in een webbrowser die toegang heeft tot de camera van het apparaat.

## Gebruik

1. Open de "Webcam" webpagina in een webbrowser.
2. Klik op de "Take Image" knop om de camera te activeren en een foto te maken.
3. Er wordt een voorbeeld van de foto getoond op het scherm.
4. Er zijn verschillende opties beschikbaar:

   - **Canvas**: Deze optie toont de foto op een canvas element.
   - **Link**: Deze optie genereert een link naar de foto, zodat deze kan worden gedownload.
   - **Link (Uguu)**: Deze optie genereert een link naar de foto met behulp van de "uguu" service.
   - **QR Code**: Deze optie genereert een QR code van de foto.
   - **Restart**: Deze optie herstart het proces en maakt het mogelijk om een nieuwe foto te maken.

## Bestanden

De volgende bestanden maken deel uit van de "Webcam" webpagina:

- **webcamupload.html**: Dit is het hoofdbestand van de webpagina, dat de structuur en inhoud bevat.
- **appWebcam.js**: Dit JavaScript bestand bevat de code voor het gebruik van de webcam en het verwerken van de foto.

## Aanpassingen

De "Webcam" webpagina kan worden aangepast volgens de specifieke behoeften.

- De opmaak van de webpagina kan worden gewijzigd door de CSS aan te passen in de `style` sectie van het `webcamupload.html` bestand.
- De functionaliteit van de webpagina kan worden aangepast door wijzigingen aan te brengen in de JavaScript code in het `appWebcam.js` bestand.

## Conclusie

De "Webcam" webpagina is een handige tool om foto's te maken met behulp van de ingebouwde camera van het apparaat. Door de flexibiliteit van de beschikbare opties, kan de webpagina worden gebruikt voor persoonlijke of professionele doeleinden.


