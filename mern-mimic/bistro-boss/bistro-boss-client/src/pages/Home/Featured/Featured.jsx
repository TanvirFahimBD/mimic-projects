import SectionHeader from "../../../components/SectionHeader/SectionHeader";
import featuredImg from '../../../assets/home/featured.jpg';

const Featured = () => {
    return (
        <div style={{ backgroundImage: `url(${featuredImg})` }} className="p-5 my-4 bg-fixed">
            <SectionHeader subHeading="We Recommend" Heading="Our Best Dishe" />
            <div className="flex flex-row bg-opacity-100">
                <div className="flex justify-end w-1/2 ">
                    <img src={featuredImg} alt="" className="w-1/4 rounded-full" />
                </div>
                <div className="w-1/2 ml-3 text-gray-50">
                    <h3 className="text-1xl">March 30, 2024</h3>
                    <h2 className="text-2xl">Dhaka Fuska </h2>
                    <p className="w-2/3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id quo ad incidunt alias, quos temporibus!</p>
                    <button className="border-0 border-b-4 btn btn-outline ">Explore More</button>
                </div>
            </div>
        </div>
    );
};

export default Featured;