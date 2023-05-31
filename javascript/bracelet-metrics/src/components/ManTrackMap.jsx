import React, { useEffect, useLayoutEffect, useRef } from "react";
import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
  apiKey: "AIzaSyDIjXXnDF_9_DxPKiXamCzgkZFrwENWJHc",
  version: "weekly",
});

var map, startMarker, endMarker = { setMap:function(){} }

const ManTrackMap = ({ trackPoints }) => {
  
  const mapRef = useRef(null);
  const markersRef = useRef([]);
  const boundsRef = useRef(null);

  useEffect(() => {
    loader.load().then(() => {
      map = new google.maps.Map(mapRef.current, {
        center: { lat: 17.7749, lng: -112.4194 },
        zoom: 11, // Change zoom level to 11
      })

      startMarker = new google.maps.Marker({
        position: trackPoints[0],
        icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|42EF54',
        map,
        title: "Start",
      });

    });
  }, []);

  useEffect(() => {
    let trackPath = {}
    loader.load().then(() => {
      trackPath = new google.maps.Polyline({
        path: trackPoints,
        geodesic: true,
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 2,
      });

      trackPath.setMap(map);

      endMarker = new google.maps.Marker({
        position: trackPoints[trackPoints.length - 1],
        map,
        title: "End",
      });

      markersRef.current = [startMarker, endMarker];
      boundsRef.current = new google.maps.LatLngBounds();

      trackPoints.forEach((point) => {
        boundsRef.current.extend(point);
      });

      map.fitBounds(boundsRef.current);
    });
    
    return () => {endMarker.setMap(null); trackPath.setMap(null)};

  }, [trackPoints]);

  useLayoutEffect(() => {
    if (markersRef.current.length > 0) {
      markersRef.current[0].setPosition(trackPoints[0]);
      markersRef.current[1].setPosition(trackPoints[trackPoints.length - 1]);
    }
    if (boundsRef.current && mapRef.current) {
      // mapRef.current.fitBounds(boundsRef.current);
    }
  }, [trackPoints]);

  return <div ref={mapRef} className="w-full h-[50vh]" />;
};

export default ManTrackMap;

