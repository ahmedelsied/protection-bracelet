import { useContext } from "react";

import { PbvContext } from "./ctxHook";

const PbvCtxEvents = () => {

    const {dataStates,start_Sync_Handler,stop_Sync_Handler,setDataFilter} = useContext(PbvContext)

    return  [
        dataStates,
        start_Sync_Handler,
        stop_Sync_Handler,
        setDataFilter
    ]
}

export default PbvCtxEvents