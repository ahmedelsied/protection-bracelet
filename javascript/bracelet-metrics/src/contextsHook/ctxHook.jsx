import react, { useEffect, useState, useLayoutEffect } from "react";
import DataConversionClass from "./dataConversionClass";
import ApiClass from "./ApiClass";
// Create Global Context

export const PbvContext = react.createContext(0);
PbvContext.displayName = "pbv.0 Context";

const PbvCtxProvider = (props) => {
    
    const [sync, setSync] = useState(false)
    const [startSync, setStartSync] = useState(false);
    //------------------------

    const [maps, setMaps] = useState([])
    const [sensors, setSensors] = useState([])

    function start_Sync_Handler() {
        console.log('start_Sync_Handler')
        setSync(true)
        setStartSync(true)
    }

    function stop_Sync_Handler() {
        console.log("stop_Sync_Handler");
        setSync(false)
        setStartSync(false)
    }

    function setDataFilter(map,sensor) {
        console.log('');
        setMaps(map)
        setSensors(sensor)
    }

    useEffect(() => {
        if(sync){
            setMaps([])
            setSensors([])
        }
    },[sync])

    useLayoutEffect(() => {

        ApiClass.apiInitialRequest(true).then( (data) => {
            setMaps(data);
        }).then(() => 
            ApiClass.apiInitialRequest(false)
        ).then((data)=>
            setSensors(data)
        )
    },[])
    useEffect(() => {
        let interval
        if (startSync) {
            interval = setInterval(() => {
                ApiClass.apiSyncRequest().then((data) => {

                    return DataConversionClass.conversionHandler(data)

                }).then((data) => {
                    setMaps((maps) => [...maps, data[0][0]]);
                    setSensors((sensors) => [...sensors, data[1][0]])
                });
            }, 2000);
        }
        
        return () => clearInterval(interval)

    },[sensors,startSync]);

    const values = {
        data: {
            maps,
            sensors
        },
        start_Sync_Handler,
        stop_Sync_Handler,
        setDataFilter
    };

    return (
        <PbvContext.Provider value={values}>
            {props.children}
        </PbvContext.Provider>
    );
};

export default PbvCtxProvider;
