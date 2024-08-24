import { Link } from "react-router-dom";
import SectionHeader from "../../../components/SectionHeader/SectionHeader";
import SingleItem from "../../../components/SingleItem/SingleItem";
import useMenu from "../../../hooks/useMenu";
import Cover from "../../Shared/Cover/Cover";

const PopularMenu = ({ coverImg, category, subHeading, Heading, menuTitle, menuInfo }) => {

    const [menu, loading] = useMenu();
    const currentCategories = menu.filter(item => item.category == category);

    if (loading) {
        return <p>Loading...</p>
    }
    return (
        <div>
            {category == 'popular' && <SectionHeader subHeading={subHeading} Heading={Heading} />}

            {category !== 'popular' && <Cover img={coverImg} menuTitle={menuTitle} menuInfo={menuInfo} />}

            <div className="grid grid-flow-col grid-rows-3 gap-4">
                {
                    currentCategories.length > 6 ?
                        currentCategories.slice(0, 6)?.map(mt => <SingleItem key={mt._id} item={mt}></SingleItem>)
                        :
                        currentCategories.slice(0, 6)?.map(mt => <SingleItem key={mt._id} item={mt}></SingleItem>)
                }
            </div>
            <div className="mb-5 text-center">
                <Link to={`/shop/${category}`}>
                    <button className="btn btn-warning">
                        View all {category} dishes
                    </button>
                </Link>
            </div>
        </div>
    );
};

export default PopularMenu;