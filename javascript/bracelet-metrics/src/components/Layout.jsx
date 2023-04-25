import React from 'react'
import PbvCtxEvents from '../contextsHook/pbvCtxEvents'
import HeaderContent from './HeaderContent'
import DataDisplay from './DataDisplay'

function Layout() {

  const [{test1}] =  PbvCtxEvents()

  return (
    <section className="w-full m-auto  px-5">
      <HeaderContent />
      <DataDisplay />
    </section>
  )
}

export default Layout