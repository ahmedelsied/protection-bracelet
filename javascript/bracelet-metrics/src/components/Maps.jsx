import React from "react";
import ManTrackMap from "./ManTrackMap";

const Map = ({ map }) => {
  
  return (
    <div className="w-[80vw] m-auto">
      <ManTrackMap trackPoints={map} />
    </div>
  );
};

export default Map;