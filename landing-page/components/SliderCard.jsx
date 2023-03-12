import Image from "next/image";
import { motion, AnimatePresence } from "framer-motion"
import { useEffect, useRef, useState } from "react";

export default function SliderCard({cards}) {
  const carouselRef = useRef();
  const [width, setWidth] = useState(0);

  useEffect(() => {
    let carousel = carouselRef.current;
    setWidth(carousel.scrollWidth - carousel.offsetWidth);
  }, []);

  return (
    <motion.div ref={carouselRef} className="overflow-x-hidden m-auto w-4/5 h-4/5 border-2 bg-[#161616]  border-gray-100 rounded-xl" onClick={(e)=>  e.stopPropagation() }>
      <motion.div drag="x" dragConstraints={{ right: 0, left: -(width) }} className="flex gap-3 w-full h-full">
        {
          cards?.map(({ img, title, text }) => (

            <motion.div key={title} className="px-3 shrink-0 cursor-pointer grid lg:grid-cols-2 w-[inherit] min-h-[616px] h-[inherit] items-center justify-items-center">
              <div className="pl-10">
                <p className=" max-sm:text-lg sm:text-2xl lg:text-5xl mb-14">{title}</p>
                <p className=" font-kLight">{text}</p>
              </div>
              <div className="relative pointer-events-none w-1/2 h-2/3 lg:w-[80%] lg:h-[64%] ">
                <Image
                  className="rounded-xl"
                  alt="Medium card"
                  src={img}
                  fill
                  sizes="(max-width: 768px) 100vw,
                    (max-width: 1200px) 50vw,
                    33vw"
                />

              </div>
            </motion.div>
          ))
        }
      </motion.div>
    </motion.div>
  );
}
