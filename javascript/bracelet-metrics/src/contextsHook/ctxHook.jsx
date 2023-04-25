import react , { useEffect, useState} from "react"

// Create Global Context

export const PbvContext = react.createContext(0)
PbvContext.displayName  = 'pbv.0 Context'


const PbvCtxProvider = (props) => {


    const values = {
        data :{
            test1: 'test1',
            test2: 'test2',
            test3: 'test3',
        }
    }

    return(
        <PbvContext.Provider value={values}>
            {props.children}
        </PbvContext.Provider>
    )
}

export default PbvCtxProvider
