var map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    // view: new ol.View({
    //     center: ol.proj.fromLonLat([-8.409518, 115.188919]),
    //     zoom: 4
    // })
    view: new ol.View({
        // center: ol.proj.fromLonLat([37.41, 8.82]),
        center: ol.proj.fromLonLat([115.188919, -8.409518]),
        zoom: 9.3
    })
});

