import React from 'react';

const Maps = React.lazy(() => import('./Maps'));
const HeartTempAxisStockChart = React.lazy(() => import('./HeartTempAxisStockChart'));

function DataDisplay() {
  return (
    <div className='grid grid-rows-2 justify-center items-center gap-5 pt-9'>
        <Maps/>
        <HeartTempAxisStockChart />
    </div>
  )
}

export default DataDisplay