import { useState } from "react"
import Style from '../styles/borderGradient.module.css'

export default function Join() {

  const [toggle, setToggle] = useState(true)

  return (
    <article className="grid h-[647px] max-md:grid-rows-[10%,auto] md:grid-cols-2 sticky z-20 px-2 pt-5 md:pt-10">
      <section className='grid md:grid-rows-2 max-md:ml-10 md:justify-center'>
        <div className="max-md:hidden max-w-[360px]">
          <h2 className="xl:text-6xl mb-5 text-5xl">Revolution in protection</h2>
          <ul className="flex gap-4 list-disc text-[#5779d9] text-xs flex-wrap">
            <li>Shar Data</li>
            <li>Location</li>
            <li>Heartbeat</li>
            <li>temperature measurement</li>
          </ul>
        </div>
        <div className="flex items-center gap-2 mb-4 select-none w-max">
          <span className="underline text-sm font-medium text-white">LogIn</span>
          <label className="cursor-pointer">
            <div className="relative">
              <input type="checkbox" value="" className="sr-only peer" onChange={ () => { setToggle(! toggle) }} />
              <div className="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </div>
          </label>
          <span className="underline text-sm font-medium text-white">Register</span>
        </div>
      </section>
      <section>
        <main className="flex flex-col justify-evenly h-4/5  xl:pl-6 max-lg:items-center md:w-full lg:w-2/3 xl:w-3/5">
          <h3 className="text-4xl font-kBlack my-3"> { toggle ? 'LogIn' : 'Register'} </h3>
          {
            toggle ? <Login /> : <Rigester />
          }
        </main>
      </section>
    </article>
  )
}

const Login = () => {
  return (
    <section className="max-md:w-3/5 md:max-lg:w-2/3">
      <form>
        <div className="mb-6">
          <label htmlFor="email" className="block mb-2 text-sm font-medium text-white">Your email</label>
          <input type="email" autoComplete="off" id="email" className={`${ Style.gradient} outline-none bg-[#ffffff05] shadow-sm text-sm rounded-lg block w-full p-2.5`} placeholder="name@example.com" required />
        </div>
        <div className="mb-6">
          <label htmlFor="password" className="block mb-2 text-sm font-medium text-white">Your password</label>
          <input type="password" autoComplete="off" id="password" className={`${ Style.gradient} outline-none bg-[#ffffff05] shadow-sm text-sm rounded-lg block w-full p-2.5`} required />
        </div>

        <button type="submit" className={`${ Style.gradient} outline-none bg-[#ffffff05] text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center`} >submit</button>
      </form>
    </section>
  )
}

const Rigester = () => {
  return (
    <section className="max-md:w-3/5 md:max-lg:w-2/3">
      <form>
        <div className="mb-6">
          <label htmlFor="email" className="block mb-2 text-sm font-medium text-white">Your full name</label>
          <input type="text" autoComplete="off" id="email" className={`${ Style.gradient} outline-none bg-[#ffffff05] shadow-sm text-sm rounded-lg block w-full p-2.5`} placeholder="Mohamed Saad" required />
        </div>
        <div className="mb-6">
          <label htmlFor="email" className="block mb-2 text-sm font-medium text-white">Your email</label>
          <input type="email" autoComplete="off" id="email" className={`${ Style.gradient} outline-none bg-[#ffffff05] shadow-sm text-sm rounded-lg block w-full p-2.5`} placeholder="name@example.com" required />
        </div>
        <div className="mb-6">
          <label htmlFor="password" className="block mb-2 text-sm font-medium text-white">Your password</label>
          <input type="password" autoComplete="off" id="password" className={`${ Style.gradient} outline-none bg-[#ffffff05] shadow-sm  text-sm rounded-lg block w-full p-2.5`} required />
        </div>
        <div className="flex items-start mb-6">
          <div className="flex items-center h-5">
            <input id="terms" type="checkbox" value="" className={`${ Style.gradient} outline-none bg-[#ffffff05] w-4 h-4 rounded `} required />
          </div>
          <label htmlFor="terms" className="ml-2 text-sm font-medium text-gray-300">I agree with the <a href="#" className="hover:underline text-blue-500">terms and conditions</a></label>
        </div>
        <button type="submit" className={`${ Style.gradient} outline-none bg-[#ffffff05] text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center `} >submit</button>
      </form>
    </section>
  )
}