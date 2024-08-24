import {
    useQuery
} from '@tanstack/react-query';
import useAxiosSecure from './useAxiosSecure';
import { AuthContext } from '../providers/AuthProvider';
import { useContext } from 'react';

const useCart = () => {
    const axiosSecure = useAxiosSecure();
    const { user } = useContext(AuthContext);
    const { data: cart = [], isLoading, refetch } = useQuery({
        queryKey: ['cart'],
        queryFn: async () => {
            const rs = await axiosSecure.get(`/carts?email=${user.email}`);
            return rs.data;
        }
    });
    return [cart, isLoading, refetch];
};

export default useCart;