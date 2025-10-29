import { Navigate, Route, Routes } from 'react-router-dom';
import AppLayout from './components/layout/AppLayout.jsx';
import AuthGuard from './components/layout/AuthGuard.jsx';
import LoginPage from './pages/LoginPage.jsx';
import EmployeesPage from './pages/EmployeesPage.jsx';
import NotFoundPage from './pages/NotFoundPage.jsx';
import HomePage from './components/HomePage.jsx';
import { AuthProvider, useAuth } from './context/AuthContext.jsx';

const ProtectedRoute = ({ children }) => {
  const { token } = useAuth();
  if (!token) {
    return <Navigate to="/login" replace />;
  }
  return children;
};

const AppRoutes = () => (
  <Routes>
    <Route path="/login" element={<AuthGuard guestOnly><LoginPage /></AuthGuard>} />
    <Route path="/" element={<HomePage />} />
    <Route
      path="/employees"
      element={(
        <ProtectedRoute>
          <AppLayout pageTitle="کارکنان">
            <EmployeesPage />
          </AppLayout>
        </ProtectedRoute>
      )}
    />
    <Route
      path="*"
      element={(
        <ProtectedRoute>
          <AppLayout pageTitle="یافت نشد">
            <NotFoundPage />
          </AppLayout>
        </ProtectedRoute>
      )}
    />
  </Routes>
);

const App = () => (
  <AuthProvider>
    <AppRoutes />
  </AuthProvider>
);

export default App;
