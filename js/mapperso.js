// <script type="text/javascript">

// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 48.852969;
var lon = 2.349903;
var macarte = null;
// Fonction d'initialisation de la carte
var villes = {
  "Padua": { "lat": 45.40797, "lon": 11.88586 },
  "Bordeaux": { "lat": 44.836151, "lon": -0.580816 },
  "Berkeley": { "lat":  37.871666, "lon": -122.272781 },
  "Tunis": { "lat":  36.806496, "lon": 10.181532},
  "Catania": { "lat":  37.507877, "lon": 15.083030},
};

// Fonction d'initialisation de la carte
function initMap() {
  // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
  macarte = L.map('map').setView([lat, lon], 2);
  // macarte.fitBounds(); // Nous demandons à ce que tous les marqueurs soient visibles, et ajoutons un padding (pad(0.5)) pour que les marqueurs ne soient pas coupés

  // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
  L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
    minZoom: 1,
    maxZoom: 20
  }).addTo(macarte);
  // Nous parcourons la liste des villes
  for (ville in villes) {
    var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(macarte);
  }                 
}
window.onload = function(){
// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
// var marker = L.marker([lat, lon]).addTo(macarte);

initMap(); 
};
// </script>