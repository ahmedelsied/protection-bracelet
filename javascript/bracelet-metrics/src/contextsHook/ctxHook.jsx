import react, { useEffect, useState, useLayoutEffect } from "react";
import DataConversionClass from "./DataConversionClass";
import ApiClass from "./ApiClass";
// Create Global Context

export const PbvContext = react.createContext(0);
PbvContext.displayName = "pbv.0 Context";
let clean = true

const PbvCtxProvider = (props) => {
    
    const [sync, setSync] = useState(false)
    // const [clean, setClean] = useState(true)

    const [dataStates, setDataStates] = useState({ maps:[], sensors:[] })
    //------------------------


    function start_Sync_Handler() {
        console.log('start_Sync_Handler')
        setSync(true)
    }

    function stop_Sync_Handler() {
        console.log("stop_Sync_Handler");
        setSync(false)
    }

    function setDataFilter(data) {
        clean = true
        setDataStates({ maps: data[0], sensors: data[1] });
    }

    useEffect(() => {
        if(sync && clean){
            clean = false
            setDataStates({ maps:[], sensors:[] })
        }
    },[sync])

    useLayoutEffect(() => {
        ApiClass.apiInitialRequest().then( (res) => {
            setDataStates({ maps: res[0], sensors: res[1] });
        })
    },[])

    useEffect(() => {
        let interval
        if (sync) {
            interval = setInterval(() => {
                ApiClass.apiSyncRequest().then((res) => {
                    const data = DataConversionClass.conversionHandler(res)
                    setDataStates(({maps,sensors}) => {
                        return {
                            "maps": [...maps , data[0][0]],
                            "sensors": [...sensors , data[1][0]],
                    }})
                })
            }, 2000);
        }
        
        return () => clearInterval(interval)

    },[dataStates,sync]);

    const values = {
        dataStates,
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
