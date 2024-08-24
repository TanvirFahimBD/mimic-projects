import useAuth from "../../../hooks/useAuth";

const Profile = () => {
    const { user, loading } = useAuth();

    if (loading) {
        return <p>Loading...</p>
    }

    return (
        <div>
            <p>Email: {user?.email}</p>
        </div>
    );
};

export default Profile;