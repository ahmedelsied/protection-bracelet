import React from 'react';
import PbvCtxEvents from '../contextsHook/pbvCtxEvents'

const Maps = React.lazy(() => import('./Maps'));
const HeartTempAxisStockChart = React.lazy(() => import('./HeartTempAxisStockChart'));

function DataDisplay() {
  const [{maps,sensors}] =  PbvCtxEvents()
  return (
    <div className='grid grid-rows-2 justify-center items-center gap-5 pt-9'>
        <Maps map={maps} /> 
        <HeartTempAxisStockChart sensor={sensors} />
    </div>
  )
}

export default DataDisplay