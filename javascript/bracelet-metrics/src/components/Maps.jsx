import React from "react";
import ManTrackMap from "./ManTrackMap";

const Map = () => {
  //  api data like this 
  const trackPoints = [
    { lat: 12.9802347063322, lng: 77.5907760360903 },
    { lat: 12.9793774204024, lng: 77.5910979011596 },
    { lat: 12.9793774204024, lng: 77.5911622741734 },
    { lat: 12.9797746996155, lng: 77.5916987159555 },
    { lat: 12.9801301594259, lng: 77.5919776656823 },

    // more points...
  ];

  return (
    <div className="w-[80vw] m-auto">
      <ManTrackMap trackPoints={trackPoints} />
    </div>
  );
};

export default Map;