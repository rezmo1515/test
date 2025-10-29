import { Navigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext.jsx';

const AuthGuard = ({ children, guestOnly = false }) => {
  const { token } = useAuth();

  if (guestOnly && token) {
    return <Navigate to="/employees" replace />;
  }

  return children;
};

export default AuthGuard;
