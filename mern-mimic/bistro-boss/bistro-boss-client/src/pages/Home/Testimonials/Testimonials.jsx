import { useEffect, useState } from "react";
import SectionHeader from "../../../components/SectionHeader/SectionHeader";
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/navigation';
import { Navigation } from 'swiper/modules';
import '@smastrom/react-rating/style.css'
import { Rating } from '@smastrom/react-rating';
import { FaQuoteLeft } from 'react-icons/fa';
const Testimonials = () => {
    const [reviews, setReviews] = useState([]);

    useEffect(() => {
        fetch('http://localhost:5000/reviews')
            .then(res => res.json())
            .then(data => {
                setReviews(data);
            })
    }, [])

    return (
        <div>
            <SectionHeader subHeading="What our clients Says" Heading="Testimonials" />

            <>
                <Swiper navigation={true} modules={[Navigation]} className="mySwiper">
                    {reviews?.map(review =>
                        <SwiperSlide key={review._id}>
                            <div className="flex items-center justify-center my-5">
                                <div className="flex flex-col mx-auto">
                                    <Rating className="mx-auto mb-3" style={{ maxWidth: 250 }} value={review.rating} />
                                    <FaQuoteLeft className="mx-auto my-5 text-7xl" />
                                    <h4 className="w-1/2 mx-auto text-1xl">{review.details}</h4>
                                    <h2 className="my-3 text-3xl text-amber-400">{review.name}</h2>
                                </div>
                            </div>
                        </SwiperSlide>
                    )}

                </Swiper>
            </>

        </div>
    );
};

export default Testimonials;