import { useContext } from "react";

import { PbvContext } from "./ctxHook";

const PbvCtxEvents = () => {

    const {data} = useContext(PbvContext)

    return  [data]
}

export default PbvCtxEvents