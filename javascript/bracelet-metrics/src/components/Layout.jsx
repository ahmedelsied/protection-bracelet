import React from 'react'
import HeaderContent from './HeaderContent'
import DataDisplay from './DataDisplay'

function Layout() {
  
  return (
    <section className="w-full m-auto  px-5">
      <HeaderContent />
      <DataDisplay />
    </section>
  )
}

export default Layout