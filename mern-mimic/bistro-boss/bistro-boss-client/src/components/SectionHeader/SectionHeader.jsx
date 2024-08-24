
const SectionHeader = (props) => {
    let { subHeading, Heading } = props;
    return (
        <div className="text-center my-7">
            <h4 className="mb-2 text-2xl text-amber-600"> ---- {subHeading} ---
            </h4>
            <hr className="w-3/6 mx-auto" />
            <h1 className="p-5 text-4xl uppercase">
                {Heading}
            </h1>
            <hr className="w-3/6 mx-auto" />
        </div>
    );
};

export default SectionHeader;