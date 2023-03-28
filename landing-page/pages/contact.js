import Style from '../styles/borderGradient.module.css'

export default function Contact() {
    return (
      <article className="sticky z-20">
        <section className="mb-12">
          <div className="w-4/5 sm:w-[70%] md:w-2/4 lg:w-2/5 pt-20 pb-10 m-auto text-center bg-[#ffffff05]">
            <h2 className=" text-4xl mb-7">Contact Us</h2>
            <form action="#" className="px-4 m-auto flex flex-col items-center gap-6 justify-center ">
              <input type='text' className={`${ Style.gradient} outline-none  bg-[#ffffff05] pl-2 w-10/12 h-9`} placeholder="Enter Your Name" required></input>
              <input type='text'  className={`${ Style.gradient} outline-none bg-[#ffffff05] pl-2 w-10/12 h-9`} placeholder="Enter a valid email address " required></input>
              <textarea className={`${ Style.gradient} p-2 outline-none bg-[#ffffff05] resize-none w-10/12 h-36`} required></textarea>
              <button className={`${ Style.gradient} w-24 bg-[#ffffff05] py-2 px-4`} type="submit">Submit</button>
            </form>
          </div>
        </section>
      </article>
    )
  }