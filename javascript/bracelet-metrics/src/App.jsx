import './assets/css/App.css'
import React from 'react'
import PbvCtxProvider from './contextsHook/ctxHook'
import Layout from './components/Layout'

function App() {

  return (
    <div className="App">
      <PbvCtxProvider>
        <Layout />
      </PbvCtxProvider>
    </div>
  )
}

export default App
