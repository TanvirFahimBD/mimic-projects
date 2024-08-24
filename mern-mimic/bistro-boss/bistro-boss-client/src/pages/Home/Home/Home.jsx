import Banner from "../Banner/Banner";
import Category from "../Category/Category";
import Featured from "../Featured/Featured";
import PopularMenu from "../PopularMenu/PopularMenu";
import Testimonials from "../Testimonials/Testimonials";
import PageTitle from "../../../components/PageTitle/PageTitle";

const Home = () => {
    return (
        <div>
            <PageTitle title="Home | Bistro Boss" />
            <Banner />
            <Category />
            <PopularMenu category='popular' subHeading="Choose Yours" Heading="Popular Dishes" />
            <Featured />
            <Testimonials />
        </div>
    );
};

export default Home;