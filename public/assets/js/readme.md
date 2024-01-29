# Code Documentatie appWebcam.js 

Deze code is verantwoordelijk voor het beheren van een webcamera-applicatie. Het maakt gebruik van de WebCamHelper klasse om foto's te maken met behulp van de webcam van de gebruiker en deze naar een server te uploaden.

## Functies

- `capturePhoto()` : Deze functie start een timer van 5 seconden voordat een foto wordt gemaakt met behulp van de `GrabFrame` functie van de WebCamHelper klasse.
- `sendBlob(imageBlob)` : Deze functie stuurt de gemaakte foto naar de server door middel van een HTTP POST-verzoek. Het maakt gebruik van de `fetch` functie om het verzoek uit te voeren.
- `showLink(json)` : Deze functie wordt aangeroepen nadat de foto succesvol naar de server is geüpload. Het toont de downloadlink en de QR-code van de foto op de pagina.
- `takePhotoClicked()` : Deze functie wordt aangeroepen wanneer de gebruiker op de knop "Take Photo" klikt. Het controleert of de webcamera klaar is en roept vervolgens de `capturePhoto` functie aan.
- `init()` : Deze functie initialiseert het webcam-applicatie door de nodige eventlisteners toe te voegen en de WebCamHelper klasse te starten.

## Variabelen

- `imageForm` : Het HTML-formulier voor het verzenden van de foto naar de server.
- `downloadlink` : Het HTML-element waarin de downloadlink wordt weergegeven.
- `button` : Het HTML-element van de knop "Take Photo".
- `qrcode` : Het HTML-element voor het weergeven van de QR-code van de foto.
- `canvas_id` : Het HTML-element van het canvas voor het tonen van de foto.
- `timerDisplay` : Het HTML-element voor het weergeven van de timer tijdens het maken van de foto.
- `linkuguu` : Het HTML-element voor het weergeven van de uploadlink van de foto.
- `restartbtn` : Het HTML-element van de knop "Restart" voor het opnieuw starten van het webcam-applicatie.
- `webapi` : Een instantie van de WebCamHelper klasse voor het beheren van de webcam-api.

## Belangrijkste punten

- De code maakt gebruik van de WebCamHelper klasse om toegang te krijgen tot de webcam van de gebruiker.
- Een timer van 5 seconden wordt gestart voordat een foto wordt gemaakt met behulp van de `GrabFrame` functie van de WebCamHelper klasse.
- De foto wordt geüpload naar de server met behulp van een HTTP POST-verzoek.
- De downloadlink en QR-code van de foto worden weergegeven op de pagina.
- De knop "Restart" zorgt ervoor dat de pagina opnieuw wordt geladen om het webcam-applicatie opnieuw te starten.

## Voorbeeld gebruik

```javascript
let app = new WebCamApp();
app.init();
app.takePhotoClicked();
```

## Conclusie

Deze code implementeert een webcamera-applicatie met behulp van de WebCamHelper klasse. Het maakt het mogelijk voor gebruikers om foto's te maken met hun webcam en deze naar een server te uploaden. De code maakt ook gebruik van HTML-elementen om de downloadlink en QR-code van de foto weer te geven op de pagina.

# Code Documentatie webcamhelper.js - WebCamHelper 

Deze code bevat een helperklasse genaamd WebCamHelper, die functionaliteit biedt om een webcam te gebruiken in een webapplicatie. Het maakt gebruik van de MediaDevices API en Canvas API om beelden van de webcam vast te leggen en te verwerken.

## Functies

- `constructor()` : Maakt een nieuw WebCamHelper object aan en initialiseert de benodigde variabelen.
- `startApi()` : Start de MediaDevices API om toegang te krijgen tot de webcam.
- `GrabFrame(callback)` : Vangt een frame van de webcam en geeft het door aan de opgegeven callbackfunctie.
- `GrabFrameToCanvas(imageBitmap, canvasId)` : Verwerkt het verkregen frame naar een canvaselement met het opgegeven id en retourneert het resulterende beeld als een blob.
- `processFrame(imageBitmap, canvasId)` : Verwerkt het verkregen frame naar een canvaselement met het opgegeven id en retourneert het resulterende beeld als een blob.
- `drawOnCanvas(imageBitmap, canvasId)` : Tekent het verkregen frame op het canvas met het opgegeven id.
- `captureToBlob(canvasId)` : Maakt een blob van het canvas met het opgegeven id en retourneert deze.
- `getStream()` : Geeft de huidige mediastream van de webcam terug.

## Variabelen

- `video` : Het videelement waarin de beelden van de webcam worden weergegeven.
- `stream` : De huidige mediastream van de webcam.
- `ready` : Een boolean die aangeeft of de webcam klaar is voor gebruik.
- `mediaDevices` : De MediaDevices API van de browser.

## Belangrijkste punten

- De `startApi` functie begint met het ophalen van toegang tot de webcam met behulp van `getUserMedia` en voegt de stroom toe aan het videobeeld. 
- De `GrabFrame` functie vraagt een frame aan de MediaStream en geeft het door aan de opgegeven callbackfunctie.
- De `GrabFrameToCanvas` functie verwerkt het frame naar een canvas met het opgegeven id en retourneert het resultaat als een blob.
- De `drawOnCanvas` functie tekent het frame op het canvas met het opgegeven id.
- De `captureToBlob` functie maakt een blob van het canvas met het opgegeven id en retourneert deze.
- Het `canvasId` parameter in de functies verwijst naar het id van het canvaselement waarop het beeld moet worden weergegeven.

## Voorbeeld gebruik

```javascript
// Maak een nieuw WebCamHelper object aan
let webcam = new WebCamHelper();

// Start de webcam API
webcam.startApi();

// Vang een frame van de webcam en verwerk het naar een canvas met "canvas" als id
webcam.GrabFrame(async (imageBitmap) => {
  let imageBlob = await webcam.GrabFrameToCanvas(imageBitmap, "canvas");
  // Doe iets met de resulterende blob
});

// Andere code hier...
```

## Conclusie

Deze code bevat een helperklasse genaamd WebCamHelper, die functionaliteit biedt om een webcam te gebruiken in een webapplicatie. Hiermee kunnen beelden van de webcam worden vastgelegd, verwerkt en weergegeven op een canvaselement.