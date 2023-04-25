import React, { useEffect, useRef } from "react";
import { Loader } from "@googlemaps/js-api-loader";

const ManTrackMap = ({ trackPoints }) => {
  const mapRef = useRef(null);
  const markersRef = useRef([]);
  const boundsRef = useRef(null);

  useEffect(() => {
    const loader = new Loader({
      apiKey: "AIzaSyDIjXXnDF_9_DxPKiXamCzgkZFrwENWJHc",
      version: "weekly",
    });

    loader.load().then(() => {
      const map = new google.maps.Map(mapRef.current, {
        center: { lat: 17.7749, lng: -112.4194 },
        zoom: 11, // Change zoom level to 11
      });

      const trackPath = new google.maps.Polyline({
        path: trackPoints,
        geodesic: true,
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 2,
      });

      trackPath.setMap(map);

      const startMarker = new google.maps.Marker({
        position: trackPoints[0],
        map,
        title: "Start",
      });

      const endMarker = new google.maps.Marker({
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
  }, [trackPoints]);

  useEffect(() => {
    if (markersRef.current.length > 0) {
      markersRef.current[0].setPosition(trackPoints[0]);
      markersRef.current[1].setPosition(trackPoints[trackPoints.length - 1]);
    }

    if (boundsRef.current && mapRef.current) {
      mapRef.current.fitBounds(boundsRef.current);
    }
  }, [trackPoints]);

  return <div ref={mapRef} className="w-full h-[50vh]" />;
};

export default ManTrackMap;

