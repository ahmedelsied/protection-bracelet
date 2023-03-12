import Link from "next/link";
import Image from "next/image";
import Style from '../styles/nav.module.css'

import { useState } from "react";
function Navbar() {
  const [drop, setDrop] = useState(false);
  const liElements = [
    { li: ['/' ,"Home" ] },
    { li: ['/join', "Join us" ]},
    { li: ['/about', "About us"] },
    { li: ['/contact', "Contact"] }
  ]
  let styleli = 'block text-lg py-2 pl-3 pr-4 text-white rounded hover:bg-[#ffffff05] md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0'
  
  return (
    <nav className="bg-transparent border-gray-200 px-2 sm:px-4 py-2.5 rounded">
      <div className="container flex flex-wrap items-center justify-between mx-auto p-6">
        <div className={Style.circle}>
        <Image 
            src="https://flowbite.com/docs/images/logo.svg"
            alt="logo"
            className="mr-3"
            width={40}
            height={40}
        />
        </div>

        <button
          data-collapse-toggle="navbar-default"
          onClick={() => setDrop(!drop)}
          type="button"
          className="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
          aria-controls="navbar-default"
          aria-expanded="false"
        >
          <span className="sr-only">Open main menu</span>
          <svg
            className="w-6 h-6"
            aria-hidden="true"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fillRule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clipRule="evenodd"
            ></path>
          </svg>
        </button>

        <div
          className={`${drop ? "block" : "hidden"} relative w-full md:block md:w-auto md:pr-4`}
          id="navbar-default"
        >
          <div className='md:hidden w-full h-[210px] absolute top-[16px] left-0 bg-[#ffffff05] backdrop-blur-sm -z-[1] rounded-lg'></div>
          <ul className=" md:flex gap-12 flex-col p-4 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent">
            {
              liElements.map((element,i) => {
                return(
                  <li key={i}>
                    <Link
                      href={element.li[0]}
                      className={styleli}
                    >
                      {element.li[1]}
                    </Link>
                  </li>
                )
              })
            }
          </ul>
        </div>
      </div>
    </nav>
  );
}
export default Navbar;
